@if(session()->has('success'))
    {{--  
        //Write this and press tab 
        .fixed.top-0.transform.bg-laravel.text-white.px-48.py-3
    --}}
    <div x-data="{show: true}" x-init="setTimeout(()=>show =false, 3000)" x-show="show" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-laravel text-white px-10 py-3">
        <p>
            {{ session('success') }}
        </p>
    </div>
@endif