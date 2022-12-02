<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="images/favicon.ico" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            laravel: "#ef3b2d",
                        },
                    },
                },
            };
        </script>
        <title>Libraryfy</title>
    </head>
    <body class="mb-48">
        <nav class="flex justify-between items-center mb-4">
            <nav class ="flex justify-start items-center mb-4">
                <a href="/"
                ><img class="w-24" src="{{asset('images/logo.png')}}" alt="" class="logo"/></a
                >
                @auth
                    @if(auth()->user()->role_id == 1)
                    <a href="/admin/"
                        class="inline-block bg-red-500 text-white border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:bg-red-400"
                        >Admin Panel</a
                    >
                    @endif
                    @if(auth()->user()->role_id == 1)
                    <a href="/laragigs/"
                        class="inline-block bg-red-500 text-white border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:bg-red-400"
                        >Admin Posts</a
                    >
                    @endif  
                @endauth
            </nav>
            <ul class="flex space-x-6 mr-6 text-lg">
                @auth
                    <li>
                        <span class="font-bold uppercase">
                        {{auth()->user()->username_}}</span></li
                    >
                
                    @if(auth()->user()->role_id == 1)
                        <li>
                            <a href="/laragigs/listings/manage" class="hover:text-laravel"
                                ><i class="fa-solid fa-gear"
                                ></i>Manage Posts</a
                            ></li
                        >
                    @endif
                    
                    @if(auth()->user()->role_id == 0)
                        <li>
                            <a href="/books/rent/return" class="hover:text-laravel"
                                ><i class="fa-solid fa-gear"
                                ></i>Rents</a
                            ></li
                        >
                    @endif
                
                    <li>
                        <form class="inline" method="POST" action="/logout">
                            @csrf
                            <button type="submit">
                                <i class="fa-solid fa-door-closed">
                                </i>Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li>
                        <a href="/register" class="hover:text-laravel"
                            ><i class="fa-solid fa-user-plus"
                            ></i> Register</a
                        ></li
                    >
                    <li>
                    <a href="/login" class="hover:text-laravel"
                        ><i class="fa-solid fa-arrow-right-to-bracket"
                        ></i>Login</a
                    ></li
                >@endauth
            </ul>
        </nav>
        <main>
            
        @include('partials.admin_hero')
        {{--VIEW OUTPUT--}}        
        {{-- {{$slot}} --}}
        @yield('content')
        
        
        </main>
        <footer class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-laravel text-white h-10 mt-24 opacity-90 md:justify-center" 
        >
            <p class="ml-2">Copyright &copy; 2022, All Rights reserved</p
            >            
        </footer>
        <x-flash-message />
    </body>
</html>