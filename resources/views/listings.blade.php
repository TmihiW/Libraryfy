<!-- syntax without php in blade template -->
<!-- similar to jsx (react), angular -->
<h1>{{$heading}}</h1>

@unless(count($listings)==0)
    @foreach($listings as $listing) 
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