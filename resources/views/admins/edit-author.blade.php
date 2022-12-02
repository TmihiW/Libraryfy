@extends('admins.admin-layout')

@section('content')

<header>
    <h1
        class="text-3xl text-center font-bold my-6 uppercase"
    >
        Manage Authors
    </h1>
</header>

@include('partials.author_search')

<table class="w-full table-auto rounded-sm">
    <tbody>
        @unless($ListOfAuthors->isEmpty())
            <?php //dd($listingsValues);?>
            @foreach($ListOfAuthors as $author)
            <tr class="border-gray-300">
                <td
                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                >
                    <a href="/admin/authors/edit/{{$author->a_id}}">
                        {{$author->name_surname_}}
                    </a>
                </td>

                <td
                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                ><a 
                href="/admin/authors/{{$author->a_id}}/edit" 
                class="text-blue-400"
                ><i class="fa-solid fa-edit"></i
                >Edit</a>
                </td>

                <td
                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                >
                
                    <form method="POST" action="/admin/authors/{{$author->a_id}}">
                        @csrf     
                        @method('DELETE')
                        <button type="submit" class="text-red-500">
                            <i class="fa-solid fa-trash"></i
                            >Delete</button
                        >
                    </form>
                </td>
            </tr>
        @endforeach
        @else
        <tr class ="border-gray-300">
            <td
                class="px-4 py-8 border-t border-b border-gray-300 text-lg"
            >
                <p class="text-center">
                    No listings found.
                </p>
            </td>
        </tr>
        @endunless

    </tbody>
</table>
    <div class="mt-6 p4">        
        @php
        $hrefCount = 0;      
        // dd($ListOfAuthors);   
        // dd($totalAuthorsPageNum); 
        //dd($currentAuthorsPageNum);
        @endphp
        @if($totalAuthorsPageNum > 1)
            @unless($currentAuthorsPageNum == 1)
            <a href="/admin/authors/edit/?authorsPage=1" class="inline-block bg-red-500 text-white border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:bg-red-400">First Page</a>
            <a href="/admin/authors/edit/?authorsPage={{$currentAuthorsPageNum-1}}" class="inline-block bg-red-500 text-white border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:bg-red-400">Previous</a>
            @endunless
            {{-- set max $hrefCount to 10 max --}}

            @for ($i =1; $i<=$totalAuthorsPageNum; $i++)
                <a href="/admin/authors/edit/?authorsPage=<?php echo($i)?>" class="inline-block bg-red-500 text-white border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:bg-red-400">
                    <?php echo($i)?>
                </a>
                <?php $hrefCount++; ?>    
            @endfor

            @unless($currentAuthorsPageNum == $totalAuthorsPageNum)
            <a href="/admin/authors/edit/?authorsPage={{$currentAuthorsPageNum+1}}" class="inline-block bg-red-500 text-white border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:bg-red-400">Next</a>
            <a href="/admin/authors/edit/?authorsPage=<?php echo($totalAuthorsPageNum)?>"class="inline-block bg-red-500 text-white border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:bg-red-400">Last Page</a>
            @endunless
        @endif
        
    </div>

@endsection