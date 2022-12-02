@extends('admins.admin-layout')

@section('content')
<x-card class="p-10 max-w-lg mx-auto mt-24">
    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">
            Edit Book
        </h2>
        <p class="mb-4">Edit: {{$bookGonaEdited[0]->c_name_}}</p>
    </header>

    <form method="POST" action="/books/{{$bookGonaEdited[0]->b_id}}" >
        @csrf {{--Cross-Site Request Forgery => prevents scripting attacks--}}
        @method('PUT') {{-- send as a put request--}}
        
        <div class="mb-6">
            <label
                for="b_name_"
                class="inline-block text-lg mb-2"
                >Book Name</label
            >
            <input
                 type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="b_name_"
                value="{{$bookGonaEdited[0]->b_name_}}"
            />
            @error('b_name_')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-6">
            <label
                for="name_surname_"
                class="inline-block text-lg mb-2"
                >Author Name</label
            >
            <input
                 type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="name_surname_"
                value="{{$bookGonaEdited[0]->name_surname_}}"
            />
            @error('name_surname_')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-6">
            <label
                for="c_name_"
                lass="inline-block text-lg mb-2"
                >Category</label
            >
            <input
                 type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="c_name_"
                value="{{$bookGonaEdited[0]->c_name_}}"
            />
            @error('c_name_')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        

        <div class="mb-6">
            <label 
                for="page" 
                class="inline-block text-lg mb-2"
                >Page Number</label
            >
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="page"
                value="{{$bookGonaEdited[0]->page}}"
                />
            @error('page')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label
                for="price"
                class="inline-block text-lg mb-2"
                >Price</label
            >
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="price"
                value="{{$bookGonaEdited[0]->price}}"
                />
            @error('price')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        

        <div class="mb-6">
            <button
                class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                >Update Book</button
            >            
            <a 
                href="/admin/authors/edit" 
                class="text-black ml-4"
                > Back </a
            >
        </div>
    </form>
</x-card>
@endsection