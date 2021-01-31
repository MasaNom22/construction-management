<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ImageTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function signup()
    {
        $response = $this->get(route('signup.get'));

        $response->assertStatus(200)
            ->assertViewIs('auth.register');
    }
    /** @test */
    public function login()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200)
            ->assertViewIs('auth.login');
    }
    
}
