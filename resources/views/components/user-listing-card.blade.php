@props(['listing'])

<x-user-card>
    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block"
            src="{{asset('images/no-image.png')}}"
            alt=""
        />
        <div>
            <h3 class="text-2xl">
                <a href="/listings/{{$listing->id}}">{{$listing->name_surname_}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{$listing->username_}}</div>
                {{--<x-user-listing-tags :tagsCsv="$listing->tags" />--}}
                <ul class="flex">
                      
                    <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
                        {{$listing->times_rented}} Times Rented a Book
                    </li>
                </ul>
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i> {{$listing->adress}}
            </div>
        </div>
    </div>
</x-user-card>    