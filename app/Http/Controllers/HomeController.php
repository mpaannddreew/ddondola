<?php

namespace Ddondola\Http\Controllers;


class HomeController extends Controller
{
    protected $params = ['dashboard' => '', 'profile' => '', 'profile_edit' => '', 'messenger' => '', 'orders' => '', 'cart' => '', 'shops' => '', 'wishlist' => ''];

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
        $params = $this->params;
        $params['dashboard'] = 'active';
        return view('ddondola.me.dashboard', $params);
    }

    public function messenger() {
        $params = $this->params;
        $params['messenger'] = 'active';
        return view('ddondola.me.messenger', $params);
    }

    public function notifications() {
        return view('ddondola.me.notifications');
    }

    public function people() {
        return view('ddondola.people');
    }

    public function profile() {
        $params = $this->params;
        $params['profile'] = 'active';
        return view('ddondola.me.profile', $params);
    }

    public function editProfile() {
        $params = $this->params;
        $params['profile_edit'] = 'active';
        return view('ddondola.me.edit', $params);
    }
}
