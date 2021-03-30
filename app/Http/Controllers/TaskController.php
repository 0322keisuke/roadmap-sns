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
        $max_order = DB::table('tasks')->where([
            ['tutorial_id', '=', $request->tutorial_id],
            ['status', '=', $request->status]
        ])->max('order');

        $task->name = $request->name;
        $task->tutorial_id = $request->tutorial_id;
        $task->order = $max_order + 1;
        $task->status = $request->status;
        $task->save();

        $tutorials = Auth::user()->tutorials()->orderBy('created_at')->get();

        $tasks = [];

        foreach ($tutorials as $tutorial) {

            $temp_tasks = Task::where('tutorial_id', $tutorial->id)->orderByRaw('status asc,"order" asc')->get()->toArray();

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
        if ($request->status) {
            \Debugbar::info('同リスト内移動');
            DB::table('tasks')->where('id', $request->id)->update(['order' => $request->newIndex]);

            if ($request->oldIndex < $request->newIndex) {
                DB::table('tasks')->where([
                    ['tutorial_id', '=', $request->displayTutorialId],
                    ['status', '=', $request->status],
                    ['order', '>', $request->oldIndex],
                    ['order', '<=', $request->newIndex],
                    ['id', '<>', $request->id]
                ])->decrement('order');
            } elseif ($request->oldIndex > $request->newIndex) {
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
        } elseif ($request->removeStatus) {
            \Debugbar::info('別リスト移動');

            //移動したタスクのstatus,order更新
            DB::table('tasks')->where('id', $request->id)->update(['status' => $request->addStatus, 'order' => $request->newIndex]);

            //移動元の状態のorder更新
            DB::table('tasks')->where([
                ['tutorial_id', '=', $request->displayTutorialId],
                ['status', '=', $request->removeStatus],
                ['order', '>', $request->oldIndex],
                ['id', '<>', $request->id]
            ])->decrement('order');

            //移動先の状態のorder更新
            DB::table('tasks')->where([
                ['tutorial_id', '=', $request->displayTutorialId],
                ['status', '=', $request->addStatus],
                ['order', '>', $request->newIndex],
                ['id', '<>', $request->id]
            ])->increment('order');
        } else {
            \Debugbar::info('Update処理していません。');
        }
    }

    public function destroy(Task $task)
    {
        $task->delete();

        DB::table('tasks')->where([
            ['tutorial_id', '=', $task->tutorial_id],
            ['status', '=', $task->status],
            ['order', '>', $task->order],
        ])->decrement('order');

        $tutorials = Auth::user()->tutorials()->orderBy('created_at')->get();

        $tasks = [];

        foreach ($tutorials as $tutorial) {

            $temp_tasks = Task::where('tutorial_id', $tutorial->id)->orderByRaw('status asc,"order" asc')->get()->toArray();

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
