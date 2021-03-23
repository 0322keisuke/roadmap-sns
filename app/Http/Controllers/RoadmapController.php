<?php

namespace App\Http\Controllers;

use App\Roadmap;
use App\RoadmapTutorial;
use App\RoadmapTutorialTask;
use App\Http\Requests\RoadmapRequest;
use Illuminate\Http\Request;

class RoadmapController extends Controller
{
    public function index()
    {
        $roadmaps = Roadmap::all()->sortByDesc('created_at');

        return view('roadmaps.index', ['roadmaps' => $roadmaps]);
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

    public function show(Roadmap $roadmap)
    {
        return view('roadmaps.show', ['roadmap' => $roadmap]);
    }
}
