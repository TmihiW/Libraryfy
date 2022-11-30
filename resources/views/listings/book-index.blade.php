<x-book-layout>
    @include('partials.book_hero')
    @include('partials.book_search')

    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
    
        @unless(count($booksValues)==0)
        
            @php 
            //dd(var_dump($listingsValues));                                    
            @endphp
            @foreach($booksValues as $listing) 
                <x-book-listing-card :listing="$listing" />
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
        // dd($bookAllValues);   
        // dd($totalBookPageNum); 
        //dd($currentBookPageNum);
        @endphp
        @unless($currentBookPageNum == 1)
        <a href="/books/?booksPage=1" class="inline-block bg-red-500 text-white border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:bg-red-400">First Page</a>
        <a href="/books/?booksPage={{$currentBookPageNum-1}}" class="inline-block bg-red-500 text-white border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:bg-red-400">Previous</a>
        @endunless
        {{-- set max $hrefCount to 10 max --}}

        @for ($i =1; $i<=$totalBookPageNum; $i++)
            <a href="/books/?booksPage=<?php echo($i)?>" class="inline-block bg-red-500 text-white border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:bg-red-400">
                <?php echo($i)?>
            </a>
            <?php $hrefCount++; ?>    
        @endfor

        @unless($currentBookPageNum == $totalBookPageNum)
        <a href="/books/?booksPage={{$currentBookPageNum+1}}" class="inline-block bg-red-500 text-white border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:bg-red-400">Next</a>
        <a href="/books/?booksPage=<?php echo($totalBookPageNum)?>"class="inline-block bg-red-500 text-white border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:bg-red-400">Last Page</a>
        @endunless
        
        
    </div>
</x-book-layout>