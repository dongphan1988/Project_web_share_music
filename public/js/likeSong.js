$("document").ready(function () {
    $('.likeSong').click(function () {
        songId = event.target.parentNode.parentNode.dataset['songid'];
        let like = '#likeSong' + songId;
        let dislike = '#dislikeSong' + songId;
        $(like).hide();
        $(dislike).show();
        $.ajax({
            method: 'get',
            url: localUrl + 'my-library/songs/like/' + songId,
            success: function (datajson) {
            },
            error: function () {
                console.log('error')
            }
        })
    });
    $('.dislikeSong').click(function () {
        songId = event.target.parentNode.parentNode.dataset['songid'];
        let like = '#likeSong' + songId;
        let dislike = '#dislikeSong' + songId;
        $(dislike).hide();
        $(like).show();
        $.ajax({
            method: 'get',
            url: localUrl + 'my-library/songs/dislike/' + songId,
            success: function (datajson) {
            },
            error: function () {
                console.log('error')
            }
        })
    });
});
