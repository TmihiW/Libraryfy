@extends('layout')

@section('content')
@include('partials._search')
@unless(!($listingValue))
    <h2>
        {{$listingValue['title']}}
    </h2>
    <p>
        {{$listingValue['description']}}
    </p>
@else
<p>No listing found</p>
@endunless    
@endsection