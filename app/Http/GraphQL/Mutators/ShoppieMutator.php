<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 2018-09-21
 * Time: 5:47 PM
 */

namespace Ddondola\Http\GraphQL\Mutators;


use Nuwave\Lighthouse\Schema\Context;
use Shoppie\Repository\ProductCategoryRepository;
use Shoppie\Repository\ProductRepository;
use Shoppie\Repository\ShopCategoryRepository;
use Shoppie\Repository\ShopRepository;
use Shoppie\Shop;
use Shoppie\Shoppie;

class ShoppieMutator
{
    /**
     * @var Shoppie
     */
    protected $shoppie;

    /**
     * @var ProductRepository
     */
    protected $products;

    /**
     * @var ShopRepository
     */
    protected $shops;

    /**
     * @var ShopCategoryRepository
     */
    protected $shopCategories;

    /**
     * @var ProductCategoryRepository
     */
    protected $productCategories;

    public function __construct()
    {
        $this->shoppie = app(Shoppie::class);
        $this->products = app(ProductRepository::class);
        $this->shops = app(ShopRepository::class);
        $this->shopCategories = app(ShopCategoryRepository::class);
        $this->productCategories = app(ProductCategoryRepository::class);
    }

    /**
     * follow a user
     *
     * @param $root
     * @param array $args
     * @param Context $context
     * @return bool
     */
    public function follow($root, array $args, Context $context) {
        $shop = $this->shops->id($args['shopId']);
        if ($shop) {
            if (!$context->request->user()->isFollowing($shop)) {
                try {
                    $context->request->user()->follow($shop);
                    return true;
                } catch (\Exception $e) {
                }
            }
        }

        return false;
    }

    /**
     * Un follow a user
     *
     * @param $root
     * @param array $args
     * @param Context $context
     * @return bool
     */
    public function unFollow($root, array $args, Context $context) {
        $shop = $this->shops->id($args['shopId']);
        if ($shop) {
            if ($context->request->user()->isFollowing($shop)) {
                $context->request->user()->unfollow($shop);
                return true;
            }
        }

        return false;
    }

    /**
     * @param $root
     * @param array $args
     * @param Context $context
     * @return Shop
     * @throws \Exception
     */
    public function createShop($root, array $args, Context $context) {
        $category = $this->shopCategories->code($args['categoryCode']);
        if (!$category)
            throw new \Exception('Shop category does not exist');

        return $context->request->user()->newShop($category, $args['shop']['name']);
    }

    /**
     * @param $root
     * @param array $args
     * @param Context $context
     * @return \Shoppie\Product
     * @throws \Exception
     */
    public function createProduct($root, array $args, Context $context) {
        $shop = $this->shops->id($args["shopId"]);
        if ($shop) {
            if ($context->request->user()->manages($shop)) {
                $category = $this->productCategories->code($args['categoryCode']);
                if (!$category)
                    throw new \Exception('Product category does not exist');

                return $shop->newProduct($category, $args['product']);
            }
            throw new \Exception('Only shop managers can add products');
        }
        throw new \Exception('Shop does not exist');
    }

    /**
     * Favourite a product
     *
     * @param $root
     * @param array $args
     * @param Context $context
     * @return bool
     * @throws \Exception
     */
    public function favouriteProduct($root, array $args, Context $context) {
        $product = $this->products->id($args["productId"]);
        if ($product) {
            if (!$context->request->user()->hasFavorited($product)) {
                $context->request->user()->favorite($product);
                return true;
            }
            return false;
        }
        throw new \Exception('Product does not exist');
    }

    /**
     * Un favourite a product
     *
     * @param $root
     * @param array $args
     * @param Context $context
     * @return bool
     * @throws \Exception
     */
    public function unFavouriteProduct($root, array $args, Context $context) {
        $product = $this->products->id($args["productId"]);
        if ($product) {
            if ($context->request->user()->hasFavorited($product)) {
                $context->request->user()->unfavorite($product);
                return true;
            }
            return false;
        }
        throw new \Exception('Product does not exist');
    }

    /**
     * Creates stock
     *
     * @param $root
     * @param array $args
     * @param Context $context
     * @return \Shoppie\Stock
     * @throws \Exception
     */
    public function addStock($root, array $args, Context $context) {
        $args = collect($args);
        $product = $this->products->id($args->get('productId'));
        if ($product) {
            return $product->checkIn($args->get('quantity'), $context->request->user(), $args->get('note'));
        }
        throw new \Exception('Product does not exist');
    }
}