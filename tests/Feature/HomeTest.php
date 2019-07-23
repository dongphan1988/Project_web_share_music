<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Song;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $response = $this->get('my-library');
        $response->assertRedirect('/login');
    }

    public function testViewHomeAsEmptySongs()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('home');
        $response->assertSeeText('New Playlist');
        $response->assertSeeText('Không tìm thấy bài hát trong hệ thống');
    }

    public function testViewHomeAsEmptyPlaylist()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('home');
        $response->assertSeeText('New Playlist');
        $response->assertSeeText('Không tìm thấy danh sách bài hát trong hệ thống');
    }

    public function testViewHomeSuccess()
    {
        $admin = $this->createUserAdmin();

        $song = $this->createSong();

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('home');
        $response->assertSeeText($song->name);
    }
}
