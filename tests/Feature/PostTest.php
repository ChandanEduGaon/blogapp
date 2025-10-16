<?php

namespace Tests\Feature;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/post/create', [
            'title' => 'My First Post',
            'content' => 'This is content',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('posts', [
            'title' => 'My First Post',
            'user_id' => $user->id,
        ]);
    }


    public function test_user_can_update_post()
    {
        $user = User::factory()->create();
        $post = Posts::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);

        $response = $this->post("/post/update", [
            'post_id' => $post->id,
            'title' => 'Updated Title',
            'content' => 'Updated Content',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('posts', ['title' => 'Updated Title']);
    }
}
