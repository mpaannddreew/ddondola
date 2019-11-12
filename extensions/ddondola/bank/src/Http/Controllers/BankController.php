<?php

namespace Bank\Http\Controllers;

use Bank\Jobs\ProcessCompleted;
use Bank\Jobs\ProcessFailed;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Laravolt\Avatar\Facade as Avatar;

class BankController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(['web'])->except(['passed', 'failed']);
    }

    public function passed(Request $request) {
        // todo verification first
        ProcessCompleted::dispatch($request->all());
        return response();
    }

    public function failed(Request $request) {
        // todo verification first
        ProcessFailed::dispatch($request->all());
        return response();
    }

    public function wallet(Request $request)
    {
        return view('bank::admin.wallet');
    }
}
