@extends('pages.layouts.app')

@section('content')

    <div class="jumbotron text-center">
        <h1 class="display-4">{{ $title }}</h1>
        <p class="lead">This is laravel application from "Laravel From Scratch" YouTube series.</p>
        {{-- <hr class="my-4"> --}}
        {{-- <p>It uses utility classes for typography and spacing to space content out within the larger container.</p> --}}
        {{-- <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a> <a class="btn btn-success btn-lg" href="/register" role="button">Register</a></p> --}}
    </div>

@endsection
