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

  public function testTaskUpdate(){
    $user = factory(User::class)->create();
    $tutorial = factory(Tutorial::class)->create(['user_id' => $user->id]);
    $task = factory(Task::class)->create(['tutorial_id'=> $tutorial->id]);

    $response = $this->actingAs($user)->patch(route('tasks.update'), [ 
      'displayTutorialId' => 1,
      'id' => 35,
      'newIndex' => 0,
      'oldIndex' => 2,
      'status' => 2,
      'tasks' => ['status'=>1,['tasks' => ['created_at' => '2021-04-16 17:33:50','id' => 35,'name' => "6",'order' => 2,'status'=>1,'tutorial_id'=>1,'updated_at'=> '2021-04-16 17:33:50'],'title'=>"Todo",'tutorial_id'=>1]]
    ]);

    $response->assertStatus(200);
  }
}
