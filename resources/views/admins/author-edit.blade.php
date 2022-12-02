@extends('admins.admin-layout')

@section('content')
<x-card class="p-10 max-w-lg mx-auto mt-24">
    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">
            Edit Author
        </h2>
        <p class="mb-4">Edit: {{$authorGonaEdited->name_surname_}}</p>
    </header>

    <form method="POST" action="/admin/authors/{{$authorGonaEdited->a_id}}" >
        @csrf {{--Cross-Site Request Forgery => prevents scripting attacks--}}
        @method('PUT') {{-- send as a put request--}}
        <div class="mb-6">
            <label
                for="name_"
                class="inline-block text-lg mb-2"
                >Name</label
            >
            <input
                 type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="name_"
                value="{{$authorGonaEdited->name_}}"
            />
            @error('name_')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label 
                for="surname_" 
                class="inline-block text-lg mb-2"
                >Surname</label
            >
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="surname_"
                placeholder="Example: Senior Laravel Developer"
                value="{{$authorGonaEdited->surname_}}"
                />
            @error('surname_')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label
                for="age"
                class="inline-block text-lg mb-2"
                >Age</label
            >
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="age"
                placeholder="Example: Remote, Boston MA, etc"
                value="{{$authorGonaEdited->age}}"
                />
            @error('age')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        

        <div class="mb-6">
            <button
                class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                >Update Author</button
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