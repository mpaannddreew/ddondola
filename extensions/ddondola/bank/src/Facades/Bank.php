<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 17/04/2019
 * Time: 22:05
 */

namespace Bank\Facades;


use Illuminate\Support\Facades\Facade;

class Bank extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'bank';
    }
}