@extends('layout.master')

@section('title')
    Welcome
@endsection

@section('content')
    <main>
        <div class="row">
            @foreach($categories as $category)
                @foreach($category->videos as $video)
            <div class="col s12 m4 l3">
                <div class="card">
                    <div class="video-container">
                        <iframe width="640" height="360" src="https://www.youtube.com/embed/{{ $video->url }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="card-content blue-grey lighten-3">
                        <span class="card-title activator grey-text text-darken-4">{{ $video->title }}<i class="material-icons right">more_vert</i></span>
                    </div>
                    <div class="card-reveal blue-grey lighten-3">
                        <span class="card-title grey-text text-darken-4">{{ $video->title }}<i class="material-icons right">close</i></span>
                        <p>Category: {{ $video->category->name }}</p>
                        <p>Description: {{ $video->description }}</p>
                    </div>
                </div>
            </div>
                @endforeach
            @endforeach
        </div>
    </main>
@endsection
