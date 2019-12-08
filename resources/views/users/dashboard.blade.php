@extends('pages.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if (count($posts) > 0)

                        <h3>Your Blog Posts</h3>


                        <table class="table table-hover">

                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php $i = 0; ?>
                                @foreach ($posts as $post)
                                    <tr>
                                    <th scope="row"><?php echo ($i+1); ?></th>
                                        <td>{{ $post->title }}</td>
                                        <td><a href="/posts/{{ $post->id }}/edit"  role="button" class="btn btn-outline-info btn-block">Edit</a></td>
                                        <td>
                                            {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST']) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-outline-danger btn-block']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    @else
                        <h3>No posts are created...</h3>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
