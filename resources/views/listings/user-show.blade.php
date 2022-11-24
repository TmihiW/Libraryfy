<x-user-layout>
    @include('partials._search')
    
    @unless(!($listingValue))
    <a href="/" class="inline-block text-black ml-4 mb-4"
    ><i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <div class="mx-4">
        <x-user-card class="p-10">
            <div
                class="flex flex-col items-center justify-center text-center"
            >
                <img
                    class="w-48 mr-6 mb-6"
                    src="{{asset('images/no-image.png')}}"
                    alt=""
                />
    
                <h3 class="text-2xl mb-2">
                    {{$listingValue->name_surname_}}            
                </h3>
                <div class="text-xl font-bold mb-4">
                    {{$listingValue->username_}} 
                </div>
                
                <div class="text-lg my-4">
                    <i class="fa-solid fa-location-dot"></i> 
                    {{$listingValue->adress}}
                </div>
                <div class="border border-gray-200 w-full mb-6"></div>
                <div>
                    <h3 class="text-3xl font-bold mb-4">                        
                             Times Rented
                    </h3>
                    <div class="text-lg space-y-6">
                        {{--<x-user-listing-tags :tagsCsv="$listingValue->tags" />--}}
                        <ul class="flex justify-center">
                            <li class="flex items-center justify-center bg-black text-white rounded-xl py-2 px-6 mr-2 text-xs" >
                                {{$listingValue->times_rented}}
                            </li>
                        </ul>
    
                        <a
                            href="mailto:{{$listingValue->email}}"
                            class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80"
                            ><i class="fa-solid fa-envelope"></i>
                            Contact Student</a
                        >
    
                        Age: {{$listingValue->age}}
                    </div>
                </div>
            </div>
        </x-user-card>
    </div>
    @else
        <p>No listing found</p>
    @endunless    
</x-user-layout>