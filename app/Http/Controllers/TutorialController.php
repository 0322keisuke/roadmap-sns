<?php

namespace App\Http\Controllers;

use App\Tutorial;
use App\Task;
use App\Http\Requests\TutorialRequest;
use App\Http\Requests\TutorialStatusRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TutorialController extends Controller
{
    public function index()
    {
        $tutorials = Auth::user()->tutorials()->orderByRaw('created_at asc,id asc')->get();

        $first_tutorial = Auth::user()->tutorials()->orderByRaw('created_at asc,id asc')->first();

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

        if (is_null($first_tutorial)) {
            return view('tutorials.index', [
                'tutorials' => $tutorials,
                'tasks' => $tasks,
            ]);
        } else {
            return view('tutorials.index', [
                'tutorials' => $tutorials,
                'tasks' => $tasks,
                'first_tutorial_id' => $first_tutorial->id,
            ]);
        }
    }

    public function store(TutorialRequest $request, Tutorial $tutorial)
    {
        $tutorial->title = $request->title;
        $tutorial->user_id = $request->user()->id;
        $tutorial->order = 1;
        $tutorial->status = 1;
        $tutorial->save();

        //新しいtutorialsを返す
        $tutorials = Auth::user()->tutorials()->orderBy('created_at')->get();

        $latest_tutorial_id = DB::table('tutorials')->where([
            ['user_id', '=', $request->user()->id], ['title', '=', $request->title]
        ])->max('id');

        $tasks = [['tutorial_id' => $latest_tutorial_id, 'title' => 'Todo', 'status' => 1, 'tasks' => []], ['tutorial_id' => $latest_tutorial_id, 'title' => 'Doing', 'status' => 2, 'tasks' => []], ['tutorial_id' => $latest_tutorial_id, 'title' => 'Done', 'status' => 3, 'tasks' => []]];

        return [
            'tutorials' => $tutorials,
            'tasks' => $tasks
        ];
    }

    public function destroy(Tutorial $tutorial)
    {
        $tutorial->delete();

        //新しいtutorialsを返す
        $tutorials = Auth::user()->tutorials()->orderBy('created_at')->get();

        return [
            'tutorials' => $tutorials,
        ];
    }

    public function status(TutorialStatusRequest $request, Tutorial $tutorial)
    {
        $tutorial->status = $request->status;
        $tutorial->save();
    }
}
