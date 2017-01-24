<h1>Latest List of Articles</h1>

@foreach($articles as $article)

<a href="{{$article->url}}"><h2>{{$article->title}}</h2></a>
<p>	
	{{$article->description}}<br>
	<a href="https://www.instapaper.com/api/add?username=mustapha.hamoui@gmail.com&password=mm000741&url={{$article->url}} target="_blank">Add to Instapaper</a>

</p>

@endforeach