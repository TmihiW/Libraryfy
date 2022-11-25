<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Edit Gig
            </h2>
            <p class="mb-4">Edit: {{$listingGonaEdited->company}}</p>
        </header>

        <form method="POST" action="/listings/{{$listingGonaEdited->id}}" enctype="multipart/form-data">
            @csrf {{--Cross-Site Request Forgery => prevents scripting attacks--}}
            @method('PUT') {{-- send as a put request--}}
            <div class="mb-6">
                <label
                    for="company"
                    lass="inline-block text-lg mb-2"
                    >Company Name</label
                >
                <input
                     type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="company"
                    value="{{$listingGonaEdited->company}}"
                />
                @error('company')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label 
                    for="title" 
                    class="inline-block text-lg mb-2"
                    >Job Title</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="title"
                    placeholder="Example: Senior Laravel Developer"
                    value="{{$listingGonaEdited->title}}"
                    />
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label
                    for="location"
                    class="inline-block text-lg mb-2"
                    >Job Location</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="location"
                    placeholder="Example: Remote, Boston MA, etc"
                    value="{{$listingGonaEdited->location}}"
                    />
                @error('location')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label 
                    for="email" 
                    class="inline-block text-lg mb-2"
                    >Contact Email</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="email"
                    value="{{$listingGonaEdited->email}}"
                />
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label
                    or="website"
                    class="inline-block text-lg mb-2"
                    >Website/Application URL</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="website"
                    value="{{$listingGonaEdited->website}}"
                />
                @error('website')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label 
                    for="tags" 
                    class="inline-block text-lg mb-2"
                    >Tags (Comma Separated)</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="tags"
                    placeholder="Example: Laravel, Backend, Postgres, etc"
                    value="{{$listingGonaEdited->tags}}"
                />
                @error('tags')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label 
                    for="logo" 
                    class="inline-block text-lg mb-2"
                    >Company Logo</label
                >
                <input
                    type="file"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="logo"
                />
                <img
                class="w-48 mr-6 mb-6"
                src="
                @unless(($listingGonaEdited->logoPath))
                {{asset('images/no-image.png')}}
                @else{{asset('storage/'.$listingGonaEdited->logoPath)}}
                @endunless"
                alt=""
                />
                @error('logo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label
                    for="description"
                    class="inline-block text-lg mb-2"
                    >Job Description</label
                >
                <textarea
                    class="border border-gray-200 rounded p-2 w-full"
                    name="description"
                    rows="10"
                    placeholder="Include tasks, requirements, salary, etc"
                >{{$listingGonaEdited->description}}
                </textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button
                    class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                    >Update Gig</button
                >
                <a 
                    href="/" 
                    class="text-black ml-4"
                    > Back </a
                >
            </div>
        </form>
    </x-card>
</x-layout>