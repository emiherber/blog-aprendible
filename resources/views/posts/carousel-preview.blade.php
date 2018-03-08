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