<?php

namespace Shoppie\Http\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Exceptions\AuthorizationException;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Shoppie\ProductBrand;
use Shoppie\ProductCategory;
use Shoppie\ProductSubCategory;
use Shoppie\Repository\ProductBrandRepository;
use Shoppie\Repository\ProductCategoryRepository;
use Shoppie\Repository\ProductRepository;
use Shoppie\Repository\ProductSubCategoryRepository;
use Shoppie\Repository\ShopCategoryRepository;
use Shoppie\Repository\ShopRepository;
use Shoppie\Shop;
use Shoppie\ShopCategory;

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
     * @return Shop
     */
    public function createShop($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $shop = collect($args['shop']);
        $shopCategory = app(ShopCategoryRepository::class)->id($shop->get('categoryId'));
        return $context->user()->newShop($shopCategory, [
            'name' => $shop->get('name'),
            'profile' => $shop->only(['phone_number', 'email', 'description', 'address']),
            'active' => 1
        ]);
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
    public function createBrand($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $shop = app(ShopRepository::class)->code($args['shop']);
        if ($context->user()->can('update', $shop)) {
            $brand = collect($args['brand']);
            return app(ProductBrandRepository::class)
                ->create($shop, $brand->get('name'), $brand->get('description'));
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
     * @return ProductCategory
     * @throws \Exception
     */
    public function createCategory($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $shop = app(ShopRepository::class)->code($args['shop']);
        if ($context->user()->can('update', $shop)) {
            $category = collect($args['category']);
            return app(ProductCategoryRepository::class)
                ->create($shop, $category->get('name'), $category->get('description'));
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
            $category = collect($args['category']);
            return app(ShopCategoryRepository::class)
                ->create($category->get('name'), $category->get('description'));
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
            $subcategory = collect($args['subcategory']);
            return app(ProductSubCategoryRepository::class)
                ->create($category, $subcategory->get('name'), $subcategory->get('description'));
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
     * @return ProductSubCategory
     * @throws \Exception
     */
    public function createProduct($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $args = $args['product'];
        $brand = app(ProductBrandRepository::class)->id($args['brandId']);
        $subCategory = app(ProductSubCategoryRepository::class)->id($args['categoryId']);
        if ($context->user()->can('update', $brand) &&
            $context->user()->can('update', $subCategory)) {

            $product = app(ProductRepository::class)->create($subCategory, $brand,
                array_merge(collect($args)->only(['name', 'price', 'description', 'active'])->all(),
                    ['settings' => collect($args)->only(['minimum_stock', 'attributes'])])
            );

            $stock = collect($args['stock']);

            $product->addStock($stock->get('quantity'), $stock->get('note'), $context->user());

            // todo upload images
            return $product;
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
    public function editProduct($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $product = app(ProductRepository::class)->id($args['productId']);
        if ($context->user()->can('update', $product)) {
            $brand = null;
            $subCategory = null;

            $args = collect($args['product']);
            if ($args->has('brandId')) {
                $brand = app(ProductBrandRepository::class)->id($args->get('brandId'));
            }

            if ($args->has('categoryId')) {
                $subCategory = app(ProductSubCategoryRepository::class)->id($args->get('categoryId'));
            }

            $product = $product->editProduct($subCategory, $brand,
                collect($args)->only(['name', 'price', 'description', 'active', 'minimum_stock', 'attributes'])->all()
            );

            return $product;
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
    public function updateStock($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $product = app(ProductRepository::class)->id($args['productId']);
        if ($context->user()->can('update', $product)) {
            $stock = collect($args['stock']);
            $method = $stock->get('type') == 'in' ? 'addStock' : 'subStock';
            return $product->{$method}($stock->get('quantity'), $stock->get('note'), $context->user());
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
        return $context->user()->cart
            ->addProduct(app(ProductRepository::class)->id($args["id"]), $args["quantity"]);
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
        if ($context->user()->can('update', $product)) {
            return $product->newOffer(
                $args['offer']['discount'],
                \Illuminate\Support\Carbon::parse($args['offer']['start_date']),
                \Illuminate\Support\Carbon::parse($args['offer']['end_date'])
            );
        }

        throw new AuthorizationException;
    }
}
