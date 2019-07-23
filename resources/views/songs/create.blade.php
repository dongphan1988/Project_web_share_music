@extends('layouts.app')
@section('content')
    <div class="row container offset-3">
        <form action="{{route('songs.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <h1 class="text-center">Tạo Bài Nhạc Mới</h1>
            <div class="form-group">
                <input type="text" hidden name="user_id" value="{{$userId}}" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-group">Tên Bài Hát</label>
                <input type="text" name="name" class="form-control">
                @if($errors->has('name'))
                    <p class="alert-danger">
                        {{$errors->first('name')}}
                    </p>
                @endif
            </div>

            <div class="form-group">
                <label class="form-group">Lời Bài Hát</label>
                <textarea rows="4" cols="50" type="text" name="lyric" class="form-control"></textarea>
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
                <input type="submit" class="btn btn-success" value="Tạo Mới">
                <a href="{{route('users.showMyLibrary')}}">
                    <input type="button" class="btn btn-secondary" value="Quay Lại">
                </a>
            </div>
        </form>
    </div>
@endsection
