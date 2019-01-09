<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-09-20
 * Time: 8:56 AM
 */

namespace Ddondola\Http\GraphQL\Resolvers;


use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Database\Eloquent\Model;
use Nuwave\Lighthouse\Schema\Context;
use Shoppie\Product;
use Shoppie\Shop;
use Shoppie\Stock;
use Shoppie\Tag;

class ShoppieResolver extends Resolver
{
    /**
     * Shop's followers
     *
     * @param Shop $shop
     * @param $args
     * @param Context $context
     * @param ResolveInfo $info
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function followers(Shop $shop, $args, Context $context, ResolveInfo $info) {
        return $this->withArgs($shop->followers(), $args);
    }

    /**
     * Product's stock
     *
     * @param Product $product
     * @param $args
     * @param Context $context
     * @param ResolveInfo $info
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function stock(Product $product, $args, Context $context, ResolveInfo $info) {
        return $this->withArgs($product->stock(), $args, $orderBy = 'created_at', $direction = 'desc');
    }

    /**
     * Shops under a tag
     *
     * @param Tag $tag
     * @param $args
     * @param Context $context
     * @param ResolveInfo $info
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function shops(Tag $tag, $args, Context $context, ResolveInfo $info) {
        return $this->withArgs($tag->shops(), $args);
    }

    /**
     * products for a shop
     *
     * @param Shop $shop
     * @param $args
     * @param Context $context
     * @param ResolveInfo $info
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function shopProducts(Shop $shop, $args, Context $context, ResolveInfo $info) {
        return $this->withArgs($shop->products(), $args, 'created_at', 'desc');
    }

    /**
     * products under a tag
     *
     * @param Tag $tag
     * @param $args
     * @param Context $context
     * @param ResolveInfo $info
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function tagProducts(Tag $tag, $args, Context $context, ResolveInfo $info) {
        return $this->withArgs($tag->products(), $args);
    }

    /**
     * User that added stock
     *
     * @param Stock $stock
     * @param $args
     * @param Context $context
     * @param ResolveInfo $info
     * @return mixed|null
     */
    public function addedBy(Stock $stock, $args, Context $context, ResolveInfo $info) {
        return $stock->isIn() ? $stock->addedBy : null;
    }
}