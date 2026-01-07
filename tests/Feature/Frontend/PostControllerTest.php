<?php

namespace Tests\Feature\Frontend;

use App\Models\Post;
use App\Models\User;
use App\Services\PostCacheService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_guest_cannot_store_post()
    {
        $this->post(route('posts.store'), [
            'title' => 'Test',
            'content' => 'Test',
        ])->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_view_create_post_page()
    {
        $user = User::factory()->create();
        $user->assignRole('user');

        $this->actingAs($user)
            ->get(route('posts.create'))
            ->assertStatus(200)
            ->assertViewIs('frontend.posts.create');
    }

    public function test_guest_cannot_view_create_post_page()
    {
        $this->get(route('posts.create'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_store_a_post()
    {
        $user = User::factory()->create();
        $user->assignRole('user');

        // Mock PostCacheService
        $this->mock(PostCacheService::class, function ($mock) {
            $mock->shouldReceive('clearPostList')->once();
        });

        $response = $this->actingAs($user)->post(route('posts.store'), [
            'title'   => 'Test Post',
            'content' => 'This is a test post content',
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('status', 'Post published!');

        $this->assertDatabaseHas('posts', [
            'title'   => 'Test Post',
            'user_id' => $user->id,
        ]);
    }

    public function test_store_post_requires_title_and_content()
    {
        $user = User::factory()->create();
        $user->assignRole('user');

        $this->actingAs($user)
            ->post(route('posts.store'), [])
            ->assertSessionHasErrors(['title', 'content']);
    }

    public function test_non_owner_cannot_edit_post()
    {
        $owner = User::factory()->create();
        $owner->assignRole('user');
        $other = User::factory()->create();
        $other->assignRole('user');

        $post = Post::factory()->create(['user_id' => $owner->id]);

        $this->actingAs($other)
            ->get(route('posts.edit', $post))
            ->assertStatus(403);
    }

    public function test_post_owner_can_update_post()
    {
        $user = User::factory()->create();
        $user->assignRole('user');
         // Mock PostCacheService
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)
            ->put(route('posts.update', $post), [
                'title'   => 'Updated Title',
                'content' => 'Updated content',
            ]);

        $response->assertRedirect(route('posts.show', $post));
        $response->assertSessionHas('status', 'Post updated successfully!');

        $this->assertDatabaseHas('posts', [
            'id'    => $post->id,
            'title' => 'Updated Title',
        ]);
    }

    public function test_non_owner_cannot_update_post()
    {
        $owner = User::factory()->create();
        $owner->assignRole('user');
        $other = User::factory()->create();
        $other->assignRole('user');

        $post = Post::factory()->create(['user_id' => $owner->id]);

        $this->actingAs($other)
            ->put(route('posts.update', $post), [
                'title'   => 'Hack Attempt',
                'content' => 'Nope',
            ])
            ->assertStatus(403);
    }

    public function test_post_owner_can_delete_post()
    {
        $user = User::factory()->create();
        $user->assignRole('user');
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)
            ->delete(route('posts.destroy', $post));

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('status', 'Post deleted successfully!');

        //check if softdeleted
        $this->assertSoftDeleted('posts', [
            'id' => $post->id,
        ]);
    }
    
    public function test_non_owner_cannot_delete_post()
    {
        $owner = User::factory()->create();
        $owner->assignRole('user');
        $other = User::factory()->create();
        $other->assignRole('user');

        $post = Post::factory()->create(['user_id' => $owner->id]);

        $this->actingAs($other)
            ->delete(route('posts.destroy', $post))
            ->assertStatus(403);
    }


}
