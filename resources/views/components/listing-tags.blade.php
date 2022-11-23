@props(['tagsCsv'])
{{-- CSV means Comma Seperated Values  like a,b,c --}}
@php
 $tags = explode(',', $tagsCsv);
@endphp
<ul class="flex">
    @foreach ($tags as $tag)
    <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs" >
        <a href="/?tag={{$tag}}">{{$tag}}</a>
    @endforeach    
</ul>