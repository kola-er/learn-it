@extends('layout.master')

@section('title')
    {{ $video->title }}
@endsection

@section('content')
    <div class="row">
        <div class="col s12 m10 l6 offset-l3">
            <p style="text-align: center;font-weight: bold">{{ $video->title }}</p>
            <div class="row">
                <iframe width="640" height="450" src="https://www.youtube.com/embed/{{ $video->url }}" frameborder="0" allowfullscreen></iframe>
            </div>
            <p style="text-align: center;font-weight: bold">{{ $video->description }}</p>
        </div>
    </div>
@endsection