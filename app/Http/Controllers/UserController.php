<?php

namespace Ddondola\Http\Controllers;

use Ddondola\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('ddondola.users.index');
    }

    public function userProfile(Request $request, User $user) {
        if ($user->is($request->user()))
            return redirect()->route('my.profile');

        return view('ddondola.users.profile.index', ['user' => $user]);
    }
}
