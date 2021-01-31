<?php

namespace Tests\Feature;

use App\User;
use App\Comment;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChatControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
     // 未ログイン時
    public function testGuestCreate()
    {
        $response = $this->get(route('chats.index'));

        $response->assertRedirect(route('login'));
    }
    //ログイン時
    use DatabaseTransactions;
    public function testExample()
    {
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)
        ->get('/chats');

        $response->assertStatus(200)
        ->assertViewIs('chats.index');
    }
    
    // public function testChatAdd()
    // {
    //     $comment = factory(Comment::class)->create();
    //       $this->assertDatabaseHas('comments', $comment);
    // }
}
