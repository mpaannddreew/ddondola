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
use Shoppie\Shoppie;

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
        if (collect($args)->has('filters')) {
            $filters = collect($args["filters"]);
            $categoryIds = json_decode($filters->get('categoryIds'));
            if (count($categoryIds)) {
                $builder = $builder->whereIn('category_id', $categoryIds);
            }

            if ($filters->has('name')) {
                $builder = $builder->where("name", "like", "%" . $filters->get("name") . "%");
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
        if (collect($args)->has('search')) {
            $builder = $builder->where('name', 'like', '%' . collect($args)->get('search') . '%');
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
        if (collect($args)->get("category")) {
            $category = (app(ShopCategoryRepository::class)->code(collect($args)->get("category")))->getKey();
            $builder = $builder->whereHas('shop', function ($q) use ($category) {
                $q->whereIn("category_id", [$category]);
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
    public function paginatedStock($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        $builder = $rootValue->stock();

        if (collect($args)->has('type')) {
            $builder = $builder->where(collect($args)->get('type'), 1);
        }

        return $builder;
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
    public function orderSum($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        if (collect($args)->has('shop')) {
            return $rootValue->sumByShop(collect($args)->get('shop'));
        }

        return $rootValue->sum();
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
    public function activeSum($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        if (collect($args)->has('shop')) {
            return $rootValue->activeSumByShop(collect($args)->get('shop'));
        }

        return $rootValue->activeSum();
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
    public function firstProduct($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        if (collect($args)->has('shop')) {
            return $rootValue->firstProductByShop(collect($args)->get('shop'));
        }

        return $rootValue->firstProduct();
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
    public function cancelled($rootValue, array $args, GraphQLContext $context = null, ResolveInfo $resolveInfo)
    {
        if (collect($args)->has('shop')) {
            return $rootValue->cancelledByShop(collect($args)->get('shop'));
        }

        return $rootValue->cancelled();
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
            $builder = $builder->whereHas('shop', function ($q1) use ($shop) {
                $q1->where('shop_id', $shop->getKey());
            });
        }

        return $builder;
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
        $builder = app(OrderRepository::class)->builder();
        if (collect($args)->has('search')) {
            $value = '%' . collect($args)->get('search')  . '%';
            $builder->where(function ($query) use ($rootValue, $value) {
                $query->whereIn('id', $rootValue->orderIds())
                    ->where("code", 'like', $value);
            })->orWhere(function ($query) use ($rootValue, $value) {
                $query->whereIn('id', $rootValue->orderIds())
                    ->whereHas('by', function ($q) use ($value) {
                        $q->where('first_name', 'like', $value);
                    });
            })->orWhere(function ($query) use ($rootValue, $value) {
                $query->whereIn('id', $rootValue->orderIds())
                    ->whereHas('by', function ($q) use ($value) {
                        $q->where('last_name', 'like', $value);
                    });
            })->orWhere(function ($query) use ($rootValue, $value) {
                $query->whereIn('id', $rootValue->orderIds())
                    ->whereHas('by', function ($q) use ($value) {
                        $q->where('email', 'like', $value);
                    });
            });
        }
        return $this->orderBy($builder);
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
        return $rootValue->subcategory->products()->inRandomOrder()->get()->reject(function (Product $product) use ($rootValue){
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
        $builder = $rootValue->categories();
        if (collect($args)->has('name')) {
            $builder = $builder->where('name', 'like', '%' . collect($args)->get('name') . '%');
        }

        return $this->orderBy($builder);
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
        $builder = $rootValue->subcategories();
//        todo fix many through
//        if (collect($args)->has('name')) {
//            $builder = $builder->where('name', 'like', '%' . collect($args)->get('name') . '%');
//        }

        return $this->orderBy($builder);
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
        $builder = $rootValue->brands();
        if (collect($args)->has('name')) {
            $builder = $builder->where('name', 'like', '%' . collect($args)->get('name') . '%');
        }

        return $this->orderBy($builder);
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
        return app(Shoppie::class)
            ->likeStatus($context->user(), app(ShopRepository::class)->id($args["id"]));
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
        return app(Shoppie::class)
            ->favouriteStatus($context->user(), app(ProductRepository::class)->id($args["id"]));
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

        return $this->status(app(ProductRepository::class)->builder())
            ->where(function ($query) use ($value) {
                $query->has('media')
                    ->where("name", "like", $value);
            })->orWhere(function ($query) use ($value) {
                $query->has('media')
                    ->whereHas('subcategory', function ($q) use ($value) {
                        $q->where('name', 'like', $value)
                            ->orWhereHas('category', function ($q) use ($value) {
                                $q->where('name', 'like', $value);
                            });
                    });
            })->orWhere(function ($query) use ($value) {
                $query->has('media')
                    ->whereHas('brand', function ($q) use ($value) {
                        $q->where('name', 'like', $value);
                    });
            })->orWhere(function ($query) use ($value) {
                $query->has('media')
                    ->whereHas('shop', function ($q) use ($value) {
                        $q->where('name', 'like', $value)
                            ->orWhereHas('category', function ($q) use ($value) {
                                $q->where('name', 'like', $value);
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

        return $this->status(app(ShopRepository::class)->builder())
            ->where("name", "like", $value)
            ->orWhereHas('category', function($q) use($value) {
                $q->where('name', 'like', $value);
            })->orWhereHas('brands', function($q) use($value) {
                $q->where('name', 'like', $value)
                    ->orWhereHas('products', function($q) use($value) {
                        $q->where('name', 'like', $value);
                });
            })->orWhereHas('categories', function($q) use($value) {
                $q->where('name', 'like', $value)
                    ->orWhereHas('categories', function($q) use($value) {
                        $q->where('name', 'like', $value);
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
        $builder = $rootValue->orders();
        if (collect($args)->has('search')) {
            $builder = $builder->where("code", 'like', '%' . collect($args)->get('search')  . '%');
        }

        // todo add date filter

        return $this->orderBy($builder);
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
        $column = "created_at";
        $order = "desc";

        if ($filters->has('name') && $filters->get("name")) {
            $builder = $builder->where("name", "like", "%" . $filters->get("name") . "%");
        }

        if ($filters->has('subCategoryIds')) {
            $subCategoryIds = json_decode($filters->get('subCategoryIds'));
            if (count($subCategoryIds))
                $builder = $builder->whereIn('subcategory_id', $subCategoryIds);
        }

        if ($filters->has('categoryIds')) {
            $categoryIds = json_decode($filters->get('categoryIds'));
            if (count($categoryIds))
                $builder = $builder->whereHas('shop', function($q1) use($categoryIds) {
                    $q1->whereIn('category_id', $categoryIds);
                });
        }

        if ($filters->has('brandIds')) {
            $brandIds = json_decode($filters->get('brandIds'));
            if (count($brandIds))
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
