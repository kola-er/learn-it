@extends('layout.master')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="section">
        <div class="row">
            <div class="col s12 m4 l3">
                <div class="card">
                    <div class="card-image">
                        <img src="{{ $user->profile->avatar }}" />
                        <span class="card-title">{{isset($user->username) ? : $user->profile->first_name . ' ' . $user->profile->last_name }}</span>
                    </div>
                    <div class="card-action blue-grey lighten-3">
                        <a class="black-text" href="update-profile">Edit Profile</a>
                    </div>
                </div>
            </div>
            <div class="col s12 m8 l6">
                <div class="section">
                    <div class="row float-up" id="video_form_toggle">
                        <span class="btn-floating waves-effect waves-light red"><i class="material-icons">add</i></span>
                    </div>

                    <div class="row" id="video_form">
                        <form method="post" action="">
                            {{ csrf_field() }}
                            <h5>Submit a Youtube link to the video</h5>
                            <div class="col s12">
                                <div class="input-field">
                                    <input type="text" name="title" id="title" placeholder="Title">
                                </div>
                            </div>
                            <div class="col s12">
                                <div class="input-field">
                                    <textarea class="materialize-textarea" placeholder="Description" name="description" id="description"></textarea>
                                </div>
                            </div>
                            <div class="col s6">
                                <div class="input-field">
                                    <input type="text" name="url" id="url" placeholder="Video URL">
                                </div>
                            </div>
                            <div class="col s6">
                                <div class="input-field">
                                    <select name="category" id="category" class="browser-default">
                                        <option value="" selected>Select appropriate category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col s12">
                                <button class="btn waves-effect waves-light" type="submit" name="action">Post
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </form>
                    </div>


                    <div class="row" id="videos">
                        <div class="section">
                            @foreach($user->videos as $video)
                                <div class="col s12 m4 l3">
                                    <div class="card">
                                        <div class="card-image waves-effect waves-block waves-light">
                                            <a href="{{route('show.video', $video->user_id)}}" >
                                                <img src="https://img.youtube.com/vi/{{ $video->url }}/hqdefault.jpg"/>
                                            </a>
                                        </div>
                                        <div class="card-content">
                                            <span class="card-title activator grey-text text-darken-4">{{ $video->title }}<i class="material-icons right">more_vert</i></span>
                                        </div>
                                        <div class="card-reveal">
                                            <span class="card-title grey-text text-darken-4">{{ $video->title }}<i class="material-icons right">close</i></span>
                                            <p>{{ $video->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@endsection