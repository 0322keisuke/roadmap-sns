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
}
