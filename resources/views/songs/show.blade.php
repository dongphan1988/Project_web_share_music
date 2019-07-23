@extends('layouts.app')
@section('content')
    <div class="container text-center">
        <div class="container-img" data-songid="{{$song->id}}">
        @guest
        @else
            <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-primary btn-lg btn-block btn-sm"
                        data-toggle="modal"
                        data-id="{{ $song->id }}"
                        data-target="#exampleModal{{$song->id}}">
                    Thêm thể loại
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{$song->id}}" tabindex="-1"
                     role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Thêm thể loại vào bài
                                    hát {{$song->name}}</h5>
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12 col-md-12 ">
                                        <form action="{{route('songs.addCategory',$song->id)}}"
                                              method="post">
                                            @csrf
                                            <div class="form-group">
                                                @if(count($categories)==0)
                                                    <p class="alert alert-warning">Chưa có thể loại nào</p>
                                                @else
                                                    <input type="submit" class="btn btn-primary"
                                                           value="Thêm vào playlist">
                                                    <label>
                                                        <select name="categoryId"
                                                                class="form-control">
                                                            @foreach($categories as $category)
                                                                <option
                                                                    value="{{$category->id}}">{{$category->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @endif
                                                    </label>
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

    {{--  COMMENT  --}}
    <div class="container">
        @if(count($comments)==0)
            <p>Song chưa có bình luận nào!</p>
        @else
            @foreach($comments as $comment)
                <div class="row">
                    <p style="font-weight: bold; color: #1d68a7"
                       class="ml-3 mt2">{{$comment->user->name}}: </p>

                    <p class="ml-1">{{$comment->comment}}</p>
                </div>
            @endforeach
        @endif
    </div>

    @guest()
        <div class="container mb-5">
            <h5 style="font-weight: bold">Đăng nhập để bình luận</h5>
        </div>
    @else
        <div class="container">
            <form action="{{route('comment.createInSong',['songId'=>$song->id, 'userId' => Auth::id()])}}"
                  method="post">
                @csrf
                <div class="form-group">
                    <textarea name="comment" class="form-control col-md-6" placeholder="Comment Here"></textarea>
                </div>
                @if($errors->has('comment'))
                    <p class="alert-danger">
                        {{$errors->first('comment')}}
                    </p>
                @endif
                <button type="submit" class="btn btn-info">Bình luận</button>
            </form>
        </div>
    @endguest

    @include("layouts.play")
@endsection
