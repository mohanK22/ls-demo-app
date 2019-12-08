@extends('pages.layouts.app')

@section('content')

    <h1>Create Post</h1>

    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

        <div class="form-group">
            {{-- <label for="post_title">Title</label> --}}
            {{ Form::label('post_title', 'Title') }}
            {{-- <input type="text" class="form-control" id="post_title" aria-describedby="emailHelp" placeholder="Post Title">
            --}}
            {{ Form::text('post_title', '', ['class' => 'form-control', 'placeholder' => 'Post Title']) }}
            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
        </div>

        <div class="form-group">
            {{-- <label for="post_body">Body</label>
            <textarea class="form-control" id="post_body" rows="4" placeholder="Post Body"></textarea> --}}

            {{ Form::label('post_body', 'Body') }}
            {{ Form::textarea('post_body', '', ['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'Post Body']) }}
        </div>

        <div class="form-group custom-file">
            {{ Form::file('post_cover_img', ['class' => 'custom-file-input']) }}
            {{ Form::label('post_cover_img', 'Cover Image', ['class' => 'custom-file-label']) }}
        </div>

        <br>
        <br>

        {{ Form::submit('Submit Post', ['class' => 'btn btn-primary btn-block']) }}

    {!! Form::close() !!}

    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            bsCustomFileInput.init()
        });
    </script>

    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('article-ckeditor');
    </script>

@endsection
