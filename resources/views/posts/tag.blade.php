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