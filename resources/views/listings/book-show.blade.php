<x-book-layout>
    @include('partials.book_search')
    
    @unless(!($bookValue))
    <a href="/books/" class="inline-block text-black ml-4 mb-4"
    ><i class="fa-solid fa-arrow-left"></i> Back
    </a>
    @foreach($bookValue as $book)
    <div class="mx-4">
        <x-book-card class="p-10">
            <div
                class="flex flex-col items-center justify-center text-center"
            >
                <img
                    class="w-48 mr-6 mb-6"
                    src="{{asset('images/no-image.png')}}"
                    alt=""
                />
                {{-- @php dd($book) @endphp --}}
                <h3 class="text-2xl mb-2">
                    {{$book->b_name_}}            
                </h3>
                <div class="text-lg font-bold mb-4">
                    Author:
                    <a class="text-lg font-semibold mb-4"
                    href="/books/search?search={{$book->name_surname_}}">            
                    {{$book->name_surname_}}
                   </a>
                </div>
                
                <div class="text-lg font-bold my-4">
                    Category:
                    <a class="text-lg font-semibold mb-4"
                    href="/books/search?search={{$book->c_name_}}">            
                    {{$book->c_name_}}
                   </a>
                </div>
                <div class="border border-gray-200 w-full mb-6"></div>
            </div>                  
            {{--<x-book-listing-tags :tagsCsv="$listing->tags" />--}}
            <ul class="flex justify-center">
                  
                <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
                    ${{$book->price}}
                </li>
                <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
                    {{$book->page}} Page
                </li>
            </ul>
        </div>
            </div>
        </x-book-card>
    </div>
    @endforeach
    @else
        <p>No listing found</p>
    @endunless    
</x-book-layout>