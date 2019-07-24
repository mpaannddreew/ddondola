<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-09-11
 * Time: 4:11 PM
 */

namespace Activity\Facades;


use Illuminate\Support\Facades\Facade;

class ActivityManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'activity';
    }
}