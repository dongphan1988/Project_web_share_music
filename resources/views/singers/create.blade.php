@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Đăng ký</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('singer.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
 				<div class="form-group">
                                    <input type="text" hidden name="user_id" value="{{Auth::id()}}" class="form-control">
                                </div>
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">Họ và tên</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Ảnh đại diện</label>

                                <div class="col-md-6">
                                    <input type="file" id="image" name="image">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Đăng ký
                                    </button>
{{--                                    <a href="{{route('singer.show')}}">--}}
{{--                                        <button type="button" class="btn btn-primary">--}}
{{--                                            Quay lại--}}
{{--                                        </button>--}}
{{--                                    </a>--}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
