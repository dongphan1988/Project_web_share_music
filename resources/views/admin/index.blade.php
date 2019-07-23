@extends("layouts.app")
@section('content')
    <div class="row">
        <aside class="col-2 fixed-top pl-0" style="margin-top: 70px">
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="{{route('admin.showUser')}}">Danh sách người dùng</a>
                </li>
                <li class="list-group-item">
                    <a href="">Link</a>
                </li>
                <li class="list-group-item">
                    <a href="">Link</a>
                </li>
            </ul>
        </aside>

        <div class="col-10 invisible">
            <!--hidden spacer-->
        </div>

        <main class="col-10 offset-2" style="margin-top: 50px">
            <h1>Trang Quản Trị</h1>
        </main>
    </div>
@endsection