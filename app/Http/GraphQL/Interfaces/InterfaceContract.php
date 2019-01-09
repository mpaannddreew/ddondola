<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-09-20
 * Time: 11:41 AM
 */

namespace Ddondola\Http\GraphQL\Interfaces;


interface InterfaceContract
{
    public function resolveType($value);
}