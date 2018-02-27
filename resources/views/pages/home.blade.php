@extends('layout.layout')

@section('contenido')
    <section class="posts container">
        @if (isset($title))
            <h3>{{ $title }}</h3>
        @endif
        @forelse($posts as $post)
        <article class="post">
            @if ($post->photos->count() === 1)
                <figure>
                    <img 
                        class="img-responsive" 
                        src="{{ Storage::url($post->photos->first()->url) }}" 
                        alt="imagen del articulo"
                    >
                </figure>
            @elseif($post->photos->count() > 1)
                <div class="gallery-photos" data-masonry='{"itemSelector": ".grid-item", "columnWidh": 454}'>
                    @foreach ($post->photos->take(4) as $photo)
                        <figure class="grid-item grid-item--height2">
                            @if ($loop->iteration === 4)
                                <div class="overlay">{{ $post->photos->count() }} Fotos</div>
                            @endif
                            <img class="img-responsive" src="{{ Storage::url($photo->url) }}" alt="">
                        </figure>
                    @endforeach
                </div>
            @elseif($post->iframe)
                <div class="video">
                    {!! $post->iframe !!}
                </div>
            @endif
            <div class="content-post">
                <header class="container-flex space-between">
                    <div class="date">
                        <span class="c-gray-1">{{ $post->published_at->format('M d') }}</span>
                    </div>
                    <div class="post-category">
                        <span class="category text-capitalize">
                            <a href="{{ route('categories.show', $post->category) }}">
                                {{ $post->category->name }}
                            </a>
                        </span>
                    </div>
                </header>
                <h1>{{ $post->title }}</h1>
                <div class="divider"></div>
                <p>{!! nl2br(e($post->excerpt)) !!}</p>
                <footer class="container-flex space-between">
                    <div class="read-more">
                        <a href="/blog/{{ $post->url }}" class="text-uppercase c-green">Leer más</a>
                    </div>
                    <div class="tags container-flex">
                        @forelse($post->tags as $tag)
                        <span class="tag c-gray-1 text-capitalize">
                            <a href="{{ route('tags.show', $tag) }}">
                                #{{ $tag->name }}
                            </a>
                        </span>
                        @empty
                        <span class="tag c-gray-1 text-capitalize">#Sin Tag</span>
                        @endforelse
                    </div>
                </footer>
            </div>
        </article>
        @empty
        No hay posteos disponibles
        @endforelse
    </section>
    <!-- fin del div.posts.container -->
    {{ $posts->links() }}        
@stop