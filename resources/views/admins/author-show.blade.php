@extends('admins.admin-layout')

@section('content')

<header>
    <h1
        class="text-3xl text-center font-bold my-6 uppercase"
    >
        {{$author->name_surname_}}
    </h1>
</header>
<table class="w-full table-auto rounded-sm">
    <tbody>
        @unless($books->isEmpty())
            <?php //dd($listingsValues);?>
            @foreach($books as $book)
            <tr class="border-gray-300">
                <td
                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                >
                    <a href="/books/{{$book->b_id}}">
                        {{$book->b_name_}}
                    </a>
                </td>

                <td
                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                ><a 
                href="/books/{{$book->b_id}}/edit" 
                class="text-blue-400"
                ><i class="fa-solid fa-edit"></i
                >Edit</a>
                </td>

                <td
                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                >
                
                    <form method="POST" action="/books/{{$book->b_id}}">
                        @csrf
                        @method('DELETE')
                        <button 
                            class="text-red-500">
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
                    No books found.
                </p>
            </td>
        </tr>
        @endunless

    </tbody>
</table>    

@endsection