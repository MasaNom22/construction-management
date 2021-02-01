<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    // 未ログイン時
    public function testGuestIndex()
    {
        $response = $this->get(route('users.index'));

        $response->assertRedirect(route('login'));
    }
}
