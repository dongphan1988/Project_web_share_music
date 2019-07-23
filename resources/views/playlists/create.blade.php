@extends('layouts.app')
@section('content')
    <div class="row container offset-3">
        <form action="{{route('playlists.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <h1 class="text-center">Tạo Playlist Mới</h1>
            <div class="form-group">
                <div class="form-group">
                    <input type="text" hidden name="user_id" value="{{Auth::id()}}" class="form-control">
                </div>
                <label class="form-group">Tên Playlist</label>
                <input type="text" name="name" class="form-control">
                @if($errors->has('name'))
                    <p class="alert-danger">
                        {{$errors->first('name')}}
                    </p>
                @endif
            </div>
            <label class="form-group">
                <input name="mode_id" type="checkbox" value="1">
                Chế độ công khai</label>
            <div>
                <input type="submit" class="btn btn-success" value="Tạo Mới">
                <a href="{{route('users.showMyLibrary')}}">
                    <input type="button" class="btn btn-secondary" value="Quay Lại">
                </a>
            </div>
        </form>
    </div>
@endsection

