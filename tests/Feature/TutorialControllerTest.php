<?php

namespace Tests\Feature;

use App\User;
use App\Tutorial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TutorialControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testTutorialIndex()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('tutorials.index'));

        $response->assertStatus(200)->assertViewIs('tutorials.index');
    }

    public function testTutorialStore()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(route('tutorials.store'), [
            'title' => 'タイトル'
        ]);

        $response->assertStatus(200);
    }

    public function testTutorialDestroy()
    {
        $user = factory(User::class)->create();

        $tutorial = factory(Tutorial::class)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete(route('tutorials.destroy', ['tutorial' => $tutorial->id]));

        $response->assertStatus(200);
    }

    public function testTutorialStatus()
    {
        $user = factory(User::class)->create();

        $tutorial = factory(Tutorial::class)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->patch(route('tutorials.status', ['tutorial' => $tutorial->id]), [
            'status' => random_int(1, 3)
        ]);

        $response->assertStatus(200);
    }
}
