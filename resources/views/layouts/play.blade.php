<div id="musicBar" class="container-fluid col-md-12 col-12 footer fixed-bottom">
    <audio id="songAudio" hidden src="" controls></audio>

    {{--LIST MUSIC--}}
    <div class="pb-5">
        <ul id="listSong">
            @if(isset($songs))
                @foreach($songs as $song)
                        <li image="{{$song->image}}" song="{{$song->mp3_file}}">{{$song->name}}</li>
                @endforeach
            @endif
        </ul>
    </div>

    {{--MUSIC BAR--}}
    <div class="footer">
        <div class="col-md-12 col-12 row">
            <div class="col-md-2 offset-1 pt-2 text-center">
                <i class="fas fa-backward fa-2x pr-3"></i>
                <i class="fas fa-play fa-2x pr-3"></i>
                <i class="fas fa-pause fa-2x pr-3"></i>
                <i class="fas fa-fast-forward fa-2x pr-3"></i>
            </div>

            <div class="col-md-6 row pt-sm-1">
                <div class="col-md-1 pl-0 pr-0">
                    <img src="" id="song-img-footer">
                </div>
                <div class="col-md-11">
                    <div class="col-md-12 row pl-0 mb-1">
                        <div class="col-7 pl-0">
                            <strong>
                                <div id="song-name-footer"></div>
                            </strong>
                        </div>
                        <div class="col-md-4 row">
                            <div id="songCurrentTime" onchange="processProgressTime()"><strong>00:00</strong></div>
                            <div id="songDurationTime" onchange="processProgressTime()"><strong>|00:00</strong></div>
                        </div>
                    </div>

                    <div class="col-md-12 row pl-0">
                        <div id="songProgress" onchange="processProgressBar()">
                            <div id="songBar"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 pt-3 pl-0">
                <i class="fas fa-volume-up fa-lg pr-2"></i>
                <i class="fas fa-heart fa-lg pr-2"></i>
                <i class="fas fa-list fa-lg"></i>
            </div>
        </div>
    </div>
</div>
