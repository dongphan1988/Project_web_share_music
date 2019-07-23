@extends('layouts.app')
@section('content')
    <div class="row container offset-3">
        <form action="{{route('playlists.update',['id' => $playlist->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <h1 class="text-center">Cập nhật Playlist</h1>
            <div class="form-group">
                <label class="form-group">Tên Playlist</label>
                <input type="text" name="name" class="form-control" value="{{$playlist->name}}">
                @if($errors->has('name'))
                    <p class="alert-danger">
                        {{$errors->first('name')}}
                    </p>
                @endif
            </div>
            <label class="form-group">
                Chế độ
                <select name="mode_id">
                    @foreach($modes as $mode)
                        <option value="{{$mode->id}}"
                        {{$mode->id == $playlist->mode_id ? "selected":""}}
                        >{{$mode->name}}</option>
                        @endforeach
                </select>
            </label>
            <div>
                <input type="hidden" name="id" value="{{$playlist->id}}">
                <input type="submit" class="btn btn-success" value="Cập nhật">
            </div>
        </form>
    </div>
@endsection
