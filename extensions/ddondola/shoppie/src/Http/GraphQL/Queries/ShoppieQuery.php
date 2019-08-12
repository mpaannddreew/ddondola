<?php

namespace Shoppie\Http\GraphQL\Queries;

use Carbon\Carbon;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Database\Eloquent\Builder;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Shoppie\Product;
use Shoppie\Repository\OrderRepository;
use Shoppie\Repository\ProductRepository;
use Shoppie\Repository\ShopCategoryRepository;
use Shoppie\Repository\ShopRepository;

class ShoppieQuery
{
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
    public function ShopCategories($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        return $this->orderBy(app(ShopCategoryRepository::class)->builder(), 'name', 'asc');
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
    public function shops($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $builder = app(ShopRepository::class)->builder();
        if ($context->user()) {
            $myCountry = collect($args)->get('myCountry', true);
            if ($myCountry) {
                $builder = $builder->whereHas('owner', function ($q) use ($context) {
                    $q->where('country_id', $context->user()->country->id);
                });
            }
        }

        if (collect($args)->has('filters')) {
            $filters = collect($args["filters"]);
            $categoryIds = json_decode($filters->get('categoryIds'));
            if (count($categoryIds)) {
                $builder = $builder->whereIn('category_id', $categoryIds);
            }
        }

        return $this->orderBy($this->status($builder), 'name', 'asc');
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
    public function paginatedShops($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $builder = $rootValue->shops();
        if ($context->user()) {
            $myCountry = collect($args)->get('myCountry', true);
            if ($myCountry) {
                $builder = $builder->whereHas('owner', function ($q) use ($context) {
                    $q->where('country_id', $context->user()->country->id);
                });
            }
        }

        return $this->orderBy($this->status($builder));
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
    public function products($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $builder = app(ProductRepository::class)->builder()->has('media');
        if ($context->user()) {
            $myCountry = collect($args)->get('myCountry', true);
            if ($myCountry) {
                $builder = $builder->whereHas('brand', function ($q) use ($context) {
                    $q->whereHas('shop', function ($q1) use ($context) {
                        $q1->whereHas('owner', function ($q2) use ($context) {
                            $q2->where('country_id', $context->user()->country->id);
                        });
                    });
                });
            }
        }

        if (collect($args)->get("category")) {
            $category = (app(ShopCategoryRepository::class)->code(collect($args)->get("category")))->id;
            $builder = $builder->whereHas('brand', function ($q) use ($category) {
                $q->whereHas('shop', function ($q1) use ($category) {
                    $q1->whereIn("category_id", [$category]);
                });
            });
        }

        return $this->withFilters($this->status($builder), $args);
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
    public function paginatedProducts($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $inventory = collect($args)->get('inventory', false);
        $builder = $rootValue->products();
        $builder = $inventory ? $builder: $builder->has('media');
        return $this->withFilters($builder, $args);
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
    public function orderProducts($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $builder = $rootValue->products();
        if (collect($args)->get('shop')) {
            $shop = app(ShopRepository::class)->code(collect($args)->get('shop'));
            $builder = $builder->whereHas('brand', function ($q) use ($shop) {
                $q->whereHas('shop', function ($q1) use ($shop) {
                    $q1->where('shop_id', $shop->id);
                });
            });
        }

        return $this->orderBy($builder, 'name', 'asc');
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
    public function shopOrders($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        // todo add search functionality
        return $this->orderBy($rootValue->orders());
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
    public function shop($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        return app(ShopRepository::class)->code(collect($args)->get('shop'));
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
    public function order($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        return app(OrderRepository::class)->code(collect($args)->get('order'));
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
    public function recommendedProducts($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        return $this->orderBy($this->status($rootValue->recommendations()->has('media')));
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
    public function relatedProducts($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        return $rootValue->brand->products()->inRandomOrder()->get()->reject(function (Product $product) use ($rootValue){
            return $rootValue->is($product);
        })->take(4);
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
    public function paginatedCategories($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        return $this->orderBy($rootValue->categories());
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
    public function paginatedSubcategories($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        return $this->orderBy($rootValue->subcategories());
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
    public function paginatedBrands($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        return $this->orderBy($rootValue->brands());
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
    public function iLikeShop($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        return $context->user()->hasLiked(app(ShopRepository::class)->id($args["id"]));
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
    public function inCart($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        return $context->user()->cart->hasProduct(app(ProductRepository::class)->id($args["id"]));
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
    public function isFavorite($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        return $context->user()->hasFavorited(app(ProductRepository::class)->id($args["id"]));
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
    public function searchProducts($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $value = "%" . collect($args)->get("name") . "%";
        // todo search including localization
        return $this->status(app(ProductRepository::class)->builder()->has('media'))
            ->where("name", "like", $value)
            ->orWhereHas('subcategory', function($q) use($value) {
                $q->where('name', 'like', $value)
                    ->orWhereHas('category', function($q1) use($value) {
                        $q1->where('name', 'like', $value);
                    });
            })
            ->orWhereHas('brand', function($q) use($value) {
                $q->where('name', 'like', $value)
                    ->orWhereHas('shop', function($q1) use($value) {
                    $q1->where('name', 'like', $value)
                        ->orWhereHas('category', function($q2) use($value) {
                            $q2->where('name', 'like', $value);
                        });
                });
            })->get();
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
    public function searchShops($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $value = "%" . collect($args)->get("name") . "%";
        // todo search including localization
        return $this->status(app(ShopRepository::class)->builder())
            ->where("name", "like", $value)
            ->orWhereHas('category', function($q) use($value) {
                $q->where('name', 'like', $value);
            })->orWhereHas('brands', function($q) use($value) {
                $q->where('name', 'like', $value)
                    ->orWhereHas('products', function($q1) use($value) {
                        $q1->where('name', 'like', $value);
                });
            })->orWhereHas('categories', function($q) use($value) {
                $q->where('name', 'like', $value)
                    ->orWhereHas('categories', function($q1) use($value) {
                        $q1->where('name', 'like', $value);
                });
            })->get();
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
    public function buyerOrders($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        return $this->orderBy($rootValue->orders());
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
    public function featuredShops($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        return app(ShopRepository::class)->featured(collect($args)->get('count', 2));
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
    public function featuredProducts($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        return app(ProductRepository::class)->featured(collect($args)->get('count', 2));
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
    public function productOffers($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $builder = $rootValue->offers();

        if (collect($args)->has('ordering')) {
            $ordering = collect($args)->get('ordering');
            if ($ordering == 'active') {
                $builder = $builder->whereDate("end_date", ">", Carbon::now()->toDateString());
                $builder = $this->status($builder, 'cancel', 0);
            }

            if ($ordering == 'cancelled') {
                $builder = $this->status($builder, 'cancel');
            }

            if ($ordering == 'expired') {
                $builder = $builder->whereDate("end_date", "<", Carbon::now()->toDateString());
            }
        }

        return $this->orderBy($builder);
    }

    /**
     * Order by column
     *
     * @param $builder
     * @param string $column
     * @param string $order
     * @return Builder
     */
    protected function orderBy($builder, $column="created_at", $order="desc") {
        return $builder->orderBy($column, $order);
    }

    /**
     * Get by status
     *
     * @param $builder
     * @param string $column
     * @param int $status
     * @return Builder
     */
    protected function status($builder, $column="active", $status=1) {
        if($status) {
            $builder = $builder->where($column, $status);
        }
        return $builder;
    }

    /**
     * Use filters
     *
     * @param $builder
     * @param $args
     * @return Builder
     */
    protected function withFilters($builder, $args) {
        if (!collect($args)->has('filters'))
            return $builder;

        $filters = collect($args["filters"]);
        $brandIds = json_decode($filters->get('brandIds'));
        $subCategoryIds = json_decode($filters->get('subCategoryIds'));
        $categoryIds = json_decode($filters->get('categoryIds'));
        $column = "created_at";
        $order = "desc";
        if (count($subCategoryIds)) {
            $builder = $builder->whereIn('subcategory_id', $subCategoryIds);
        }

        if (count($categoryIds)) {
            $builder = $builder->whereHas('brand', function($q) use($categoryIds) {
                $q->whereHas('shop', function($q1) use($categoryIds) {
                    $q1->whereIn('category_id', $categoryIds);
                });
            });
        }

        if (count($brandIds)) {
            $builder = $builder->whereIn('brand_id', $brandIds);
        }

        if ($filters->get('ordering') == 'oldest') {
            $order = "asc";
        }

        if ($filters->get('ordering') == 'lowest-price') {
            $order = "asc";
            $column = "price";
        }

        if ($filters->get('ordering') == 'highest-price') {
            $column = "price";
        }

        if ($filters->get('ordering') == 'active' || $filters->get('ordering') == 'inactive') {
            return $builder->where('active', $filters->get('ordering') == 'active' ? 1: 0);
        }

        return $this->orderBy($this->status($builder), $column, $order);
    }
}
