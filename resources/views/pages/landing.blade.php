@extends('layout.master')

@section('title')
    Welcome
@endsection

@section('content')
    <div class="section">
        <div class="row">
            <div class="col s12 m4 l3">
                <ul class="collection with-header brown lighten-1">
                    <li class="collection-header brown lighten-2"><h4>Collections</h4></li>
                    @foreach($categories as $category)
                        <li class="collection-item brown lighten-2"><div>{{ $category->name }}<a href="/{{ $category->id }}" class="secondary-content"><i class="material-icons">send</i></a></div></li>
                    @endforeach
                </ul>
            </div>

            @if (! empty($videos))
            <div id="video_collection" class="col s12 m8 l9">
            @foreach($videos as $video)
            <div class="col s12 m4 l3">
                <div class="card">
                    <div class="video-container">
                        <iframe width="640" height="360" src="https://www.youtube.com/embed/{{ $video->url }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="card-content brown lighten-2">
                        <span class="card-title activator grey-text text-darken-4">{{ $video->title }}<i class="material-icons right">more_vert</i></span>
                    </div>
                    <div class="card-reveal brown lighten-2">
                        <span class="card-title">{{ $video->title }}<i class="material-icons right">close</i></span>
                        <p>Category: {{ $video->category->name }}</p>
                        <p>Description: {{ $video->description }}</p>
                    </div>
                </div>
            </div>
            @endforeach
            </div>
            @elseif(empty($videos))
                <div class="col s12 m8 l9">
                    {{--<div class="col s12 m4 l4 offset-l1">--}}
                        <h3>Empty Catgory</h3>
                    {{--</div>--}}
                </div>
            @endif

        </div>
    </div>
@endsection
