@extends("layouts.app")
@section('content')
    <div class="row">
        @include("layouts.aside")

        <div class="col-10 invisible">
            <!--hidden spacer-->
        </div>

        <main class="col-9 offset-2">
            <h1>Danh sách Playlist của bạn</h1>

                <a href="{{route('playlists.create')}}">
                    <button class="btn btn-success">Tạo Mới Playlist</button>
                </a>

            <table class="table table-striped mt-2">
                <tr>
                    <th>#</th>
                    <th>Album</th>
                    <th>Chế độ</th>
                    <th>Chức năng</th>
                </tr>
                @if(count($playlists)==0)
                    <tr>
                        <td class="alert alert-warning">Bạn chưa có playlist</td>
                    </tr>
                @else
                    @foreach($playlists as $key=>$playlist)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>
                                <a href="{{route('playlists.show', ['id' => $playlist->id])}}">{{$playlist->name}}</a>
                            </td>
                            <td>{{$playlist->mode->name}}</td>
                            <td>
                                <a href="{{route('playlists.show',$playlist->id)}}">
                                    <button class="btn btn-info">Hiển Thị</button>
                                </a>
                                <a href="{{route('playlists.edit',['id' => $playlist->id])}}">
                                    <button class="btn btn-warning">Cập Nhật</button>
                                </a>
                                <a href="">
                                    <button class="btn btn-danger">Xóa</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </main>
    </div>
@endsection
