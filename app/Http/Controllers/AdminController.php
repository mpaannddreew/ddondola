<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 08/06/2019
 * Time: 18:25
 */

namespace Ddondola\Http\Controllers;


use Ddondola\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function dashboard() {
        return view('ddondola.admin.dashboard');
    }

    public function users(Request $request, User $user = null) {
        return view('ddondola.admin.users');
    }
}