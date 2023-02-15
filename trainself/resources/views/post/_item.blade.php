<div class="card mb-3">
    <div class="card-body">
        <div class="d-flex">
            <img width="150" height="150" src="{{ $post->cover_image }}" alt="{{ $post->title }}" style="object-fit: cover">
            <div class="ms-3">
                <h4 class="display-4">{{ $post->title }}</h4>
                <div class="mb-3">
                    {{ $post->author->name }} | {{ $post->created_at->diffForHumans() }} | {{ $post->topic->title }}
                </div>
                <p class="fw-bold">
                    {{ $post->description }}
                </p>
                <p class="text-end">
                    <a class="btn btn-sm btn-primary" href="{{route('post.details', $post)}}">Olvass többet...</a>
                </p>
            </div>
        </div>
    </div>
</div>  