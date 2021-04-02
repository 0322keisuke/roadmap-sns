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

        return view('users.show', [
            'user' => $user,
            'roadmaps' => $roadmaps,
        ]);
    }

    public function likes(string $name)
    {
        $user = User::where('name', $name)->first();

        $roadmaps = $user->likes->sortByDesc('created_at');

        return view('users.likes', [
            'user' => $user,
            'roadmaps' => $roadmaps
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
