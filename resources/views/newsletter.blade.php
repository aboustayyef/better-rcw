<h1>Latest List of Articles</h1>

@foreach($articles as $article)

<a href="{{$article->url}}"><h2>{{$article->title}}</h2></a>
<p>	
	{{$article->description}}
</p>

@endforeach