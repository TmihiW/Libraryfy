<section
        class="relative h-72 bg-laravel flex flex-col justify-center align-center text-center space-y-4 mb-4"
    >
        <div
            class="absolute top-0 left-0 w-full h-full opacity-20 bg-no-repeat bg-center"
            style="background-image: url('images/bgadmin.png')"
        ></div>

        <div class="z-10">
            <h1 class="text-6xl font-bold uppercase text-white">
                Library<span class="text-black">fy</span>
            </h1>
            <p class="text-2xl text-gray-200 font-bold my-4">
                Admin Panel 
            </p>
        

        
            @auth  
                @if(auth()->user()->role_id == 1)
                
                <div class ="flex justify-start items-center  mx-4">
                    <div>
                        <a
                            href="/admin/category/add"
                            class="inline-block border-2 border-white text-white mx-2 py-2 px-4 rounded-xl uppercase mt-2 hover:bg-red-400"
                            >Add category</a
                        >
                    </div>
                    <div>
                        <a
                            href="/admin/author/add"
                            class="inline-block border-2 border-white text-white mx-2 py-2 px-4 rounded-xl uppercase mt-2 hover:bg-red-400"
                            >Add author</a
                        >
                    </div>
                    <div>
                        <a
                            href="/admin/book/add"
                            class="inline-block border-2 border-white text-white mx-2 py-2 px-4 rounded-xl uppercase mt-2 hover:bg-red-400"
                            >Add book</a
                        >
                    </div>                    
                    <div>
                        <a
                            href="/admin/authors/edit"
                            class="inline-block border-2 border-white text-white mx-2 py-2 px-4 rounded-xl uppercase mt-2 hover:bg-red-400"
                            >Edit Authors</a
                        >
                    </div>
                    <div>
                        <a
                            href="/books"
                            class="inline-block border-2 border-white text-white mx-2 py-2 px-4 rounded-xl uppercase mt-2 hover:bg-red-400"
                            >Edit Books</a
                        >
                    </div> 
                    <div>
                        <a
                            href="/admin/barcodes/create"
                            class="inline-block border-2 border-white text-white mx-2 py-2 px-4 rounded-xl uppercase mt-2 hover:bg-red-400"
                            >Create Barcode</a
                        >
                    </div> 
                </div>       
                
                @endif            
            @endauth
        </div>
        
</section>