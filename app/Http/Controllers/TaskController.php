<?php

namespace App\Http\Controllers;

use App\Tutorial;
use App\Task;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function store(TaskRequest $request, Task $task)
    {
        $task->name = $request->name;
        $task->tutorial_id = $request->tutorial_id;
        $task->order = 1;
        $task->status = $request->status;
        $task->save();

        $tutorials = Auth::user()->tutorials()->orderBy('created_at')->get();

        $tasks = [];

        foreach ($tutorials as $tutorial) {
            $temp_tasks = Task::where('tutorial_id', $tutorial->id)->orderBy('created_at')->get()->toArray();

            for ($i = 0; $i < count($temp_tasks); $i++) {
                array_push($tasks, $temp_tasks[$i]);
            }
        }

        return [
            'tasks' => $tasks,
        ];
    }

    public function destroy(Task $task)
    {
        $task->delete();

        $tutorials = Auth::user()->tutorials()->orderBy('created_at')->get();

        $tasks = [];

        foreach ($tutorials as $tutorial) {
            $temp_tasks = Task::where('tutorial_id', $tutorial->id)->orderBy('created_at')->get()->toArray();

            for ($i = 0; $i < count($temp_tasks); $i++) {
                array_push($tasks, $temp_tasks[$i]);
            }
        }

        return [
            'tasks' => $tasks,
        ];
    }
}
