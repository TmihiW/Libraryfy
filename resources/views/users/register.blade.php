<x-user-layout>
    <x-user-card class="p-10 rounded max-w-lg mx-auto mt-24">
                    <header class="text-center">
                        {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
                        <h2 class="text-2xl font-bold uppercase mb-1">
                            Register
                        </h2>
                        <p class="mb-4">Create an account</p>
                    </header>

                    <form method="POST" action="/users">
                        @csrf
                        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
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
                            <label
                                for="adress"
                                class="inline-block text-lg mb-2"
                                >Adress</label
                            >
                            <textarea
                                class="border border-gray-200 rounded p-2 w-full"
                                name="adress"
                                rows="10"
                                placeholder="Include tasks, requirements, salary, etc"
                            >{{old('adress')}}
                            </textarea>
                            @error('adress')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-6">
                            <label for="username_" class="inline-block text-lg mb-2">
                                Username
                            </label>
                            <input
                                type="text"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="username_"
                                value="{{old('username_')}}"
                            />
                            @error('username_')
                            {{--p.text-red-500.text.xs.mt-1--}}
                            <p class="text-red-500 text xs mt-1">
                                {{ $message }}
                            </p> 
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="email" class="inline-block text-lg mb-2"
                                >Email</label
                            >
                            <input
                                type="email"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="email"
                                value="{{old('email')}}"
                            />
                            @error('email')
                            <p class="text-red-500 text xs mt-1">
                                {{ $message }}
                            </p> 
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label
                                for="password"
                                class="inline-block text-lg mb-2"
                            >
                                Password
                            </label>
                            <input
                                type="password"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="password"
                            />
                            @error('password')
                            <p class="text-red-500 text xs mt-1">
                                {{ $message }}
                            </p> 
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label
                                for="password2"
                                class="inline-block text-lg mb-2"
                            >
                                Confirm Password
                            </label>
                            <input
                                type="password"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="password_confirmation"
                            />
                            @error('password_confirmation')
                            <p class="text-red-500 text xs mt-1">
                                {{ $message }}
                            </p> 
                            @enderror
                        </div>

                        <div class="mb-6">
                            <button
                                type="submit"
                                class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                            >
                                Sign Up
                            </button>
                        </div>

                        <div class="mt-8">
                            <p>
                                Already have an account?
                                <a href="/login" class="text-laravel"
                                    >Login</a
                                >
                            </p>
                        </div>
                    </form>
    </x-user-card>
</x-user-layout>