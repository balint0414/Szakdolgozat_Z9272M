<div class="card mb-3">
    <div class="card-body">
        <div class="d-flex">
            <img width="150" height="150" src="{{ $post->cover_image }}" alt="{{ $post->title }}" style="object-fit: cover">
            <div class="ms-3">
                <h4 class="display-4">{{ $post->title }}</h4>
                <div class="mb-3">
                    <img class="rounded-circle me-2" src="{{$post->author->avatar_image}}" alt="" width="25">
                    {{ $post->author->name }} | {{ $post->created_at->diffForHumans() }} | {{ $post->topic->title }}
                </div>
                <p class="fw-bold">
                    {{ $post->description }}
                </p>
                <p class="text-end">
                    <div class="d-flex justify-content-end">
                        @can('update', $post)
                            <form method="POST" action="{{ route('post.delete', $post) }}" class="mr-2">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">{{__('Törlés')}}</button>
                            </form>
                            <a class="btn btn-sm btn-secondary mr-2 ms-2" href="{{route('post.edit',$post)}}">{{__('Szerkesztés')}}</a>
                        @endcan
                        <a class="btn btn-sm btn-primary ms-2" href="{{route('post.details', $post)}}">{{__('Olvass többet...')}}</a>
                    </div>  
                </p>
            </div>
        </div>
    </div>
</div>  