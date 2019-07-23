@extends("layouts.app")
@section('content')
    <div class="row">
        <aside class="col-2 fixed-top pl-0" style="margin-top: 70px">
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="{{route('admin.index')}}">Admin Dashboard</a>
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
            <h1>Danh sách người dùng</h1>
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>
                            <a href="">
                                <button class="btn btn-info btn-sm">Show</button>
                            </a>
                            <a href="">
                                <button class="btn btn-warning btn-sm">Edit</button>
                            </a>
                            <a href="">
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </main>
    </div>
@endsection