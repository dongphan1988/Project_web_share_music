<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use DatabaseMigrations;

     public function testShowFormLogin()
     {
         $response = $this->get(route('login'));
         $response->assertStatus(200);
         $response->assertViewIs('auth.login');
     }


     public function testLoginFail()
     {

         $user = $this->createUserAdmin();
         $data = [
             'email' => $user->email,
             'password' => '12345678'
         ];
         $response = $this->from('/login')->post('/login', $data);
         $response->assertStatus(200);
         $response->assertRedirect('/login');
         $response->assertSessionHasErrors('email');
     }

     public function testLogin()
     {
         $user = $this->createUserAdmin();
         $data = [
             'email' => $user->email,
             'password' => $user->password
         ];
         $response = $this->post('/login', $data);
         $response->assertRedirect('/');
     }



}
