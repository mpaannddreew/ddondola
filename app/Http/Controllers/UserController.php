<?php

namespace Ddondola\Http\Controllers;

use Ddondola\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct() {

    }

    public function index() {
        return view('ddondola.users.index');
    }

    public function userProfile(Request $request, User $user) {
        if ($user->is($request->user()))
            return redirect()->route('my.profile');

        if (Auth::check())
            if (!$user->country->is($request->user()->country))
                abort(404);

        return view('ddondola.users.profile.index', ['user' => $user]);
    }

    public function userFollowers(Request $request, User $user) {
        if ($user->is($request->user()))
            return redirect()->route('my.followers');

        if (Auth::check())
            if (!$user->country->is($request->user()->country))
                abort(404);

        return view('ddondola.users.profile.followers', ['user' => $user]);
    }

    public function userFollowing(Request $request, User $user) {
        if ($user->is($request->user()))
            return redirect()->route('my.following');

        if (Auth::check())
            if (!$user->country->is($request->user()->country))
                abort(404);

        return view('ddondola.users.profile.following', ['user' => $user]);
    }
}
