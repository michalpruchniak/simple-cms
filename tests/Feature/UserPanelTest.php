<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserPanelTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_has_permission_to_create_article()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
                         ->get('panel/article/create');

        $response->assertStatus(200);
    }

    public function test_admin_has_permission_to_create_article()
    {
        $user = User::factory()->make([
            'admin' => 1
        ]);
        $response = $this->actingAs($user)
                         ->get('panel/article/create');

        $response->assertStatus(200);
    }

    public function test_guest_hasnt_permission_to_create_article()
    {
        $response = $this->get('panel/article/create');

        $response->assertStatus(302);
    }

    public function test_store_article()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->json('POST', '/panel/article/store', [
            'user_id' => 1,
            'title'   => 'Hello. This is my first article',
            'description' => 'Hello World. This is Anonymous',
            'category' => 1,

        ]);

        $response->assertStatus(200);
    }
}
