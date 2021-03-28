<?php

namespace App\Http\Controllers;

use App\Tutorial;
use App\Task;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\MovingTaskRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

            $todo = array_filter($temp_tasks, function ($value) {
                return $value['status'] == 1;
            });
            array_push($tasks, ['tutorial_id' => $tutorial->id, 'title' => 'Todo', 'status' => 1, 'tasks' => array_values($todo)]);

            $doing = array_filter($temp_tasks, function ($value) {
                return $value['status'] == 2;
            });
            array_push($tasks, ['tutorial_id' => $tutorial->id, 'title' => 'Doing', 'status' => 2, 'tasks' => array_values($doing)]);

            $done = array_filter($temp_tasks, function ($value) {
                return $value['status'] == 3;
            });
            array_push($tasks, ['tutorial_id' => $tutorial->id, 'title' => 'Done', 'status' => 3, 'tasks' => array_values($done)]);
        }

        return [
            'tasks' => $tasks,
        ];
    }

    public function update(MovingTaskRequest $request)
    {
        \Debugbar::info($request->tasks);

        DB::table('tasks')->where('id', $request->id)->update(['order' => $request->newIndex]);

        if ($request->oldIndex < $request->newIndex) {
            \Debugbar::info('ケース１');
            \Debugbar::info('displayTutorialId:'
                . $request->displayTutorialId);
            \Debugbar::info('status:' . $request->status);
            \Debugbar::info('oldIndex:' . $request->oldIndex);
            \Debugbar::info('newIndex:' . $request->newIndex);
            \Debugbar::info('id:' . $request->id);

            DB::table('tasks')->where([
                ['tutorial_id', '=', $request->displayTutorialId],
                ['status', '=', $request->status],
                ['order', '>', $request->oldIndex],
                ['order', '<=', $request->newIndex],
                ['id', '<>', $request->id]
            ])->decrement('order');
        } elseif ($request->oldIndex > $request->newIndex) {
            \Debugbar::info('ケース２');
            \Debugbar::info('oldIndex:' . $request->oldIndex);
            \Debugbar::info('newIndex:' . $request->newIndex);
            \Debugbar::info('id:' . $request->id);

            DB::table('tasks')->where([
                ['tutorial_id', '=', $request->displayTutorialId],
                ['status', '=', $request->status],
                ['order', '<', $request->oldIndex],
                ['order', '>=', $request->newIndex],
                ['id', '<>', $request->id]
            ])->increment('order');
        } else {
            \Debugbar::info('Indexが変化していません');
        }
    }

    public function destroy(Task $task)
    {
        $task->delete();

        $tutorials = Auth::user()->tutorials()->orderBy('created_at')->get();

        $tasks = [];

        foreach ($tutorials as $tutorial) {

            $temp_tasks = Task::where('tutorial_id', $tutorial->id)->orderBy('created_at')->get()->toArray();

            $todo = array_filter($temp_tasks, function ($value) {
                return $value['status'] == 1;
            });
            array_push($tasks, ['tutorial_id' => $tutorial->id, 'title' => 'Todo', 'status' => 1, 'tasks' => array_values($todo)]);

            $doing = array_filter($temp_tasks, function ($value) {
                return $value['status'] == 2;
            });
            array_push($tasks, ['tutorial_id' => $tutorial->id, 'title' => 'Doing', 'status' => 2, 'tasks' => array_values($doing)]);

            $done = array_filter($temp_tasks, function ($value) {
                return $value['status'] == 3;
            });
            array_push($tasks, ['tutorial_id' => $tutorial->id, 'title' => 'Done', 'status' => 3, 'tasks' => array_values($done)]);
        }

        return [
            'tasks' => $tasks,
        ];
    }
}
