@extends("layouts.app")
@section('content')
    <div class="row">
        @include("layouts.aside")

        <div class="col-10 invisible">
            <!--hidden spacer-->
        </div>

        <main class="col-9 offset-2">
            <h1>Danh sách bài hát của bạn</h1>

            <a href="{{route('songs.create')}}">
                <button class="btn btn-success">Tạo Mới Bài Hát</button>
            </a>

            <table class="table table-striped text-center mt-2">
                <tr>
                    <th>#</th>
                    <th>Tên Bài Hát</th>
                    <th>Ảnh</th>
                    <th>Chức Năng</th>
                </tr>
                @if(count($songs) ==0)
                    <tr>
                        <td class="alert-danger">bạn chưa có bài nhạc nào</td>
                    </tr>
                @else
                    @foreach($songs as $song)
                        <tr>
                            <td>{{$song->id}}</td>
                            <td>{{$song->name}}</td>
                            <td>
                                @if($song->image == null)
                                    <img class="play-music"
                                         src="{{asset('images/audio_default.png')}}"
                                         style="width: 80px"
                                         onclick="getSongInfo({{"['$song->mp3_file', '$song->image', '$song->name']"}})">
                                @else
                                    <img class="play-music"
                                         src="https://music-project-laravel.s3-ap-northeast-1.amazonaws.com/{{$song->image}}"
                                         style="width: 80px"
                                         onclick="getSongInfo({{"['$song->mp3_file', '$song->image', '$song->name']"}})">
                                @endif
                            </td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-id="{{ $song->id }}"
                                        data-target="#exampleModalLong{{$song->id}}">
                                    Ca sĩ
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalLong{{$song->id}}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Thêm bài hát vào ca
                                                    sĩ</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('singer.addSong')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" value="{{$song->id}}" name="songId">
                                                    @if(count(Auth::user()->singers()->get())==0)
                                                        <div class="alert alert-warning text-danger" role="alert">
                                                            Bạn chưa có ca sĩ
                                                        </div>
                                                    @else
                                                        <select name="singerId" class="custom-select"
                                                                style="width: 50%">
                                                            @foreach(Auth::user()->singers()->get() as $singer)

                                                                <option
                                                                    value="{{$singer->id}}">{{$singer->name}}</option>

                                                            @endforeach
                                                        </select>
                                                        <input type="submit" class="btn btn-success" value="Thêm">
                                                    @endif
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Đóng
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <a href="{{route('songs.show',['id'=>$song->id])}}">
                                    <button class="btn btn-info">Hiển thị</button>
                                </a>
                                <a href="{{route('songs.edit',['id'=>$song->id])}}">
                                    <button class="btn btn-warning">Chỉnh sửa</button>
                                </a>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-toggle="modal"
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
                                                <a href="{{route('songs.delete', ['id' => $song->id])}}">
                                                    <button type="button" class="btn btn-danger">Xóa</button>
                                                </a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Đóng
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </table>
            {{$songs->links()}}
        </main>
        @include("layouts.play")
    </div>
@endsection
