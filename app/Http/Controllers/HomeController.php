<?php

namespace Ddondola\Http\Controllers;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('ddondola.home');
    }

    public function dashboard() {
        return view('ddondola.me.dashboard');
    }

    public function messenger() {
        return view('ddondola.me.messenger');
    }

    public function notifications(Request $request) {
        return view('ddondola.me.notifications', ['user' => $request->user()]);
    }

    public function profile(Request $request) {
        return view('ddondola.me.profile', ['user' => $request->user()]);
    }

    public function editProfile(Request $request) {
        return view('ddondola.me.edit-info', ['user' => $request->user()]);
    }

    public function editProfileSettings(Request $request) {
        return view('ddondola.me.edit-settings', ['user' => $request->user()]);
    }

    public function followers(Request $request) {
        return view('ddondola.me.followers', ['user' => $request->user()]);
    }

    public function following(Request $request) {
        return view('ddondola.me.following', ['user' => $request->user()]);
    }
}
