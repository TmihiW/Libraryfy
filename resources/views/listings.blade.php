<!-- syntax without php in blade template -->
<!-- similar to jsx (react), angular -->
<h1>{{$heading}}</h1>

@unless(count($listingsParamList1)==0)
    @foreach($listingsParamList1 as $listing) 
        <h2>
            <!--{{$listing['title']}}-->
            <a href="/listings/{{$listing['id']}}">{{$listing['title']}}</a>
         </h2>
        <p>
            {{$listing['description']}}
        </p>    
@endforeach
@else
@endunless