@extends('layouts.app')
@section('content')
    <div class="row container offset-3">
        <form action="{{route('songs.update',['id'=>$song->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <h2 class="text-center">Cập Nhật Bài Hát: {{$song->name}}</h2>
            @if(Session::has('success'))
                <p class="alert-success">{{Session::get('success')}}</p>
            @endif
            <div class="form-group">
                <label class="form-group">Tên Bài Hát</label>
                <input type="text" name="name" class="form-control" value="{{$song->name}}">
                @if($errors->has('name'))
                    <p class="alert-danger">
                        {{$errors->first('name')}}
                    </p>
                @endif
            </div>

            <div class="form-group">
                <label class="form-group">Lời Bài Hát</label>
                <textarea rows="4" cols="50" type="text" name="lyric" class="form-control">{{$song->lyric}}</textarea>
            </div>
            <div class="form-group">
                <label class="form-group">Ảnh</label>
                <input type="file" name="image" class="form-control-file">
                @if($errors->has('image'))
                    <p class="alert-danger">
                        {{$errors->first('image')}}
                    </p>
                @endif
            </div>

            <div class="form-group">
                <label class="form-group">File Nhạc</label>
                <input type="file" name="mp3_file" class="form-control-file">
                @if($errors->has('mp3_file'))
                    <p class="alert-danger">
                        {{$errors->first('mp3_file')}}
                    </p>
                @endif
            </div>
            <div>
                <input type="submit" class="btn btn-success" value="Cập Nhật">
                <a href="{{route('users.showMyLibrary')}}">
                    <input type="button" class="btn btn-secondary" value="Quay lại">
                </a>
            </div>
        </form>
    </div>
@endsection
