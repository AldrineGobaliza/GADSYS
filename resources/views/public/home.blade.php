<h1>GAD Updates</h1>

@foreach($posts as $post)

<div class="post-card">
    <h2>{{ $post->title }}</h2>

    <p>{{ Str::limit($post->content, 150) }}</p>

    <a href="/posts/{{ $post->id }}">Read More</a>
</div>

@endforeach