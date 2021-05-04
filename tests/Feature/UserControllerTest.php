<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    // 未ログイン時
    public function testGuestIndex()
    {
        $response = $this->get(route('users.index'));

        $response->assertRedirect(route('login'));
    }
    //ログイン時
    
    public function testAuthIndex()
    {
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)
        ->get(route('users.index'));

        $response->assertStatus(200)
            ->assertViewIs('users.index')
            ->assertSee('下請業者一覧');
    }
    
    public function testGuestCsvdownload()
    {
        $response = $this->get(route('users.CsvDownload'));

        $response->assertRedirect(route('login'));
    }
}
