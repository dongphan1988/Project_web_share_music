let songUrl;
let imgUrl;
let nameUrl;
let baseUrl = "https://music-project-laravel.s3-ap-northeast-1.amazonaws.com/";
let songAudio = $("#songAudio").get(0);
let imgAudio = $("#song-img-footer").get(0);
const SONG_URL = 0;
const IMAGE_URL = 1;
const NAME_URL = 2;
let localUrl = window.location.protocol + "//" + window.location.hostname + (window.location.port ?":":"" ) + window.location.port + "/";

$(document).ready(function () {
    //Hide Component
    $(".fa-pause").hide();
    $("#musicBar").hide();
    $("#song-img-footer").hide();
    $("#listSong").hide();

    //Click Image To Play
    $(".play-music, #song-img").click(function () {
        $("#musicBar").show();
        songAudio.src = songUrl;
        playSong();
    });

    //Pause button
    $(".fa-pause").click(function () {
        songAudio.pause();
        $(".fa-pause").hide();
        $(".fa-play").show();
    });

    //Play button
    $(".fa-play").click(function () {
        songAudio.play();
        $(".fa-play").hide();
        $(".fa-pause").show();
    });

    let first = $('#listSong li:first-child');
    let last = $('#listSong li:last');

    function nextSong() {
        let next, selected = $(".selected");

        next = selected.next('li').length ? selected.next('li') : first;
        selected.removeClass("selected");
        next.addClass('selected');

        songAudio.src = baseUrl + next.attr("song");
        if (next.attr("image") === "")
            imgAudio.src = localUrl + "images/audio_default.png";
        else
            imgAudio.src = baseUrl + next.attr("image");
        imgUrl = imgAudio.src;
        nameUrl = next.text();

        playSong();
        $("#musicBar").show();
    }

    //Auto Next Track
    songAudio.onended = function () {
        nextSong();
    };

    // Next Button & Play All List Button
    $(".fa-fast-forward, #listen-all-playlist").click(function () {
        nextSong();
    });

    // Previous Button
    $(".fa-backward").click(function () {
        let prev, selected = $(".selected");

        prev = selected.prev('li').length ? selected.prev('li') : last;
        selected.removeClass("selected");
        prev.addClass('selected');

        songAudio.src = baseUrl + prev.attr("song");
        if (prev.attr("image") === "")
            imgAudio.src = localUrl + "images/audio_default.png";
        else
            imgAudio.src = baseUrl + prev.attr("image");
        imgUrl = imgAudio.src;
        nameUrl = prev.text();

        playSong();
    });

    $(".fa-list").click(function () {
        $("#listSong").toggle();
    });

    $(".fa-heart").click(function () {
        $("#musicBar").hide();
    });

    $("#songProgress").click(function (e) {
        let max = $(this).width(); //Get width element
        let position = e.pageX - $(this).offset().left; //Position cursor
        let width = Math.round(position / max * 100);
        songAudio.currentTime = (width * songAudio.duration) / 100;
    });
});

// Click Image To Get Url
function getSongInfo(arrayUrl) {
    songUrl = baseUrl + arrayUrl[SONG_URL];
    if (arrayUrl[IMAGE_URL] === "")
        imgUrl = localUrl + 'images/audio_default.png';
    else
        imgUrl = baseUrl + arrayUrl[IMAGE_URL];
    nameUrl = arrayUrl[NAME_URL];
    console.log(imgUrl);
}

// Onchange Progress Music Bar
function processProgressBar() {
    let progressBar = $("#songBar")[0];
    let width = "";
    let progressChange = setInterval(frame, 100);

    function frame() {
        if (width >= 100) {
            clearInterval(progressChange);
        } else {
            width = (songAudio.currentTime / songAudio.duration) * 100;
            progressBar.style.width = width + '%';
        }
    }
}

// Onchange Progress Music Time
function processProgressTime() {
    let secondChange = setInterval(frame, 100);

    function frame() {
        if (songAudio.currentTime >= songAudio.duration) {
            clearInterval(secondChange);
        } else {
            let minute = parseInt((songAudio.currentTime / 60) % 60);
            if (minute < 10) {
                minute = '0' + String(minute);
            }

            let second = parseInt(songAudio.currentTime % 60);
            if (second < 10) {
                second = '0' + String(second);
            }
            $("#songCurrentTime").html(minute + ':' + second);

            let minuteDuration = parseInt((songAudio.duration / 60) % 60);
            if (minuteDuration < 10) {
                minuteDuration = '0' + String(minuteDuration);
            }

            let secondDuration = parseInt(songAudio.duration % 60);
            if (secondDuration < 10) {
                secondDuration = '0' + String(secondDuration);
            }
            $("#songDurationTime").html("|" + minuteDuration + ':' + secondDuration);
        }
    }
}

// Play Function
function playSong() {
    songAudio.play();
    $(".fa-play").hide();
    $(".fa-pause").show();
    $("#song-img-footer").removeAttr("src").attr("src", imgUrl).show();
    $("#songProgress").change();
    $("#songCurrentTime").change();
    $("#songDurationTime").change();
    $("#song-name-footer").html(nameUrl);
}
