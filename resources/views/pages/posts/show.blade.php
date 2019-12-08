@extends('pages.layouts.app')

@section('content')

    <div class="col-2" style="padding-bottom: 2rem;">
        <a class="btn btn-outline-primary btn-block" href="/posts" role="button">Go Back</a>
    </div>

    <div class="card mb-3">
        {{-- <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image cap">
            <title>Placeholder</title>
            <rect fill="#868e96" width="100%" height="100%"></rect><text fill="#dee2e6" dy=".3em" x="50%" y="50%">Image cap</text>
        </svg> --}}

        <img src="/storage/cover_images/{{ $post->cover_img }}" class="bd-placeholder-img card-img-top" focusable="false" role="img"/>

        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">{!! $post->body !!}</p>
            <p class="card-text"><small class="text-muted">Last updated at {{ $post->updated_at }} and created by {{ $post->user->name }}</small></p>
        </div>

        @if (!Auth::guest())
            @if (Auth::user()->id == $post->user_id)

                <hr>

                <div class="row">

                    <div class="col-1"></div>

                    <div class="col-5">
                        <a href="/posts/{{ $post->id }}/edit"  role="button" class="btn btn-outline-info btn-block">Edit</a>
                    </div>

                    <div class="col-5">
                        {{-- <a href="/posts/{{ $post->id }}/delete" role="button" class="btn btn-outline-danger btn-block">Delete</a> --}}

                        {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST']) !!}
                            {!! Form::hidden('_method', 'DELETE') !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-outline-danger btn-block']) !!}
                        {!! Form::close() !!}
                    </div>

                    <div class="col-1"></div>
                </div>

                <hr>

            @endif
        @endif

    </div>
@endsection
