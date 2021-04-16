<?php

namespace Tests\Feature;

use App\User;
use App\Tutorial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
  use RefreshDatabase;

  public function testTaskStore()
  {
    $user = factory(User::class)->create();
    $tutorial = factory(Tutorial::class)->create(['user_id' => $user->id]);

    $response = $this->actingAs($user)->post(route('tasks.store'), [
      'name' => '新しいタスクName',
      'status' => '1',
      'tutorial_id' => $tutorial->id
    ]);

    $response->assertStatus(200);
  }
}
