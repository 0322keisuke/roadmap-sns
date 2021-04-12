<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoadmapControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get(route('roadmaps.index'));

        $response->assertStatus(200)->assertViewIs('roadmaps.index');
    }

    public function testGuestCreate()
    {
        $response = $this->get(route('roadmaps.create'));

        $response->assertRedirect(route('login'));
    }

    public function testAuthCreate()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('roadmaps.create'));

        $response->assertStatus(200)->assertViewIs('roadmaps.create');
    }

    public function testAuthStore()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(route('roadmaps.store'), [
            'title' => 'タイトル',
            'tutorial_task_names' => '[{"title":"5","tasks":["7","7"]},{"title":"6","tasks":["8","8"]}]',
            'body' => '本文',
            'estimated_time' => '5',
            'level' => '3'
        ]);


        $response->assertRedirect(route('roadmaps.index'));
    }
}
