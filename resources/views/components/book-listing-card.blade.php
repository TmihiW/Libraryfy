@props(['listing'])

<x-book-card>
    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block"
            src="{{asset('images/no-image.png')}}"
            alt=""
        />
        <div>
            <h3 class="text-2xl">
                <a href="/books/listings/{{$listing->b_id}}">{{$listing->b_name_}}</a>
            </h3>
            <br>
            <div class="text-xs font-bold mb-4">
                Author:
                <a class="text-xs font-semibold mb-4"
                    href="/books/search?search={{$listing->name_surname_}}">            
                    {{$listing->name_surname_}}
                   </a>
            </div> 
            <div class="text-xs font-bold mb-4">
                Category:
                <a class="text-xs font-semibold mb-4"
                    href="/books/search?search={{$listing->c_name_}}">            
                    {{$listing->c_name_}}
                   </a>
            </div>                  
                {{--<x-book-listing-tags :tagsCsv="$listing->tags" />--}}
                <ul class="flex">
                      
                    <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
                        ${{$listing->price}}
                    </li>
                    <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
                        {{$listing->page}} Page
                    </li>
                </ul>
            </div>
    </div>
</x-book-card>    