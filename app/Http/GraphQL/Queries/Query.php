<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-09-19
 * Time: 3:32 PM
 */

namespace Ddondola\Http\GraphQL\Queries;


use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Schema\Context;

abstract class Query
{
    abstract public function resolve($obj, $args, Context $context, ResolveInfo $info);
}