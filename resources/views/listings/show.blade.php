<x-layout>
@include('partials._search')

@unless(!($listingValue))
<a href="/laragigs/" class="inline-block text-black ml-4 mb-4"
><i class="fa-solid fa-arrow-left"></i> Back
</a>
<div class="mx-4">
    <x-card class="p-10">
        <div
            class="flex flex-col items-center justify-center text-center"
        >
            <img
                class="w-48 mr-6 mb-6"
                src="
                @unless(($listingValue->logoPath))
                {{asset('images/no-image.png')}}
                @else{{asset('storage/'.$listingValue->logoPath)}}
                @endunless"
                alt=""
            />

            <h3 class="text-2xl mb-2">
                {{$listingValue->title}}            
            </h3>
            <div class="text-xl font-bold mb-4">
                {{$listingValue->company}} 
            </div>
            <x-listing-tags :tagsCsv="$listingValue->tags" />
            <div class="text-lg my-4">
                <i class="fa-solid fa-location-dot"></i> 
                {{$listingValue->location}}
            </div>
            <div class="border border-gray-200 w-full mb-6"></div>
            <div>
                <h3 class="text-3xl font-bold mb-4">
                    Job Description
                </h3>
                <div class="text-lg space-y-6">
                    {{$listingValue->description}}

                    <a
                        href="mailto:{{$listingValue->email}}"
                        class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80"
                        ><i class="fa-solid fa-envelope"></i>
                        Contact Employer</a
                    >

                    <a
                        href="{{$listingValue->website}}"
                        target="_blank"
                        class="block bg-black text-white py-2 rounded-xl hover:opacity-80"
                        ><i class="fa-solid fa-globe"></i> Visit
                        Website</a
                    >
                </div>
            </div>
        </div>
    </x-card>
    {{-- gona be auth --}}
    @auth
        @if(auth()->user()->role_id == 1)
            <x-card class="mt-4 p-2 flex space-x-6">
                <a 
                    href="/laragigs/listings/{{$listingValue->id}}/edit" 
                    class="text-blue-400"
                    ><i class="fa-solid fa-edit"></i
                    >Edit</a
                >
                <form method="POST" action="/laragigs/listings/{{$listingValue->id}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500">
                        <i class="fa-solid fa-trash"></i
                        >Delete</button
                    >
                </form>
            </x-card>
        @endif
    @endauth
</div>
@else
<p>No listing found</p>
@endunless    
</x-layout>