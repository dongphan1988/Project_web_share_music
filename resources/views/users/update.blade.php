@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Update Your Profile') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.update', ['id' => $user->id]) }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-md-8">
                                    <div class="form-group row">
                                        <input type="hidden" id="id" name="id" class="form-control" value="{{$user->id}}">
                                    </div>
                                    <div class="form-group row">
                                        <label for="name"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Họ và Tên') }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text"
                                                   class="form-control" name="name"
                                                   value="{{$user->name}}" required autocomplete="name" autofocus>
                                            @if($errors->has('name'))
                                                <p class="alert-danger">{{$errors->first('name')}}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email"
                                                   class="form-control" name="email"
                                                   value="{{ $user->email }}" autocomplete="email">
                                            @if($errors->has('email'))
                                                <p class="alert-danger">{{$errors->first('email')}}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Ngày sinh') }}</label>

                                        <div class="col-md-6">
                                            <input id="birthday" type="date"
                                                   class="form-control" name="birthday"
                                                   value="{{ $user->birthday}}" required autocomplete="new-birthday">
                                            <span class="invalid-feedback" role="alert">
                                    </span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="gender"
                                               class="col-md-4 col-form-label text-md-right">{{__('Giới tính')}}</label>

                                        <div class="col-md-6" id="gender">
                                            <select class="form-control" id="gender" name="gender">
                                                <option value="Nam" {{$user->gender == "Nam" ? "selected":""}}>Nam</option>
                                                <option value="Nữ" {{$user->gender == "Nữ" ? "selected":""}}>Nữ</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">{{__('Ảnh đại diện')}}</label>

                                        <div class="col-md-6">
                                            <input type="file" id="image" name="image" value="{{ $user->image}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="update"
                                               class="col-md-4 col-form-label text-md-right">{{__('')}}</label>

                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Cập Nhật') }}
                                            </button>

                                            <a href="{{route('user.index',$user->id)}}">
                                                <button type="button" class="btn btn-primary">
                                                    Quay Lại
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div class="form-group row">
                                        <div class="col-12">
                                            @if($user->image == null)
                                                <img
                                                    src="{{asset('images/audio_default.png')}}"
                                                    class="rounded-circle" width="200px">
                                            @else
                                                <img
                                                    src="https://music-project-laravel.s3-ap-northeast-1.amazonaws.com/{{$user->image}}"
                                                    class="rounded-circle" width="200px">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
