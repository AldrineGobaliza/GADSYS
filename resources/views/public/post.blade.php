<h1>{{ $post->title }}</h1>

<p>{{ $post->content }}</p>

@foreach($post->images as $image)

<img src="{{ asset('storage/' . $image->image_path) }}" width="300">

@endforeach