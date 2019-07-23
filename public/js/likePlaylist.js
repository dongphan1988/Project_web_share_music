$("document").ready(function () {
    $('.likePlaylist').click(function () {
        playlistId = event.target.parentNode.parentNode.dataset['playlistid'];
        let like = '#likePlaylist' + playlistId;
        let dislike = '#dislikePlaylist' + playlistId;
        $(like).hide();
        $(dislike).show();
        $.ajax({
            method: 'get',
            url: localUrl + 'my-library/playlists/like/' + playlistId,
            success: function (datajson) {
            },
            error: function () {
                console.log('error')
            }
        })
    });
    $('.dislikePlaylist').click(function () {
        playlistId = event.target.parentNode.parentNode.dataset['playlistid'];
        let like = '#likePlaylist' + playlistId;
        let dislike = '#dislikePlaylist' + playlistId;
        $(dislike).hide();
        $(like).show();
        $.ajax({
            method: 'get',
            url: localUrl + 'my-library/playlists/dislike/' + playlistId,
            success: function (datajson) {
            },
            error: function () {
                console.log('error')
            }
        })
    });
});
