@extends('layouts.app')
@section('content')
    <h1 class="text-center text-capitalize">Những bài hát của ca sĩ {{$singer->name}}</h1>
    @if(count($songs)==0)
        <div class="container alert alert-warning">Ca sĩ {{$singer->name}} chưa có bài hát nào</div>
    @endif
    <div class="container">
        <button class="btn btn-success mb-3" id="listen-all-playlist">Nghe Toàn Bộ bài hát của ca
            sĩ {{$singer->name}}</button>
        <div class="row">
            <div class="col-md-9 content_left ">
                <div class="row text-center">
                    @foreach($songs as $song)
                        <div class="col-3 mb-5" id="song">
                            @if(Auth::id() == $singer->user_id)
                                <div>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-primary btn-lg btn-block btn-sm"
                                            data-toggle="modal"
                                            data-id="{{ $song->id }}" data-target="#exampleModal{{$song->id}}">
                                        Xóa
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$song->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h6>Bạn có chắc chắn muốn xóa bài hát: {{$song->name}}</h6>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{route('singer.deleteSongsinger',['songId'=>$song->id,'singerId'=>$singer->id])}}">
                                                        <button type="button" class="btn btn-danger">Xóa</button>
                                                    </a>
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Đóng
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="container-img">
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
                                <div class="pt-2"><h5><strong>{{$song->name}}</strong></h5></div>
                            </div>
                                @if(!$song->mp3_file)
                                    <div class="alert-danger">bài hát này đã bị xóa</div>
                                @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{$songs->links()}}
    </div>
    {{--  COMMENT  --}}
    <div class="container">
        @if(count($comments)==0)
            <p>Playlist chưa có bình luận nào!</p>
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
            <form action="{{route('comment.createInSinger',['songId'=>$singer->id, 'userId' => Auth::id()])}}"
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

    @include('layouts.play')
@endsection
