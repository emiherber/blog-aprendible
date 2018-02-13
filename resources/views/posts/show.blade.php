@extends('layout.layout')

@section('meta-title', $post->title)
@section('meta-description', $post->excerpt)

@section('contenido')
<article class="post image-w-text container">
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

@push('scripts')
<script id="dsq-count-scr" src="//zendero.disqus.com/count.js" async></script>
@endpush