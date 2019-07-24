<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 08/06/2019
 * Time: 18:25
 */

namespace Shoppie\Http\Controllers;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Shoppie\Shop;

class AdminController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function shops(Request $request, Shop $shop = null) {
        return view('shoppie::admin.shops');
    }

    public function categories() {
        return view('shoppie::admin.categories');
    }
}