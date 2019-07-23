@extends("layouts.app")
@section('content')
    <div class="row">
        @include("layouts.aside")

        <div class="col-10 invisible">
            <!--hidden spacer-->
        </div>

        <main class="col-9 offset-2">
            <h1>Danh sách ca sĩ của bạn</h1>

            <a href="{{route('singer.create')}}">
                <button class="btn btn-success">Tạo Mới Ca Sĩ</button>
            </a>

            <table class="table table-striped text-center mt-2">
                <tr>
                    <th>#</th>
                    <th>Tên Ca Sĩ</th>
                    <th>Ảnh</th>
                    <th>Chức Năng</th>
                </tr>
                @if(count($singers) ==0)
                    <tr>
                        <td class="alert-danger">Bạn chưa có Ca Sĩ nào</td>
                    </tr>
                @else
                    @foreach($singers as $singer)
                        <tr>
                            <td>{{$singer->id}}</td>
                            <td>{{$singer->name}}</td>
                            <td>
                                @if($singer->image == null)
                                    <img class="play-music"
                                         src="{{asset('images/audio_default.png')}}"
                                         style="width: 80px">
                                @else
                                    <img class="play-music"
                                         src="https://music-project-laravel.s3-ap-northeast-1.amazonaws.com/{{$singer->image}}"
                                         style="width: 80px">
                                @endif
                            </td>
                            <td>
                                <a href="{{route('singer.show',['id'=>$singer->id])}}">
                                    <button class="btn btn-info">Hiển thị</button>
                                </a>

                                <a href="">
                                    <button class="btn btn-warning">Chỉnh sửa</button>
                                </a>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-id="{{ $singer->id }}" data-target="#exampleModal{{$singer->id}}">
                                    Xóa
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$singer->id}}" tabindex="-1" role="dialog"
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
                                                <h6>Bạn có chắc chắn muốn xóa ca sĩ: {{$singer->name}}</h6>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="">
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
            {{$singers->links()}}
        </main>
    </div>
@endsection
