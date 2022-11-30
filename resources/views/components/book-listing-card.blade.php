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
                <a href="/books/{{$listing->b_id}}">{{$listing->b_name_}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">by {{$listing->name_surname_}}</div>
                {{--<x-user-listing-tags :tagsCsv="$listing->tags" />--}}
                <ul class="flex">
                      
                    <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
                        {{$listing->price}} Price
                    </li>
                    <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
                        {{$listing->page}} Page
                    </li>
                </ul>
        </div>
    </div>
</x-book-card>    