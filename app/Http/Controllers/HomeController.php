<?php

namespace Ddondola\Http\Controllers;


use Ddondola\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Messenger\Facades\Messenger;
use Shoppie\Repository\ShopRepository;

class HomeController extends Controller
{
    /**
     * HomeController constructor.
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

    public function messenger($participant = null) {
        if ($participant) {
            $converser = Messenger::resolveParticipant($participant);
            if ($converser) {
                if ($converser->is(Auth::user())) {
                    abort(404);
                }
            } else {
                abort(404);
            }
        }

        return view('ddondola.me.messenger');
    }

    public function notifications(Request $request) {
        return view('ddondola.me.notifications', ['user' => $request->user()]);
    }

    public function profile(Request $request) {
        return view('ddondola.me.profile', ['user' => $request->user()]);
    }

    public function Settings(Request $request) {
        return view('ddondola.me.settings', ['user' => $request->user()]);
    }

    public function followers(Request $request) {
        return view('ddondola.me.followers', ['user' => $request->user()]);
    }

    public function following(Request $request) {
        return view('ddondola.me.following', ['user' => $request->user()]);
    }
}
