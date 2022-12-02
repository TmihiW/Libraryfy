<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Rent;
use App\Models\User;
use App\Models\Author;
use App\Models\Category;
use App\Models\AuthorOwn;
use App\Models\BookBarcode;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Unique;

class BookController extends Controller
{
    
    //Show all listings    
    public function bookIndexView(){
        $books=Book::latest()->filter(request(['tag','search']))->paginate('4',['*'],'booksPage');
        //get book barcode
        $booksAllValues=DB::table('book')
        ->select('b_id','b_name_','page','price','author.name_surname_','category.c_name_')
        ->join('author_own', 'author_own.id_book', '=', 'book.b_id')
        ->join('author', 'author.a_id', '=', 'author_own.id_author')
        ->join('book_category', 'book_category.id_book', '=', 'book.b_id')
        ->join('category', 'category.c_id', '=', 'book_category.id_category')        
        ->orderBy('b_id')->paginate('4',['*'],'booksPage');         
        //dd($books);        
        
        //get total page number from paginate
        $booksTotalPage=$books->lastPage();        
        //get current page number from paginate
        $booksCurrentPage=$books->currentPage();
        return view('listings.book-index',[
            'booksValues'=> $booksAllValues,
            'totalBookPageNum'=> $booksTotalPage,
            'currentBookPageNum'=> $booksCurrentPage
        ]);

        

        // return view('listings.book-index',[
        //     'booksValues'=> Book::latest()->filter(request(['tag','search']))->paginate('4',['*'],'users')
        // ]);
    }


    public function bookSearch(Request $request)
	{
        $search = $request->search;        
		$book_search = Book::select('b_id','b_name_','page','price','author.name_surname_','category.c_name_')
        ->join('author_own', 'author_own.id_book', '=', 'book.b_id')
        ->join('author', 'author.a_id', '=', 'author_own.id_author')
        ->join('book_category', 'book_category.id_book', '=', 'book.b_id')
        ->join('category', 'category.c_id', '=', 'book_category.id_category') 
        ->where('b_name_', 'like', '%' . $search . '%')
        ->orWhere('author.name_surname_', 'like', '%' . $search . '%')
        ->orWhere('category.c_name_', 'like', '%' . $search . '%')
        ->orderBy('b_id');
		$book_search = $book_search->paginate('4',['*'],'booksPage');    
        //return $book_search;
        $booksTotalPage=$book_search->lastPage();
        $booksCurrentPage=$book_search->currentPage();
        return view('listings.book-index',[
                    'booksValues'=> $book_search,
                    //take total page number from paginate
                    'totalBookPageNum'=> $booksTotalPage,
                    //take current page from request
                    'currentBookPageNum'=> $booksCurrentPage
        ]);
	}
    //Show a single listing
    public function bookShowView($id){
            //values from selected book
            //book must to have author and category so we use inner join
            //otherway book will not be shown
            $bookListing = Book::select('b_id','b_name_','page','price','author.name_surname_','category.c_name_')
            ->join('author_own', 'author_own.id_book', '=', 'book.b_id')
            ->join('author', 'author.a_id', '=', 'author_own.id_author')
            ->join('book_category', 'book_category.id_book', '=', 'book.b_id')
            ->join('category', 'category.c_id', '=', 'book_category.id_category') 
            ->where('b_id',$id )
            ->orderBy('b_id');
            $bookListing = $bookListing->get();
            //available barcodes from selected book
            $booksBarcodeValues=Book::select('b_id','b_name_','page','price','book_barcode.barcode','book_barcode.isAvailable')
            ->join('book_barcode','book_barcode.id_book','=','book.b_id')
            ->where('book_barcode.isAvailable','=',1)
            ->where('b_id',$id)       
            ->orderBy('b_id');
            $booksBarcodeValues=$booksBarcodeValues->get();
            //count of available barcodes from selected book
            $countOfStocks=$booksBarcodeValues->count();
        if ($bookListing){
            return view('listings.book-show',[
                'bookValue'=> $bookListing,
                'numberOfAvailableBooks'=> $countOfStocks,
                'bookBarcodes'=> $booksBarcodeValues
            ]);
        }
        else{
            abort('404');
        }
    }    
    //Rent a book
    public function bookRent($id){
        //get barcode from request
        //dd($id);
        $booksBarcodeValues=Book::select('b_id','b_name_','page','price','book_barcode.b_bar_id','book_barcode.barcode','book_barcode.isAvailable')
            ->join('book_barcode','book_barcode.id_book','=','book.b_id')
            ->where('book_barcode.isAvailable','=',1)
            ->where('b_id',$id)       
            ->orderBy('b_id');
        $booksBarcodeValues=$booksBarcodeValues->get();
        //dd($booksBarcodeValues);
        foreach($booksBarcodeValues as $bookBarcodeValue){
            if($bookBarcodeValue->isAvailable==1){
                $avilable[] = [$bookBarcodeValue->barcode,
                              $bookBarcodeValue->b_bar_id];
            }
            
            //$barcodes=$bookBarcodeValue->barcode;
        }
        //dd($avilable);
        if(count($avilable)>0){
            //dd($avilable);
            //dd(count($avilable));

            //take first available barcode
            $barcode=$avilable[0][0];
            $id_barcode=$avilable[0][1];
            //dd($barcode);
            //dd($id_barcode);     
            $checkRents=Rent::select('r_id','id_user','id_book','id_barcode','return_time','isReturn')
            ->where('isReturn',0)
            ->where('id_book',$id)       
            ->orderBy('r_id');
            $checkRents=$checkRents->get();
            //dd($checkRents);
            function checkRentReturn($RentsGonaCheck){
                foreach($RentsGonaCheck as $Rented){
                    if($Rented->isReturn==0){
                        return true;
                    }
                }
            }
            //if user has not rent this book before
            if(checkRentReturn($checkRents)){
               return redirect('/books')->with('success','You have already rented this book');
            }
            else{
                 //update barcode status
                 $barc=DB::table('book_barcode') 
                 ->where('b_bar_id',$id_barcode) ->limit(1) ->update( [ 'isAvailable' => 0 ]);
                 //dd($barc);
                 //create rent table for rent book
                 $rent = new Rent;            
                 $rent->id_user = Auth::user()->id;
                 $rent->id_book = $id;
                 $rent->id_barcode = $id_barcode;
                 $rent->return_time=Carbon::now()->addDays(30);          
                 //dd($rent);
                 $rent->save();
                 //increment auth timesRented
                $user = User::find(Auth::user()->id);
                $user->times_rented = $user->times_rented + 1;
                $user->save();
                 //dd($updateAvailable);
                 return redirect('/books')->with('success','Book rented successfully');
             
            }   
            
        }
        else{
            return redirect('/books')->with('success','There is no books on stock available');;
        }        
    }

    //Rent view
    public function rentReturnView(){
        $u_id = Auth::user()->id;
        //dd($u_id);
        $Rents=Rent::select('r_id','id_user','id_book','id_barcode','return_time','isReturn','book.b_name_')
        ->join('book','book.b_id','=','rent.id_book')
        ->where('isReturn',0)
        ->where('id_user',$u_id)
        ->orderBy('r_id');
        $Rents=$Rents->get();
        //dd($Rents);
        if($Rents){
            foreach($Rents as $Rent){
                //check if rent time is over
                if($Rent->return_time<Carbon::now()){
                    $Rent['remainingDays']='Overdue!';
                }
                else{
                    $Rent['remainingDays']=Carbon::now()->diffInDays($Rent->return_time);
                }
            }            
            //dd($Rent);
            return view('listings.rent-manage',[
                'rentsGonaManaged'=> $Rents
            ]);
        }
        else{
            return redirect('/books')->with('success','You have not rented any book');
        }
        
    }
    //Return a book
    public function rentReturnRequest($id){
        //dd($id);
        $rent = Rent::find($id);
        $rent->isReturn = 1;
        $rent->save();
        //update barcode status
        $barc=DB::table('book_barcode') 
        ->where('b_bar_id',$rent->id_barcode) ->limit(1) ->update( [ 'isAvailable' => 1 ]);
        //dd($barc);
        return redirect('/books')->with('success','Book returned successfully');
    }

     //admin panel 
     public function adminView(){
        
        return view('admins.admin-layout');
    }
    //add category view
    public function addCategoryView(){
        return view('admins.add-category');
    }
    //add category 
    public function addCategoryRequest(Request $request){
        $formFields = $request->validate([
            'category' => 'required'
        ]);
        //dd($formFields);
        //check if category already exists
        $checkCategory=Category::select('c_id','c_name_')
        ->where('c_name_',$formFields['category'])
        ->orderBy('c_id');
        $checkCategory=$checkCategory->get();
        //dd($checkCategory);
        if(count($checkCategory)>0){
            return redirect('/admin/category/add')->with('success','Category already exists');
        }
        else{
            //create category
            $category = new Category;            
            $category->c_name_ = $formFields['category'];          
            //dd($category);
            $category->save();
            return redirect('/admin')->with('success','Category added successfully');
        }
    }

    //add author view
    public function addAuthorView(){
        return view('admins.add-author');
    }

    //add author
    public function addAuthorRequest(Request $request){
        $formFields = $request->validate([
            'name_' => 'required',
            'surname_' => 'required',
            'age' => 'required',
        ]);
        //dd($formFields);
        //check if author already exists
        $checkAuthor=Author::select('a_id','name_surname_')
        ->where('name_surname_',($formFields['name_'].' '.$formFields['surname_']))
        ->orderBy('a_id');
        $checkAuthor=$checkAuthor->get();
        //dd($checkAuthor);
        if(count($checkAuthor)>0){
            return redirect('/admin/author/add')->with('success','Author already exists');
        }
        else{
            //create author
            $author = new Author;            
            $author->name_ = $formFields['name_'];
            $author->surname_ = $formFields['surname_'];
            $author->age = $formFields['age'];
            $author->name_surname_ = $formFields['name_'].' '.$formFields['surname_']; 
            //dd($author);
            $author->save();
            return redirect('/admin')->with('success','Author added successfully');
        }
    }


    //add book view
    public function addBookView(){
        //get all authors
        $authorsQuery = Author::select()->orderBy('name_surname_')->get();
        //get all categories
        $categoriesQuery = Category::select()->orderBy('c_name_')->get();
        //dd($authors);
        return view('admins.add-book',[
            'ListOfAuthors'=>$authorsQuery,
            'ListOfCategories'=>$categoriesQuery
        ]);
    }
    //add book
    public function addBookRequest(Request $request){
        //dd($request);
        $formFields=$request->validate([
            'b_name_'=>'required',
            'page'=>'required',
            'price'=>'required',
            'id_author'=>'required',
            'id_category'=>'required',
        ]);
        //dd($formFields);        
        //create book
        $book = new Book;
        $book->b_name_ = $formFields['b_name_'];
        $book->page = $formFields['page'];
        $book->price = $formFields['price'];
        //dd($book);
        //before save book check author if owns this book
        $checkAuthor=AuthorOwn::select('id_author','id_book');
        $book->save();
        //fill author_own with id_book and id_author
        $authorOwn = new AuthorOwn;
        $authorOwn->id_author = $formFields['id_author'];
        $authorOwn->id_book = $book->b_id;
        //dd($authorOwn);
        $authorOwn->save();
        //fill category_own with id_book and id_category
        $bookCategory= new BookCategory;
        $bookCategory->id_category = $formFields['id_category'];
        $bookCategory->id_book = $book->b_id;
        $bookCategory->save();

        return redirect('/admin')->with('success','Book added successfully');
    }

    //Show authors view
    public function authorIndexView(){
        $Authors=Author::latest()->filter(request(['name_surname_','search']))->paginate('4',['*'],'authorsPage');
        //get all authors
        $authorsQuery = Author::select()
        ->orderBy('name_surname_')->paginate('4',['*'],'authorsPage');         
        //dd($authorsQuery);        
        
        //get total page number from paginate
        $authorsTotalPage=$Authors->lastPage();        
        //get current page number from paginate
        $authorsCurrentPage=$Authors->currentPage();
        return view('admins.edit-author',[
            'ListOfAuthors'=> $authorsQuery,
            'totalAuthorsPageNum'=> $authorsTotalPage,
            'currentAuthorsPageNum'=> $authorsCurrentPage
        ]);
    }
    
    //Author search
    public function authorSearch(Request $request){
        $search = $request->search; 
        //dd($formFields);
        $author_search=Author::select('a_id','name_','surname_','name_surname_')
        ->where('name_','like','%'.$search.'%')
        ->orWhere('surname_','like','%'.$search.'%')
        ->orWhere('name_surname_', 'like', '%' . $search . '%')
        ->orderBy('name_surname_');
        //dd($author_search);
        $author_search = $author_search->paginate('4',['*'],'booksPage');
        //get total page number from paginate
        $authorsTotalPage=$author_search->lastPage();        
        //get current page number from paginate
        $authorsCurrentPage=$author_search->currentPage();
        return view('admins.edit-author',[
            'ListOfAuthors'=> $author_search,
            'totalAuthorsPageNum'=> $authorsTotalPage,
            'currentAuthorsPageNum'=> $authorsCurrentPage
        ]);
    }    

    // authorShowView
    public function authorShowView($id){
        //get author
        $authorQuery=Author::find($id);
        //dd($authorQuery);
        //get author books
        $authorBooks=AuthorOwn::select('id_book')
        ->where('id_author',$id)->get();
        //dd($authorBooks);
        //get books
        $books=Book::select('b_id','b_name_','page','price')
        ->whereIn('b_id',$authorBooks)->orderBy('b_id')->get();
        //dd($books);
        return view('admins.author-show',[
            'author'=>$authorQuery,
            'books'=>$books
        ]);
    }
    
    //author edit view
    public function editAuthorView(Author $author){
        //dd($author);
        return view('admins.author-edit',[
            'authorGonaEdited'=>$author
        ]);
    }
    //author update request
    public function updateAuthorRequest(Request $request,Author $author){
        //dd($request);
        $formFields=$request->validate([
            'name_'=>'required',
            'surname_'=>'required',
            'age'=>'required',
        ]);
        //dd($formFields);
        //dd($author);
        $author->name_ = $formFields['name_'];
        $author->surname_ = $formFields['surname_'];
        $author->age = $formFields['age'];
        $author->name_surname_ = $formFields['name_'].' '.$formFields['surname_'];
        $author->save();
        //$author->update($formFields);
        return redirect('/admin/authors/edit/')->with('success','Author updated successfully');
    }

    //author delete request
    public function deleteAuthorRequest(Author $author){
        //dd($author);
        $author->delete();
        return redirect('/admin/authors/edit/')->with('success','Author deleted successfully');
    }

    //edit book view
    public function editBookView(Book $book){
        //dd($book);
        $bookValues=DB::table('book')
        ->select('b_id','b_name_','page','price','author.name_surname_','category.c_name_')
        ->join('author_own', 'author_own.id_book', '=', 'book.b_id')
        ->join('author', 'author.a_id', '=', 'author_own.id_author')
        ->join('book_category', 'book_category.id_book', '=', 'book.b_id')
        ->join('category', 'category.c_id', '=', 'book_category.id_category')   
        ->where('b_id',$book->b_id)     
        ->orderBy('b_id')->get();
        //dd($bookValues);
        return view('admins.book-edit',[
            'bookGonaEdited'=>$bookValues
        ]);
    }
    //update book request
    public function updateBookRequest(Request $request,Book $book){
        //dd($request);
        $formFields=$request->validate([
            'b_name_'=>'required',
            'page'=>'required',
            'price'=>'required',
            'name_surname_'=>'required',
            'c_name_'=>'required',
        ]);
        //dd($formFields);
        //dd($book);
        $book->b_name_ = $formFields['b_name_'];
        $book->page = $formFields['page'];
        $book->price = $formFields['price'];
        $book->save();
        //update author_own from name_surname_
        $authorOwnId=AuthorOwn::select('id_author')
        ->where('id_book',$book->b_id)->get();
        // dd($authorOwnId);
        // update author name_surname_
        $update=DB::table('author') 
        ->where('a_id', $authorOwnId[0]->id_author) 
        ->limit(1) ->update( [ 'name_surname_' => $formFields['name_surname_']]);
        //update book_category from c_name_
        $bookCategoryId = BookCategory::select('id_category')
        ->where('id_book',$book->b_id)->get();
        //dd($bookCategoryId);
        // update category c_name_
        $update2=DB::table('category') ->where('c_id', $bookCategoryId[0]->id_category) ->limit(1) ->update( [ 'c_name_' => $formFields['c_name_']]);
        
        return redirect('/books')->with('success','Book updated successfully');
    }

    //delete book request
    public function deleteBookRequest(Book $book){
        //dd($book);
        $book->delete();
        return redirect('/books')->with('success','Book deleted successfully');
    }

    //create barcode view
    public function createBarcodesView(){
        $booksQuery = Book::select()->orderBy('b_name_')->get();
        return view('admins.create-barcode',[
            'books'=>$booksQuery
        ]);
    }
    //create random 5 digit barcodes request for given number of barcodes for given book id
    public function createBarcodesRequest(Request $request){
        //dd($request);
        $formFields=$request->validate([
            'id_book'=>'required',
            'howMany'=>'required',
        ]);
        //dd($formFields);
        $b_id=$formFields['id_book'];
        $barcodeNum=$formFields['howMany'];
        //dd($b_id);
        //dd($barcodeNum);
        //get book name
        //dd($bookName);
        //create barcodes
        for($i=0;$i<$barcodeNum;$i++){
            $barcode = new BookBarcode;
            $barcode->id_book = $b_id;
            $barcode->barcode = rand(10000,99999);
            $barcode->isAvailable = 1;
            $barcode->save();
        }
        return redirect('/admin/barcodes/create')->with('success','Barcodes created successfully');
    }

}
