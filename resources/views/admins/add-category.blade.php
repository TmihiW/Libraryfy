@extends('admins.admin-layout')

@section('content')
<x-card class="p-10 max-w-lg mx-auto mt-24">
    <form method="POST" action="/admin/category" >
        @csrf {{--Cross-Site Request Forgery => prevents scripting attacks--}}
        
        <div class="mb-6">
            <label 
                for="category" 
                class="inline-block text-lg mb-2"
                >Book name</label
            >
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="category"
                placeholder="Enter the name of the category here..."
                value="{{old('category')}}"
                />
            @error('category')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>        
        <div class="mb-6">
            <button
                class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                >Add a category</button
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
