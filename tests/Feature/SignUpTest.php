<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ImageTest extends TestCase
{
    
    /** @test */
    public function signup()
    {
        $response = $this->get(route('signup.get'));

        $response->assertStatus(200)
            ->assertViewIs('auth.register')
            ->assertSee('新規登録');
    }
    /** @test */
    public function login()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200)
            ->assertViewIs('auth.login')
            ->assertSee('ログイン');
    }
    
    // 未ログイン時
    public function testGuestSignUpUsers()
    {
        $response = $this->get(route('signup.get2'));

        $response->assertRedirect(route('login'));
    }
    //ログイン時
    use DatabaseTransactions;
    public function testAuthSignUpUsers()
    {
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)
        ->get(route('signup.get2'));

        $response->assertStatus(200)
            ->assertViewIs('auth.register2')
            ->assertSee('業者新規登録');
    }
}
