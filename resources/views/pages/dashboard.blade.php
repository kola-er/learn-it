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
                        <span class="card-title"><i style="cursor:pointer" id="avatar_change_toggle" class="fa fa-pencil-square-o top-right"></i></span>
                    </div>
                    <div class="card-action brown lighten-2">
                        {{isset($user->username) ? $user->username : $user->profile->first_name }}<i style="cursor:pointer" id="update_form_toggle" class="fa fa-pencil-square-o fa-2x right"></i>
                    </div>
                </div>
            </div>


            <div class="col s12 m4 l9">
                <div class="row">
                    <a id="video_form_toggle" class="row float-up chip red">Post</a>
                </div>
                <div class="col s12 m4 l4">
                    <div id="avatar_change" class="card-panel grey lighten-2">
                        <form method="POST" action="update-avatar" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="file-field input-field" id="image">
                                    <input type="file" name="file" id="file">
                                </div>
                                <div class="waves-effect waves-block waves-light" id="imagePreview">
                                    <img src="{{ $user->profile->avatar }}" height="100" width="85" id="profile-pic">
                                </div>
                                <p>Click on the image to upload</p>
                            </div>
                            <div class="row">
                                <a id="avatar_cancel" class="waves-effect waves-teal btn">Cancel</a>
                                <button class="btn waves-effect waves-light right" type="submit" name="avatar_change">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col s12 m4 l9">
                <div id="update_form" class="card-panel">
                    <form method="POST" action="update-profile">
                        {!! csrf_field() !!}
                        <div style="text-align: center">
                            <h5>Update only the fields you want changed</h5>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="username" name="username" type="text" value="{{ $user->username }}">
                                <label for="username">Username</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="first_name" name="first_name" type="text" value="{{ $user->profile->first_name }}">
                                <label for="first_name">First name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="last_name" name="last_name" type="text" value="{{ $user->profile->last_name }}">
                                <label for="last_name">Last name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="email" name="email" type="email" value="{{ $user->email }}" class="validate">
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <div class="row">
                            <a id="update_cancel" class="waves-effect waves-teal btn">Cancel</a>
                            <button class="btn waves-effect waves-light right" type="submit" name="update">
                                Update
                            </button>
                        </div>
                    </form>
                </div>

                <div id="video_form" class="card-panel">
                    <form method="post" action="video-post">
                        {{ csrf_field() }}
                        <div style="text-align: center">
                            <h5>Submit a Youtube link to the video</h5>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" name="title" required id="title">
                                <label for="title">Title</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea class="materialize-textarea" placeholder="Description" name="description" id="description"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s8">
                                <input type="url" name="url" required id="url" class="validate">
                                <label for="url">Youtube URL</label>
                            </div>
                            <div class="input-field col s4">
                                <select name="category" required id="category" class="browser-default">
                                    <option value="" selected>Select appropriate category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <a id="post_cancel" class="waves-effect waves-teal btn">Cancel</a>
                            <button class="btn waves-effect waves-light right" type="submit" name="post">
                                Post
                            </button>
                        </div>
                    </form>
                </div>
                </div>

                    @foreach($user->videos as $video)
                        <div class="col s12 m4 l4 hide-long-text">
                            <div class="card">
                                <a href="video/{{ $video->id }}" >
                                    <img src="https://img.youtube.com/vi/{{ $video->url }}/hqdefault.jpg" width="640" height="360"/>
                                </a>
                            </div>
                            <span><p style="text-align: center;font-weight: bold;">{{ $video->description }}</p></span>
                        </div>
                    @endforeach
            </div>
        </div>
    </div>
@endsection