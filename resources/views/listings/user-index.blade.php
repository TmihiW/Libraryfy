<x-user-layout>
    @include('partials._hero')
    @include('partials._search')
    
    <!-- syntax without php in blade template -->
    <!-- similar to jsx (react), angular -->
    {{--<h1>{{$heading}}</h1>--}}
    
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
    
        @unless(count($listingsValues)==0)
        {{-- Examine variable for sorting process--}}
            @php 
            //dd(var_dump($listingsValues));
            //sorting users by times rented
            $listingsValues = $listingsValues->sortByDesc('times_rented',);                           
            @endphp
            @foreach($listingsValues as $listing) 
                <x-user-listing-card :listing="$listing" />
            @endforeach
        @else
            <p>No listings found</p>
        @endunless
    </div>
    </x-user-layout>