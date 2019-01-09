<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-09-20
 * Time: 12:08 PM
 */

namespace Ddondola\Http\GraphQL\Interfaces;


class Converser implements InterfaceContract
{

    public function resolveType($value)
    {
        return graphql()->types()->get($value->type());
    }
}