<?php

namespace Tests\Feature;

use App\User;
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
}
