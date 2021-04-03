<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(string $name)
    {
        $user = User::where('name', $name)->first();

        $roadmaps = $user->roadmaps->sortByDesc('created_at');

        $count_done_tasks = $user->tasks->where('status', 3)->makeHidden('laravel_through_key')->count();

        return view('users.show', [
            'user' => $user,
            'roadmaps' => $roadmaps,
            'count_done_tasks' => $count_done_tasks
        ]);
    }

    public function likes(string $name)
    {
        $user = User::where('name', $name)->first();

        $roadmaps = $user->likes->sortByDesc('created_at');

        $count_done_tasks = $user->tasks->where('status', 3)->makeHidden('laravel_through_key')->count();

        return view('users.likes', [
            'user' => $user,
            'roadmaps' => $roadmaps,
            'count_done_tasks' => $count_done_tasks
        ]);
    }

    public function follow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id) {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);

        return ['name' => $name];
    }

    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id) {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);

        return ['name' => $name];
    }
}
