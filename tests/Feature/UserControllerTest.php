<?php

namespace Tests\Feature;

use App\User;
use App\Roadmap;
use App\Tutorial;
use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testUserShow()
    {
        $user = factory(User::class)->create();
        $roadmap = factory(Roadmap::class)->create(['user_id' => $user->id]);
        $tutorial = factory(Tutorial::class)->create(['user_id' => $user->id]);
        $task = factory(Task::class)->create(['tutorial_id' => $tutorial->id]);

        $response = $this->actingAs($user)->get(route('users.show', ['name' => $user->name]));

        $response->assertStatus(200);
    }

    public function testUserlikes()
    {
        $user = factory(User::class)->create();
        $roadmap = factory(Roadmap::class)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get(route('users.likes', ['name' => $user->name]));

        $response->assertStatus(200);
    }

    public function testUserFollowings()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('users.followings', ['name' => $user->name]));

        $response->assertStatus(200);
    }

    public function testUserFollowers()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('users.followers', ['name' => $user->name]));

        $response->assertStatus(200);
    }

    public function testUserFollow()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $response = $this->actingAs($user1)->put(route('users.follow', ['name' => $user2->name]));

        $response->assertStatus(200);
    }

    public function testUserUnFollow()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $this->actingAs($user1)->put(route('users.follow', ['name' => $user2->name]));

        $response = $this->actingAs($user1)->delete(route('users.unfollow', ['name' => $user2->name]));

        $response->assertStatus(200);
    }
}
