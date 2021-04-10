<?php

namespace App\Http\Controllers;

use App\Roadmap;
use App\RoadmapTutorial;
use App\RoadmapTutorialTask;
use App\Tutorial;
use App\Task;
use App\Http\Requests\RoadmapRequest;
use App\Http\Requests\TutorialAndTaskRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoadmapController extends Controller
{
    public function index()
    {
        $roadmaps = Roadmap::all()->sortByDesc('created_at')->load(['user', 'likes']);

        return view('roadmaps.index', ['roadmaps' => $roadmaps]);
    }

    public function show(Roadmap $roadmap)
    {
        $tutorials = $roadmap->tutorials()->orderBy('created_at')->get();

        $tutorials_title = $roadmap->tutorials()->orderBy('created_at')->get('title')->toArray();

        $lists = [];

        foreach ($tutorials as $key => $tutorial) {
            array_push($lists, ['title' => $tutorials_title[$key]['title'], 'tasks' => []]);

            $temp_tasks = RoadmapTutorialTask::where('tutorial_id', $tutorial->id)->orderBy('created_at')->get('name')->toArray();

            for ($i = 0; $i < count($temp_tasks); $i++) {
                array_push($lists[$key]['tasks'],  $temp_tasks[$i]['name']);
            }
        }

        return view('roadmaps.show', ['roadmap' => $roadmap, 'lists' => $lists]);
    }

    public function copy(TutorialAndTaskRequest $request)
    {
        foreach ($request->all() as $request_tutorial) {
            $tutorial = new Tutorial();
            $tutorial->title = $request_tutorial['title'];
            $tutorial->user_id = $request->user()->id;
            $tutorial->order = 1;
            $tutorial->status = 1;
            $tutorial->save();

            foreach ($request_tutorial['tasks'] as $key => $request_task) {
                $task = new Task();

                $latest_tutorial_id = DB::table('tutorials')->where([
                    ['user_id', '=', $request->user()->id], ['title', '=', $request_tutorial['title']]
                ])->max('id');

                $task->name = $request_task;
                $task->tutorial_id = $latest_tutorial_id;
                $task->status = 1;
                $task->order = $key;

                $task->save();
            }
        }
    }

    public function create()
    {
        return view('roadmaps.create');
    }

    public function store(RoadmapRequest $request, Roadmap $roadmap, RoadmapTutorial $roadmap_tutorial)
    {
        $roadmap->title = $request->title;
        $roadmap->body = $request->body;
        $roadmap->user_id = $request->user()->id;
        $roadmap->estimated_time = $request->estimated_time;
        $roadmap->level = $request->level;
        $roadmap->save();


        foreach (json_decode($request->tutorial_task_names) as $tutorial_title) {
            $roadmap_tutorial = new RoadmapTutorial();

            $roadmap_tutorial->title = $tutorial_title->title;
            $roadmap_tutorial->user_id = $request->user()->id;
            $roadmap_tutorial->roadmap_id = Roadmap::max('id');

            $roadmap_tutorial->save();

            foreach ($tutorial_title->tasks as $tasks) {
                $roadmap_tutorial_task = new RoadmapTutorialTask();

                $roadmap_tutorial_task->name = $tasks;
                $roadmap_tutorial_task->tutorial_id = RoadmapTutorial::max('id');

                $roadmap_tutorial_task->save();
            }
        }

        return redirect()->route('roadmaps.index');
    }

    public function like(Request $request, Roadmap $roadmap)
    {
        $roadmap->likes()->detach($request->user()->id);
        $roadmap->likes()->attach($request->user()->id);

        return [
            'id' => $roadmap->id,
            'countLikes' => $roadmap->count_likes,
        ];
    }

    public function unlike(Request $request, Roadmap $roadmap)
    {
        $roadmap->likes()->detach($request->user()->id);

        return [
            'id' => $roadmap->id,
            'countLikes' => $roadmap->count_likes,
        ];
    }
}
