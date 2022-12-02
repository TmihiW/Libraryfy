@extends('admins.admin-layout')

@section('content')
<x-card class="p-10 max-w-lg mx-auto mt-24">
    <form method="POST" action="/admin/author" >
        @csrf {{--Cross-Site Request Forgery => prevents scripting attacks--}}
        
        <div class="mb-6">
            <label for="name_" class="inline-block text-lg mb-2">
                Name
            </label>
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="name_"
                value="{{old('name_')}}"
            />
            @error('name_')
            {{--p.text-red-500.text.xs.mt-1--}}
            <p class="text-red-500 text xs mt-1">
                {{ $message }}
            </p> 
            @enderror
        </div>
        <div class="mb-6">
            <label for="surname_" class="inline-block text-lg mb-2">
                Surname
            </label>
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="surname_"
                value="{{old('surname_')}}"
            />
            @error('surname_')
            {{--p.text-red-500.text.xs.mt-1--}}
            <p class="text-red-500 text xs mt-1">
                {{ $message }}
            </p> 
            @enderror
        </div>
        <div class="mb-6">
            <label for="age" class="inline-block text-lg mb-2">
                Age
            </label>
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="age"
                value="{{old('age')}}"
            />
            @error('age')
            {{--p.text-red-500.text.xs.mt-1--}}
            <p class="text-red-500 text xs mt-1">
                {{ $message }}
            </p> 
            @enderror
        </div>       
        <div class="mb-6">
            <button
                class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                >Add an author</button
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
