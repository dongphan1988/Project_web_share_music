<?php
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

// PUBLIC ROUTE SONGS
Route::prefix('songs')->group(function () {
    Route::get('/', 'SongController@getListNewSong')->name('songs.getListNewSong');
    Route::get('/show/{id}', 'SongController@show')->name('songs.show');
    Route::get('/search/by-name', 'SongController@searchByName')->name('songs.searchByName');
    Route::get('/most-heard-songs', 'SongController@showMostHearSongs')->name('songs.mostSong');
});

// PUBLIC ROUTE PLAYLISTS
Route::group(['prefix' => 'playlists'], function () {
    Route::get('/', 'PlaylistController@getPublicPlaylist')->name('playlists.getPublicPlaylist');
    Route::get('show/{id}', 'PlaylistController@show')->name('playlists.show');
    Route::get('search', 'PlaylistController@searchPlaylistPublic')->name('playlists.search');
});

// PUBLIC ROUTE SINGERS
Route::group(['prefix' => 'singers'], function () {
    Route::get('/', 'SingerController@index')->name('singers.index');
    Route::get('/show-song-singer/{id}', 'SingerController@showSongSinger')->name('singers.showSongSinger');
});

Route::group(['middleware' => ['auth']], function () {
    // ADMIN ROUTE
    Route::prefix('admin')->group(function () {
        Route::get('', 'AdminController@index')->name('admin.index');
        Route::get('/showUser', 'AdminController@showUser')->name('admin.showUser');
    });
    // USER ROUTE
    Route::prefix('my-library')->group(function () {
        Route::get('/', 'UserController@showMyLibrary')->name('users.showMyLibrary');

        // SONG ROUTE
        Route::group(['prefix' => 'songs'], function () {
            Route::get('/', 'SongController@showListSongByUserId')->name('songs.list');
            Route::get('create/', 'SongController@create')->name('songs.create');
            Route::post('create/', 'SongController@store')->name('songs.store');
            Route::get('update/{id}', 'SongController@edit')->name('songs.edit');
            Route::post('update/{id}', 'SongController@update')->name('songs.update');
            Route::get('delete/{id}', 'SongController@delete')->name('songs.delete');
            Route::get('like/{id}', 'SongController@like')->name('songs.like');
            Route::get('dislike/{id}', 'SongController@dislike')->name('songs.dislike');
            Route::post('comment/{id}', 'CommentController@createInSong')->name('comment.createInSong');
            Route::post('add-category/{id}', 'SongController@addCategory')->name('songs.addCategory');
        });

        Route::get('password/', 'Auth\ChangePasswordController@changePassword')->name('change.pass');
        Route::post('password', 'Auth\ChangePasswordController@changePasswordUser')->name('post.pass');

        Route::group(['prefix' => 'profile'], function () {
            Route::get('/{id}', 'UserController@index')->name('user.index');
            Route::get('update/{id}', 'UserController@editProfile')->name('user.edit');
            Route::post('update/{id}', 'UserController@updateProfile')->name('user.update');
        });

        // PLAYLIST ROUTE
        Route::group(['prefix' => 'playlists'], function () {
            Route::get('/', 'PlaylistController@index')->name('playlists.index');
            Route::get('create/', 'PlaylistController@create')->name('playlists.create');
            Route::post('create/', 'PlaylistController@store')->name('playlists.store');
            Route::get('edit/{id}', 'PlaylistController@edit')->name('playlists.edit');
            Route::post('update/{id}', 'PlaylistController@update')->name('playlists.update');
            Route::get('song/destroy/{songId}/{playlistId}', 'PlaylistController@deleteSongPlaylist')->name('playlists.deleteSongPlaylist');
            Route::post('add/{id}', 'PlaylistController@addSong')->name('playlists.add');
            Route::post('createNewPlaylistAndAddSong/{id}', 'PlaylistController@createNewPlaylistAndAddSong')->name('playlists.createNewPlaylistAndAddSong');
            Route::post('comment/{id}', 'CommentController@createInPlaylist')->name('comment.createInPlaylist');
            Route::get('dislike/{id}', 'PlaylistController@dislike')->name('playlists.dislike');
            Route::get('like/{id}', 'PlaylistController@like')->name('playlists.like');
        });

        // SINGER ROUTE
        Route::group(['prefix' => 'singers'], function () {
            Route::get('show', 'SingerController@index')->name('singer.show');
            Route::get('create', 'SingerController@create')->name('singer.create');
            Route::post('create', 'SingerController@store')->name('singer.store');
            Route::post('addsong', 'SingerController@addSong')->name('singer.addSong');
            Route::get('songsinger/{songId}/{singerId}', 'SingerController@deleteSongInSinger')->name('singer.deleteSongsinger');
            Route::get('search', 'SingerController@searchByName')->name('singer.searchByName');
            Route::post('comment/{id}', 'CommentController@createInSinger')->name('comment.createInSinger');
            Route::get('my-singer/', 'SingerController@mySinger')->name('singer.mySinger');
        });
    });
});


