<x-user-layout>
    @include('partials.user_hero')
    @include('partials.user_search')
    
    <!-- syntax without php in blade template -->
    <!-- similar to jsx (react), angular -->
    {{--<h1>{{$heading}}</h1>--}}
    
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
    
        @unless(count($usersValues)==0)
        {{-- Examine variable for sorting process--}}
            @php 
            //dd(var_dump($listingsValues));
            //sorting users by times rented
            $usersValues = $usersValues->sortByDesc('times_rented');                           
            @endphp
            @foreach($usersValues as $listing) 
                <x-user-listing-card :listing="$listing" />
            @endforeach
        @else
            <p>No listings found</p>
        @endunless
    </div>
    <div class="mt-6 p4">        
        @php
        //dd($usersValues);        
        //dd($totalPageNum);     
        //dd($currentPageNum);
        $hrefCount = 0;          
        @endphp
        @unless($currentPageNum == 1)
        <a href="/?usersPage=1" class="inline-block bg-red-500 text-white border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:bg-red-400">First Page</a>
        <a href="/?usersPage={{$currentPageNum-1}}" class="inline-block bg-red-500 text-white border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:bg-red-400">Previous</a>
        @endunless
        {{-- set max $hrefCount to 10 max --}}

        @for ($i =1; $i<=$totalPageNum; $i++)
            <a href="/?usersPage=<?php echo($i)?>" class="inline-block bg-red-500 text-white border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:bg-red-400">
                <?php echo($i)?>
            </a>
            <?php $hrefCount++; ?>    
        @endfor

        @unless($currentPageNum == $totalPageNum)
        <a href="/?usersPage={{$currentPageNum+1}}" class="inline-block bg-red-500 text-white border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:bg-red-400">Next</a>
        <a href="/?usersPage=<?php echo($totalPageNum)?>"class="inline-block bg-red-500 text-white border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:bg-red-400">Last Page</a>
        @endunless
        
                                
        
                                 
            
        
    </div>
</x-user-layout>