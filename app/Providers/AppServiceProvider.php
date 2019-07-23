<?php

namespace App\Providers;

use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\CommentRepositoryInterface;
use App\Repositories\Impl\CategoryRepositoryImpl;
use App\Repositories\Impl\CommentRepositoryImpl;
use App\Repositories\Impl\LikeRepositoryImpl;
use App\Repositories\Impl\ModeRepositoryImpl;
use App\Repositories\Impl\PlaylistRepositoryImpl;
use App\Repositories\Impl\SingerRepositoryImpl;
use App\Repositories\Impl\UserRepositoryImpl;
use App\Repositories\LikeRepositoryInterface;
use App\Repositories\ModeRepositoryInterface;
use App\Repositories\PlaylistRepositoryInterface;
use App\Repositories\SingerRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Service\CategoryServiceInterface;
use App\Service\CommentServiceInterface;
use App\Service\Impl\CategoryServiceImpl;
use App\Service\Impl\CommentServiceImpl;
use App\Service\Impl\LikeServiceImpl;
use App\Service\Impl\ModeServiceImpl;
use App\Service\Impl\PlaylistServiceImpl;
use App\Service\Impl\SingerServiceImpl;
use App\Service\Impl\UserServiceImpl;
use App\Service\LikeServiceInterface;
use App\Service\ModeServiceInterface;
use App\Service\PlaylistServiceInterface;
use App\Service\SingerServiceInterface;
use App\Service\UserServiceInterface;
use App\Repositories\Impl\SongRepositoryImpl;
use App\Repositories\SongRepositoryInterface;
use App\Service\Impl\SongService;
use App\Service\SongServiceInterface;
use Illuminate\Support\ServiceProvider;
//use URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserRepositoryInterface::class, UserRepositoryImpl::class);
        $this->app->singleton(UserServiceInterface::class, UserServiceImpl::class);
        $this->app->singleton(SongRepositoryInterface::class, SongRepositoryImpl::class);
        $this->app->singleton(SongServiceInterface::class, SongService::class);
        $this->app->singleton(ModeRepositoryInterface::class,ModeRepositoryImpl::class);
        $this->app->singleton(ModeServiceInterface::class,ModeServiceImpl::class);
        $this->app->singleton(PlaylistRepositoryInterface::class,PlaylistRepositoryImpl::class);
        $this->app->singleton(PlaylistServiceInterface::class,PlaylistServiceImpl::class);
        $this->app->singleton(CommentRepositoryInterface::class,CommentRepositoryImpl::class);
        $this->app->singleton(CommentServiceInterface::class,CommentServiceImpl::class);
        $this->app->singleton(SingerServiceInterface::class,SingerServiceImpl::class);
        $this->app->singleton(SingerRepositoryInterface::class,SingerRepositoryImpl::class);
        $this->app->singleton(LikeRepositoryInterface::class,LikeRepositoryImpl::class);
        $this->app->singleton(LikeServiceInterface::class,LikeServiceImpl::class);
        $this->app->singleton(CategoryRepositoryInterface::class,CategoryRepositoryImpl::class);
        $this->app->singleton(CategoryServiceInterface::class,CategoryServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        URL::forceScheme('https');
    }
}
