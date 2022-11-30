<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Rent;
use App\Models\BookBarcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    //get specified book available barcodes
    public function getBookBarcodes(Request $request)
    {
        $b_id = $request->b_id;
        $booksBarcodeValues=DB::table('book')
        ->select('b_id','b_name_','page','price','book_barcode.barcode','book_barcode.isAvailable')
        ->join('book_barcode','book_barcode.id_book','=','book.b_id')
        ->where('book_barcode.isAvailable','=',1,'AND','b_id','=',$b_id)        
        ->orderBy('b_id')->get();
        return $booksBarcodeValues;
    }
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
        ->orderBy('b_id')->get();           
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
		$book_search = $book_search->get();     
        //return $book_search;
        return view('listings.book-index',[
                    'booksValues'=> $book_search,
                    //take total page number from paginate
                    'totalBookPageNum'=> count($book_search),
                    //take current page from request
                    'currentBookPageNum'=> $request->page
        ]);
	}
    
    //Show a single listing
    public function bookShowView($id){
            //values from selected book
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
            $countB=$booksBarcodeValues->count();
        if ($bookListing){
            return view('listings.book-show',[
                'bookValue'=> $bookListing,
                'numberOfAvailableBooks'=> $countB,
                'bookBarcodes'=> $booksBarcodeValues
            ]);
        }
        else{
            abort('404');
        }
    }
    //Rent view
    public function bookRentView($id){
        
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

            DB::table('book_barcode') 
            ->where('b_bar_id',$id_barcode) ->limit(1) ->update( [ 'isAvailable' => 0 ]);
            
            //dd($updateAvailable);
            return redirect('/books')->with('success','Book rented successfully');
        }
        else{
            return redirect('/books')->with('success','Book rented failed');;
        }
        $availableBarcode=$booksBarcodeValues->barcode;
        //dd($availableBarcode);
        //Rent::create($formFields);                
        //Session::flash('message','Listing created successfully');
        //return redirect('/books')->with('success','Book rented successfully');
    }
    // //Show form to create new listing
    // public function createView(){
    //     return view('listings.create');
    // }

    // //Save new listing to database
    // public function saveRequest(Request $request){
    //     //dd($request->file('logo'));
    //     //dd($request->file('logo')->store('logos','public'));
    //     // or 
    //     //dd($request->file('logo')->store('public'));
    //     $formFields=$request->validate([
    //         'title'=>['required','string','max:255'],
    //         'company'=>['required',Book::unique('listings','company')],
    //         'location'=>'required',
    //         'website'=>['required','string','max:255'],
    //         'email'=>['required','email',Book::unique('listings','email')],
    //         'tags'=>'required',
    //         'description'=>'required'
    //     ]);
    //     if($request->hasFile('logo')){
    //         $formFields['logoPath']=$request->file('logo')->store('logos','public');
    //     }
    //     $formFields['user_id']=auth()->user()->id;
    //     Book::create($formFields);                
    //     //Session::flash('message','Listing created successfully');
    //     return redirect('/books/')->with('success','Listing created successfully');
    // }
    // //Show form to edit listing
    // public function editView(Book $listing){ 
    //     //dd($listing);       
    //     if ($listing){
    //         return view('listings.edit',[
    //             'listingGonaEdited'=> $listing
    //         ]);
    //     }
    //     else{
    //         abort('404');
    //     }
    // }
    // public function updateRequest(Request $request, Book $listing){
        
    //     //Make sure that the user is the owner of the listing
    //     if( auth()->user()->role_id!=1){ //except admin
    //         if($listing->user_id != auth()->user()->id){
    //             return redirect('/books/')->with('success','Unauthorized Page');
    //         }
    //     }
    //     $formFields=$request->validate([
    //         'title'=>'required',
    //         'company'=>['required'],
    //         'location'=>'required',
    //         'website'=>'required',
    //         'email'=>['required','email'],
    //         'tags'=>'required',
    //         'description'=>'required'
    //     ]);
    //     if($request->hasFile('logo')){
    //         $formFields['logoPath']=$request->file('logo')->store('logos','public');
    //     }
    //     $listing->update($formFields);                
    //     //Session::flash('message','Listing created successfully');
    //     return redirect('/laragigs/listings/'.$listing->id)->with('success','Listing updated successfully');
    // }
    // public function deleteRequest(Book $listing){
    //     //Make sure that the user is the owner of the listing
    //     if( auth()->user()->role_id!=1){ //except admin
    //         if($listing->user_id != auth()->user()->id){
    //             return redirect('/books/')->with('success','Unauthorized Page');
    //         }
    //     }
    //     $listing->delete();
    //     return redirect('/books/')->with('success','Listing deleted successfully');
    // }

    // //manage  Listings
    // public function manageView(){
    //     return view('listings.manage',[
    //         'listingsGonaManaged'=> auth()->user()->listings()->get()
    //     ]);
    // }
}
