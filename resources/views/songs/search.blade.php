@extends('layouts.app')
@section('content')
    <h1 class="text-center text-capitalize">Kết Quả Tìm Kiếm</h1>
    @if(count($songs) == 0)
        <p class="alert alert-warning">Không tìm thấy bài hát trong hệ thống</p>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-12 content_left">
                <div class="row">
                    @foreach($songs as $song)
                        <div class="col-md-3 mb-5 text-center" id="song">

                            <div class="container-img" data-songid="{{$song->id}}">
                            @guest
                            @else
                                <!-- Button trigger modal -->
                                    <button type="button"
                                            class="btn btn-outline-primary btn-lg btn-block btn-sm"
                                            data-toggle="modal"
                                            data-id="{{ $song->id }}"
                                            data-target="#exampleModal{{$song->id}}">
                                        Thêm Vào Playlist
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$song->id}}" tabindex="-1"
                                         role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Thêm bài
                                                        hát {{$song->name}} vào Playlist</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12 col-md-12 ">
                                                            <form action="{{route('playlists.add',$song->id)}}"
                                                                  method="post">
                                                                @csrf
                                                                <div class="form-group">
                                                                    @if(count(Auth::user()->playlists()->get())==0)
                                                                        <p class="alert alert-warning">Bạn chưa
                                                                            có
                                                                            playlist</p>
                                                                    @else
                                                                        <input type="submit"
                                                                               class="btn btn-primary"
                                                                               value="Thêm vào playlist">
                                                                        <label>
                                                                            <select name="playlistId"
                                                                                    class="form-control">
                                                                                @foreach(Auth::user()->playlists()->get() as $playlist)
                                                                                    <option
                                                                                        value="{{$playlist->id}}">{{$playlist->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            @endif
                                                                        </label>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <div class="col-12 col-md-12 ">
                                                            <form
                                                                action="{{route('playlists.createNewPlaylistAndAddSong',$song->id)}}"
                                                                method="post"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label class="form-group">Tạo mới
                                                                        Playlist</label>
                                                                    <input type="text" name="name"
                                                                           class="form-control">
                                                                    @if($errors->has('name'))
                                                                        <p class="alert-danger">
                                                                            {{$errors->first('name')}}
                                                                        </p>
                                                                    @endif
                                                                </div>
                                                                <input type="hidden" name="user_id"
                                                                       value="{{Auth::id()}}">
                                                                <label class="form-group">
                                                                    <input name="mode_id" type="checkbox"
                                                                           value="1">
                                                                    Chế độ công khai</label>
                                                                <div>
                                                                    <input type="submit" class="btn btn-success"
                                                                           value="Tạo playlist mới">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Đóng
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endguest

                                @if($song->image == null)
                                    <img
                                        src="{{asset('images/audio_default.png')}}"
                                        class="img-thumbnail" id="song-img"
                                        onclick="getSongInfo({{"['$song->mp3_file', '$song->image', '$song->name']"}})">
                                @else
                                    <img
                                        src="https://music-project-laravel.s3-ap-northeast-1.amazonaws.com/{{$song->image}}"
                                        class="img-thumbnail" id="song-img"
                                        onclick="getSongInfo({{"['$song->mp3_file', '$song->image', '$song->name']"}})">
                                @endif
                                <div class="middle">
                                    <img class="play-music" src="{{asset('/images/logo.png')}}" alt=""
                                         style="height: 50px"
                                         onclick="getSongInfo({{"['$song->mp3_file', '$song->image', '$song->name']"}})">
                                </div>

                                <div class="pt-2">
                                    <a href="{{route('songs.show',$song->id)}}">
                                        <h5><strong>{{$song->name}}</strong></h5>
                                    </a>
                                </div>
                                <div>Like: {{$song->likes->where('like',true)->count()}} |
                                    DisLike: {{$song->likes->where('like',false)->count()}} |
                                    View: {{$song->view}}</div>
                                @guest
                                @else
                                    <div class="interaction text-center">
                                        <i class="fas fa-heart fa-2x mx-2 my-2 likeSong"
                                           id="likeSong{{$song->id}}"></i>
                                        <i class="fas fa-heartbeat fa-2x mx-2 my-2 dislikeSong"
                                           id="dislikeSong{{$song->id}}"></i>
                                    </div>
                                @endguest
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @include("layouts.play")
    </div>
@endsection
