<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-11-06
 * Time: 4:01 PM
 */

namespace Ddondola\Http\Controllers\Auth;


use Ddondola\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;


class VerificationController extends Controller
{
    use VerifiesEmails;
}