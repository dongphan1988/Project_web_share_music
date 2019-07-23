@extends("layouts.app")
@section('content')
    <div class="row">
        <main class="container">
            <h1>Danh Sách Bài Hát Mới Cập Nhật</h1>

            <table class="table table-striped">
                @foreach($songs as $index => $song)
                    <tr>
                        <td>{{++$index}}</td>
                        <td>
                            <div class="row">
                                <div>
                                    @if($song->image == null)
                                        <img
                                            src="{{asset('images/audio_default.png')}}"
                                            class="img-thumbnail" id="song-img"
                                            style="width: 80px; height: 80px"
                                            onclick="getSongInfo({{"['$song->mp3_file', '$song->image', '$song->name']"}})">
                                    @else
                                        <img
                                            src="https://music-project-laravel.s3-ap-northeast-1.amazonaws.com/{{$song->image}}"
                                            style="width: 80px; height: 80px"
                                            class="img-thumbnail play-music"
                                            onclick="getSongInfo({{"['$song->mp3_file', '$song->image', '$song->name']"}})">
                                    @endif
                                </div>
                                <div class="pl-2">
                                    <div>
                                        <a href="{{route('songs.show', $song->id)}}">
                                            <strong>{{$song->name}}</strong>
                                        </a>
                                    </div>
                                    <div>Like: {{$song->likes->where('like',true)->count()}}</div>
                                    <div>DisLike: {{$song->likes->where('like',false)->count()}}</div>
                                    <div>Lượt Nghe: {{$song->view}}</div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{$songs->links()}}
        </main>
    </div>
    @include("layouts.play")
@endsection
