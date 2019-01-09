<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-09-21
 * Time: 12:29 PM
 */

namespace Ddondola\Http\GraphQL\Queries;


use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Schema\Context;
use Shoppie\Repository\ProductRepository;

class Products extends Query
{
    /**
     * @var ProductRepository
     */
    protected $products;

    public function __construct()
    {
        $this->products = app(ProductRepository::class);
    }

    /**
     * Create a products collection
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
        return $this->products->all($args->get('offset', 0), $args->get('limit', 10));
    }
}