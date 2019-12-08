@extends('pages.layouts.app')

@section('content')
    <h1>{{ $title }}</h1>
        @if (count($services) > 0)

            <div class="col-4">
                <ul class="list-group">
                    @foreach ($services as $item)
                        <li class="list-group-item">{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
@endsection
