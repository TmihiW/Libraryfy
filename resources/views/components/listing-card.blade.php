@props(['listing'])

<x-card>
    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block"
            src="
            @unless(($listing->logoPath))
            {{asset('images/no-image.png')}}
            @else{{asset('storage/'.$listing->logoPath)}}
            @endunless"
            alt=""
        />
        <div>
            <?php //dd($listing);?>
            <h3 class="text-2xl">
                <a href="/laragigs/listings/{{$listing->id}}">{{$listing->title}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{$listing->company}}</div>
            <x-listing-tags :tagsCsv="$listing->tags" />
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i> {{$listing->location}}
            </div>
        </div>
    </div>
</x-card>    