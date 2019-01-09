<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-09-21
 * Time: 12:20 PM
 */

namespace Ddondola\Http\GraphQL\Queries;


use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Schema\Context;
use Shoppie\Repository\ShopRepository;

class Shops extends Query
{
    /**
     * @var ShopRepository
     */
    protected $shops;

    public function __construct()
    {
        $this->shops = app(ShopRepository::class);
    }

    /**
     * Create a shops collection
     *
     * @param $obj
     * @param $args
     * @param Context $context
     * @param ResolveInfo $info
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function resolve($obj, $args, Context $context, ResolveInfo $info)
    {
        $args = collect($args);
        return $this->shops->all($args->get('offset', 0), $args->get('limit', 10), $args->get('active'));
    }
}