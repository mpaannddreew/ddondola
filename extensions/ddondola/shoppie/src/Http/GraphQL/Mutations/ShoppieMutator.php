<?php

namespace Shoppie\Http\GraphQL\Mutations;

use Bank\Jobs\CreateEscrow;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Exceptions\AuthorizationException;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Shoppie\ProductBrand;
use Shoppie\ProductCategory;
use Shoppie\ProductSubCategory;
use Shoppie\Repository\OrderRepository;
use Shoppie\Repository\ProductBrandRepository;
use Shoppie\Repository\ProductCategoryRepository;
use Shoppie\Repository\ProductOfferRepository;
use Shoppie\Repository\ProductRepository;
use Shoppie\Repository\ProductSubCategoryRepository;
use Shoppie\Repository\ShopCategoryRepository;
use Shoppie\Repository\ShopRepository;
use Shoppie\Repository\StockRepository;
use Shoppie\ShopCategory;
use Shoppie\Shoppie;

class ShoppieMutator
{
    /**
     * Return a value for the field.
     *
     * @param null $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param array $args The arguments that were passed into the field.
     * @param GraphQLContext|null $context Arbitrary data that is shared between all fields of a single query.
     * @param ResolveInfo $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     *
     * @return ProductBrand
     * @throws \Exception
     */
    public function createBrand($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $shop = app(ShopRepository::class)->code($args['shop']);
        if ($context->user()->can('update', $shop)) {
            return app(ProductBrandRepository::class)->create($shop, $args['brand']);
        }

        throw new AuthorizationException;
    }

    /**
     * Return a value for the field.
     *
     * @param null $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param array $args The arguments that were passed into the field.
     * @param GraphQLContext|null $context Arbitrary data that is shared between all fields of a single query.
     * @param ResolveInfo $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     *
     * @return ProductBrand
     * @throws \Exception
     */
    public function editBrand($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $brand = app(ProductBrandRepository::class)->id($args['brandId']);
        if ($context->user()->can('update', $brand)) {
            return app(ProductBrandRepository::class)->update($brand, $args['brand']);
        }

        throw new AuthorizationException;
    }

    /**
     * Return a value for the field.
     *
     * @param null $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param array $args The arguments that were passed into the field.
     * @param GraphQLContext|null $context Arbitrary data that is shared between all fields of a single query.
     * @param ResolveInfo $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     *
     * @return ProductBrand
     * @throws \Exception
     */
    public function updateStock($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $product = app(ProductRepository::class)->id($args['productId']);
        if ($context->user()->can('update', $product)) {
            return app(StockRepository::class)->create($product, $context->user(), collect($args)->get('stock'));
        }

        throw new AuthorizationException;
    }

    /**
     * Return a value for the field.
     *
     * @param null $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param array $args The arguments that were passed into the field.
     * @param GraphQLContext|null $context Arbitrary data that is shared between all fields of a single query.
     * @param ResolveInfo $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     *
     * @return ProductCategory
     * @throws \Exception
     */
    public function createCategory($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $shop = app(ShopRepository::class)->code($args['shop']);
        if ($context->user()->can('update', $shop)) {
            return app(ProductCategoryRepository::class)->create($shop, $args['category']);
        }

        throw new AuthorizationException;
    }

    /**
     * Return a value for the field.
     *
     * @param null $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param array $args The arguments that were passed into the field.
     * @param GraphQLContext|null $context Arbitrary data that is shared between all fields of a single query.
     * @param ResolveInfo $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     *
     * @return ProductCategory
     * @throws \Exception
     */
    public function createShopCategory($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        if ($context->user()->can('create', ShopCategory::class)) {
            return app(ShopCategoryRepository::class)->create($args['category']);
        }

        throw new AuthorizationException;
    }

    /**
     * Return a value for the field.
     *
     * @param null $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param array $args The arguments that were passed into the field.
     * @param GraphQLContext|null $context Arbitrary data that is shared between all fields of a single query.
     * @param ResolveInfo $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     *
     * @return ProductCategory
     * @throws \Exception
     */
    public function editCategory($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $category = app(ProductCategoryRepository::class)->id($args['categoryId']);
        if ($context->user()->can('update', $category)) {
            return app(ProductCategoryRepository::class)->update($category, $args['category']);
        }

        throw new AuthorizationException;
    }

    /**
     * Return a value for the field.
     *
     * @param null $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param array $args The arguments that were passed into the field.
     * @param GraphQLContext|null $context Arbitrary data that is shared between all fields of a single query.
     * @param ResolveInfo $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     *
     * @return ProductCategory
     * @throws \Exception
     */
    public function editShopCategory($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $category = app(ShopCategoryRepository::class)->id($args['categoryId']);
        if ($context->user()->can('update', $category)) {
            return app(ShopCategoryRepository::class)->update($category, $args['category']);
        }

        throw new AuthorizationException;
    }

    /**
     * Return a value for the field.
     *
     * @param null $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param array $args The arguments that were passed into the field.
     * @param GraphQLContext|null $context Arbitrary data that is shared between all fields of a single query.
     * @param ResolveInfo $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     *
     * @return ProductSubCategory
     * @throws \Exception
     */
    public function createSubCategory($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $category = app(ProductCategoryRepository::class)->id($args['categoryId']);
        if ($context->user()->can('update', $category)) {
            return app(ProductSubCategoryRepository::class)->create($category, $args['subcategory']);
        }

        throw new AuthorizationException;
    }

    /**
     * Return a value for the field.
     *
     * @param null $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param array $args The arguments that were passed into the field.
     * @param GraphQLContext|null $context Arbitrary data that is shared between all fields of a single query.
     * @param ResolveInfo $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     *
     * @return ProductSubCategory
     * @throws \Exception
     */
    public function editSubCategory($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $category = app(ProductSubCategoryRepository::class)->id($args['categoryId']);
        if ($context->user()->can('update', $category)) {
            return app(ProductSubCategoryRepository::class)->update($category, $args['subcategory']);
        }

        throw new AuthorizationException;
    }

    /**
     * Return a value for the field.
     *
     * @param null $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param array $args The arguments that were passed into the field.
     * @param GraphQLContext|null $context Arbitrary data that is shared between all fields of a single query.
     * @param ResolveInfo $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     *
     * @return mixed
     */
    public function likeShop($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $shop = app(ShopRepository::class)->id($args["id"]);
        if ($context->user()->hasLiked($shop)) {
            $context->user()->unlike($shop);
            return false;
        }

        $context->user()->like($shop);
        return true;
    }

    /**
     * Return a value for the field.
     *
     * @param null $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param array $args The arguments that were passed into the field.
     * @param GraphQLContext|null $context Arbitrary data that is shared between all fields of a single query.
     * @param ResolveInfo $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     *
     * @return mixed
     */
    public function addToCart($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        return $context->user()->cart->addProduct(app(ProductRepository::class)->id($args["id"]), $args["quantity"]);
    }

    /**
     * Return a value for the field.
     *
     * @param null $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param array $args The arguments that were passed into the field.
     * @param GraphQLContext|null $context Arbitrary data that is shared between all fields of a single query.
     * @param ResolveInfo $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     *
     * @return mixed
     */
    public function removeFromCart($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        return $context->user()->cart->removeProduct(app(ProductRepository::class)->id($args["id"]));
    }

    /**
     * Return a value for the field.
     *
     * @param null $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param array $args The arguments that were passed into the field.
     * @param GraphQLContext|null $context Arbitrary data that is shared between all fields of a single query.
     * @param ResolveInfo $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     *
     * @return mixed
     */
    public function addToFavorites($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $context->user()->favorite(app(ProductRepository::class)->id($args["id"]));
        return true;
    }

    /**
     * Return a value for the field.
     *
     * @param null $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param array $args The arguments that were passed into the field.
     * @param GraphQLContext|null $context Arbitrary data that is shared between all fields of a single query.
     * @param ResolveInfo $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     *
     * @return mixed
     */
    public function removeFromFavorites($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $context->user()->unfavorite(app(ProductRepository::class)->id($args["id"]));
        return false;
    }

    /**
     * Return a value for the field.
     *
     * @param null $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param array $args The arguments that were passed into the field.
     * @param GraphQLContext|null $context Arbitrary data that is shared between all fields of a single query.
     * @param ResolveInfo $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     *
     * @return mixed
     * @throws AuthorizationException
     */
    public function createProductOffer($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $product = app(ProductRepository::class)->id($args["productId"]);

        if ($product->hasActiveOffer()) {
            return null;
        }

        if ($context->user()->can('update', $product)) {
            $attributes = [
                'start_date' => \Illuminate\Support\Carbon::parse($args['offer']['start_date']),
                'end_date' => \Illuminate\Support\Carbon::parse($args['offer']['end_date']),
                'discount' => $args['offer']['discount']
            ];
            return app(ProductOfferRepository::class)->create($product, $attributes);
        }

        throw new AuthorizationException;
    }

    /**
     * Return a value for the field.
     *
     * @param null $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param array $args The arguments that were passed into the field.
     * @param GraphQLContext|null $context Arbitrary data that is shared between all fields of a single query.
     * @param ResolveInfo $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     *
     * @return mixed
     */
    public function updateOrder($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $update = collect($args['update']);
        if ($update->get('action') == 'cancel') {
            $attributes = ['cancelled' => true, 'cancelled_by' => $update->get('actor')];
        } else {
            if ($update->get('actor') == 'buyer') {
                $attributes = ['receipt_confirmed' => true];
            } else {
                $attributes = ['delivery_confirmed' => true];
            }
        }

        return app(Shoppie::class)->updateOrder(
            app(OrderRepository::class)->code($update->get('order')),
            app(ProductRepository::class)->code($update->get('product')),
            $attributes
        );
    }

    /**
     * Return a value for the field.
     *
     * @param null $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param array $args The arguments that were passed into the field.
     * @param GraphQLContext|null $context Arbitrary data that is shared between all fields of a single query.
     * @param ResolveInfo $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     *
     * @return mixed
     */
    public function approvePayment($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $order = app(OrderRepository::class)->id(collect($args)->get('order'));
        if ($order->activeSum() > $context->user()->account->balance()) {
            return false;
        }

        CreateEscrow::dispatchNow($order);
        return true;
    }
}
