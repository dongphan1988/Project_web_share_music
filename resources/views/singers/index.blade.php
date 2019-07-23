@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <h1>List Singers</h1>

                    <nav class="navbar navbar-light">
                        <form class="form-inline" action="{{route('singer.searchByName')}}" method="get">
                            @csrf
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="input-group-text"><i class="fas fa-search"></i></button>
                                </div>
                                <input type="text" class="form-control" name="keyword" placeholder="Search Singer"
                                       aria-label="Username" aria-describedby="basic-addon1"
                                       value="{{(isset($_GET['keyword']) ? $_GET['keyword']: '')}}">
                            </div>
                        </form>
                    </nav>
                </div>
            </div>

            <div class="container row mt-3">
                @foreach($singers as $singer)
                    <div class="col-md-3">
                        <div class="col-album-circle">
                            @if($singer->image == null)
                                <img
                                    src="{{asset('images/audio_default.png')}}"
                                    class="rounded-circle mx-4 mb-2" width="190px" height="190px">
                            @else
                                <img
                                    src="https://music-project-laravel.s3-ap-northeast-1.amazonaws.com/{{$singer->image}}"
                                    class="rounded-circle mx-4 mb-2" width="190px" height="190px">
                            @endif
                        </div>
                        <div class="text-center mb-3">
                            <a href="{{route('singers.showSongSinger', $singer->id)}}">{{$singer->name}}</a>
                        </div>
                    </div>
                @endforeach
            </div>
            {{$singers->links()}}
        </div>
    </div>
@endsection
