@extends('layout')
@section('content')

@include('partials._hero')
@include('partials._search')

<!-- syntax without php in blade template -->
<!-- similar to jsx (react), angular -->
{{--<h1>{{$heading}}</h1>--}}

<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

    @unless(count($listingsValues)==0)
    @foreach($listingsValues as $listing) 
        <x-listing-card :listing="$listing" />
    @endforeach
@else
<p>No listings found</p>
@endunless
</div>
@endsection