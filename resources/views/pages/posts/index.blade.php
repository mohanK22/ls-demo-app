@extends('pages.layouts.app')

@section('content')
    <h4 class="text-muted">Posts</h4>
    @if (count($posts) > 0)
        @foreach ($posts as $post)

            <div class="card mb-3">

                {{-- <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image cap"><title>Placeholder</title><rect fill="#868e96" width="100%" height="100%"></rect><text fill="#dee2e6" dy=".3em" x="50%" y="50%">Image cap</text></svg> --}}

                <img src="/storage/cover_images/{{ $post->cover_img }}" class="bd-placeholder-img card-img-top" width="100%" height="180" focusable="false" role="img"/>

                <div class="card-body">
                  <h5 class="card-title"><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h5>
                  <p class="card-text">{!! $post->body !!}</p>
                <p class="card-text"><small class="text-muted">Last updated at {{ $post->updated_at }} and created by {{ $post->user->name }}</small></p>
                </div>
            </div>

        @endforeach
        {{ $posts->links() }}
    @else
        <p>No post found</p>
    @endif
@endsection
