<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 27/04/2019
 * Time: 18:16
 */

namespace Messenger\Facades;


use Illuminate\Support\Facades\Facade;

class Messenger extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'messenger';
    }
}