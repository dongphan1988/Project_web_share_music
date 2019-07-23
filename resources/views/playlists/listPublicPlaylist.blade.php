@extends("layouts.app")
@section('content')
    <div class="row">
        <main class="container">
            <div class="row col-12">
                <h1>Danh Sách Playlist</h1>

                <nav class="navbar navbar-light">
                    <form class="form-inline" action="{{route('playlists.search')}}" method="get">
                        @csrf
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="input-group-text"><i class="fas fa-search"></i></button>
                            </div>
                            <input type="text" class="form-control" name="keyword" placeholder="Tìm kiếm playlist"
                                   aria-label="Username" aria-describedby="basic-addon1"
                                   value="{{(isset($_GET['keyword']) ? $_GET['keyword']: '')}}">
                        </div>
                    </form>
                </nav>
            </div>

            <table class="table table-striped col-8">
                <tr>
                    <th>#</th>
                    <th>Tên Playlist</th>
                    <th>Người Tạo</th>
                    <th>Thời Gian Tạo</th>
                    <th></th>
                </tr>
                @foreach($playlists as $index => $playlist)
                    <tr>
                        <td style="padding-right: 0px">
                            <strong>{{++$index}}</strong>
                        </td>
                        <td style="padding-left: 0px">
                            <a href="{{route('playlists.show', ['id' => $playlist->id])}}">
                                <strong>{{$playlist->name}}</strong>
                            </a>
                        </td>
                        <td>
                            {{$playlist->user->name}}
                        </td>
                        <td>{{$playlist->created_at}}</td>
                        <th>
                            <div class="playlist" data-playlistid="{{$playlist->id}}">
                            @guest
                            @else
                                <div class="interaction">
                                    <a href="#" class="likePlaylist" id="likePlaylist{{$playlist->id}}">Like</a>
                                    <a href="#" class="dislikePlaylist" id="dislikePlaylist{{$playlist->id}}">DisLike</a>
                                </div>
                            @endguest
                            </div>
                        </th>
                    </tr>
                @endforeach
            </table>
        </main>
    </div>
@endsection
