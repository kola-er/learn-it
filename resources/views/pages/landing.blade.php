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

            @if (count($videos))
            <div id="video_collection" class="col s12 m8 l9">
            @foreach($videos as $video)
            <div class="col s12 m4 l6 hide-long-text">
                <div class="card">
                        <a href="video/{{ $video->id }}" >
                            <img src="https://img.youtube.com/vi/{{ $video->url }}/hqdefault.jpg" width="640" height="360"/>
                        </a>
                </div>
                <span><p style="text-align: center;font-weight: bold;">{{ $video->description }}</p></span>
            </div>
            @endforeach
            </div>
            @else
                <div class="col s12 m8 l9">
                    <div id="empty-category" class="col s12 m4 l4 offset-l4">
                        <p>Empty Category</p>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection