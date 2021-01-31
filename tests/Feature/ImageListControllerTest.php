<?php

namespace Tests\Feature;

use App\User; 
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ImageListController extends TestCase
{
    
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
