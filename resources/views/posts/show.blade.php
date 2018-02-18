@extends('layout.layout')

@section('meta-title', $post->title)
@section('meta-description', $post->excerpt)

@section('contenido')
<article class="post container">
    @if ($post->photos->count() === 1)
    <figure>
        <img 
            class="img-responsive" 
            src="{{ Storage::url($post->photos->first()->url) }}" 
            alt="imagen del articulo"
        >
    </figure>    
    @elseif($post->photos->count() > 1)    
    @include('posts.carousel', $post)
    @elseif($post->iframe)
        <div class="video">
            {!! $post->iframe !!}
        </div>
    @endif
    <div class="content-post">
        <header class="container-flex space-between">
            <div class="date">
                <span class="c-gris">{{ $post->published_at->format('M d') }}</span>
            </div>
            <div class="post-category">
                <span class="category">{{ $post->category->name }}</span>
            </div>
        </header>
        <h1>{{ $post->title }}</h1>
        <div class="divider"></div>
        <div class="image-w-text">
            {!! $post->body !!}
        </div>

        <footer class="container-flex space-between">
            @include('partials.social-links',['description' => $post->title])
            <div class="tags container-flex">
                @forelse($post->tags as $tag)
                <span class="tag c-gris">#{{ $tag->name }}</span>
                @empty
                <span class="tag c-gris">#Sin Tag</span>
                @endforelse
            </div>
        </footer>
        <div class="comments">
            <div class="divider"></div>
            <div id="disqus_thread"></div>
            @include('partials.disqus-script')
        </div><!-- .comments -->
    </div>
</article>
@stop
@push('styles')
<link rel="stylesheet" href="/css/twitter-bootstrap.css">
@endpush

@push('scripts')
<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="/js/twitter--bootstrap.js"></script>
<script id="dsq-count-scr" src="//zendero.disqus.com/count.js" async></script>
@endpush