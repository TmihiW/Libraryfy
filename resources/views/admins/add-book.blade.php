@extends('admins.admin-layout')

@section('content')
<x-card class="p-10 max-w-lg mx-auto mt-24">
    <form method="POST" action="/admin/book" >
        @csrf {{--Cross-Site Request Forgery => prevents scripting attacks--}}
        <div class="mb-6">
            <label
                for="id_author"
                class="inline-block text-lg mb-2"
                >Author</label
            >
        
            <br>
            {{-- make tabindex look beautiful --}}
            <select
                name="id_author"
                class="border border-gray-200 rounded p-2 w-full"
                tabindex="1"
                >
                @foreach ($ListOfAuthors as $author)
                    <option value="{{$author->a_id}}">
                        {{$author->name_surname_}}
                    </option>
                @endforeach
            {{-- <select tabindex="1" id="author" name="id_author" data-form-field="author" data-placeholder="Select category.." class="span8 "> --}}
                {{-- @foreach($ListOfAuthors as $author) --}}
                    {{-- <option value="{{ $author->a_id }}">{{ $author->name_surname_ }}</option> --}}
                {{-- @endforeach --}}
            {{-- </select> --}}
            </select>
            
            @error('id_author')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        
        </div>

        <div class="mb-6">
            <label
                for="id_category"
                class="inline-block text-lg mb-2"
                >Category</label
            >
            
            <br>
            {{-- make tabindex look beautiful --}}
            <select
                name="id_category"
                class="border border-gray-200 rounded p-2 w-full"
                tabindex="1"
                >
                @foreach ($ListOfCategories as $category)
                    <option value="{{$category->c_id}}">
                        {{$category->c_name_}}
                    </option>
                @endforeach        
            {{-- <select tabindex="1" id="category" name="id_category" data-form-field="category" data-placeholder="Select category.." class="span8 "> --}}
                {{-- @foreach($ListOfCategories as $category) --}}
                    {{-- <option value="{{ $category->c_id }}">{{ $category->c_name_}}</option> --}}
                {{-- @endforeach --}}
            </select>
            @error('id_category')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        
        </div>
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
                placeholder="Enter the name of the book here..."
                value="{{old('b_name_')}}"
                />
            @error('b_name_')
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
                placeholder="Enter the page number of the book here..."
                value="{{old('page')}}"
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
                value="{{old('price')}}"
            />
            @error('price')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>         
        <div class="mb-6">
            <button
                class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                >Add a book</button
            >
            <a 
                href="/admin/" 
                class="text-black ml-4"
                > Back </a
            >
        </div>
    </form>
</x-card>

@endsection
