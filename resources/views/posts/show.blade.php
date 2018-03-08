@extends('layout.layout')

@section('meta-title', $post->title)
@section('meta-description', $post->excerpt)

@section('contenido')
<article class="post container">
    @include($post->viewType('home'))
    <div class="content-post">
        @include('posts.header')
        <h1>{{ $post->title }}</h1>
        <div class="divider"></div>
        <div class="image-w-text">
            {!! $post->body !!}
        </div>

        <footer class="container-flex space-between">
            @include('partials.social-links',['description' => $post->title])
            @include('posts.tag')
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