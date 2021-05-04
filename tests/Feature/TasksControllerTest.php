<?php

namespace Tests\Feature;

use App\User;
use App\UploadImage;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TasksControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function testGuestTasksIndex()
    {
        $image = factory(UploadImage::class)->create();
        $response = $this->get(route('tasks.index', ['id' => $image->id]));

        $response->assertRedirect(route('login'));
    }
    public function testAuthTasksIndex()
    {
        $user = factory(User::class)->create();
        $image = factory(UploadImage::class)->create();
        $response = $this->actingAs($user)
        ->get(route('tasks.index', ['id' => $image->id]));

        $response->assertStatus(200)
            ->assertViewIs('tasks.index')
            ->assertSee('タスク');
    }
    
    public function testGuestTasksCreate()
    {
        $image = factory(UploadImage::class)->create();
        $response = $this->get(route('tasks.create', ['id' => $image->id]));

        $response->assertRedirect(route('login'));
    }
    
    public function testAuthTasksCreate()
    {
        $user = factory(User::class)->create();
        $image = factory(UploadImage::class)->create();
        $response = $this->actingAs($user)
        ->get(route('tasks.create', ['id' => $image->id]));

        $response->assertStatus(200)
            ->assertViewIs('tasks.create')
            ->assertSee('タスクを追加する');
    }
}
