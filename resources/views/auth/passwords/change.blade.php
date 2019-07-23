@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Thay đổi mật khẩu') }}</div>

                    <div class="panel-body">


                    <div class="card-body">
                        <form method="post" action="{{route('post.pass')}}">
                            @csrf

                            <div class="form-group row {{ $errors->has('current-password') ? ' has-error' : '' }}">
                                <label for=""
                                       class="col-md-4 col-form-label text-md-right">{{ __('Mật khẩu cũ') }}</label>

                                <div class="col-md-6">
                                    <input id="" type="password"
                                           class="form-control" name="current-password"
                                           value="" required autocomplete="name" autofocus>
                                    @if(session('pass-error'))
                                        <p class="text-danger">{{session('pass-error')}}</p>
                                        @endif
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('current-password') ? ' has-error' : '' }}">
                                <label for=""
                                       class="col-md-4 col-form-label text-md-right">{{ __('Mật khẩu mới') }}</label>

                                <div class="col-md-6">
                                    <input id="" type="password"
                                           class="form-control" name="new-password"
                                           value="">
                                    @if($errors->has('new-password'))
                                        <p class="text-danger">{{$errors->first('new-password')}}</p>
                                        @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Xác nhận mật khẩu mới') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control" name="password-confirmation"
                                           required autocomplete="new-password">
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Lưu thay đổi') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection