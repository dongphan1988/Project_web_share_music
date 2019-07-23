@extends('layouts.app')
@section('content')
    <h1 class="text-center text-capitalize">Kết Quả Tìm Kiếm</h1>
    @if(count($playlists) == 0)
        <p class="alert alert-warning">Không tìm thấy playlist trong hệ thống</p>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-12 content_left">
                <div class="col-md-12 row">
                    <h1>Hot Playlists</h1>

                    <nav class="navbar navbar-light">
                        <form class="form-inline" action="{{route('playlists.search')}}" method="get">
                            @csrf
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="input-group-text"><i class="fas fa-search"></i></button>
                                </div>
                                <input type="text" class="form-control" name="keyword" placeholder="Search Playlist"
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
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        @include("layouts.play")
    </div>
@endsection
