<?php

namespace Tests\Feature;

use App\User; 
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ImageListController extends TestCase
{
     // 未ログイン時
    public function testGuestCreate()
    {
        $response = $this->get(route('image_list'));

        $response->assertRedirect(route('login'));
    }
    //ログイン時
    use DatabaseTransactions;
    public function testExample()
    {
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)
        ->get('/list');
        //$response = $this->get('/list');

        $response->assertStatus(200)
            ->assertViewIs('image_list');
    }
}
