@extends('layouts.app')

@section('content')
    <header class="masthead text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h1> {{ $lesson->title }} </h1>
                    <h2> {{ $lesson->subtitle }} </h2>
                </div>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe width="1280" height="720" src="{{ $lesson->link }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </header>
@endsection
