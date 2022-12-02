@extends('admins.admin-layout')

@section('content')
<x-card class="p-10 max-w-lg mx-auto mt-24">
    <form method="POST" action="/admin/barcodes" >
        @csrf {{--Cross-Site Request Forgery => prevents scripting attacks--}}
        <div class="mb-6">
            <label
                for="id_book"
                class="inline-block text-lg mb-2"
                >Book</label
            >
        
            <br>
            {{-- make tabindex look beautiful --}}
            <select
                name="id_book"
                class="border border-gray-200 rounded p-2 w-full"
                tabindex="1"
                >
                @foreach ($books as $book)
                    <option value="{{$book->b_id}}">
                        {{$book->b_name_}}
                    </option>
                @endforeach
            </select>
            
            @error('id_book')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        
        </div>
        
        <div class="mb-6">
            <label 
                for="howMany" 
                class="inline-block text-lg mb-2"
                >How Many?</label
            >
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="howMany"
                placeholder="Enter the number of barcodes gona created..."
                value="{{old('howMany')}}"
                />
            @error('howMany')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>        
        <div class="mb-6">
            <button
                class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                >Add a barcodes</button
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
