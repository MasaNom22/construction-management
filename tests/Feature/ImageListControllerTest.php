<?php

namespace Tests\Feature;

use App\User;
use App\UploadImage;
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

        $response->assertStatus(200)
            ->assertViewIs('image_list');
    }
    
    // 未ログイン時
    public function testGuestUpload()
    {
        $response = $this->get(route('upload_form'));

        $response->assertRedirect(route('login'));
    }
    //ログイン時
    use DatabaseTransactions;
    public function testAuthUpload()
    {
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)
        ->get(route('upload_form'));

        $response->assertStatus(200)
            ->assertViewIs('upload_form')
            ->assertSee('現場画像登録画面');
    }
}
