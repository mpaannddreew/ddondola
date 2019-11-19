<?php

namespace Shoppie\Http\Controllers;


use Ddondola\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Shoppie\Order;
use Shoppie\Product;
use Shoppie\Repository\ProductBrandRepository;
use Shoppie\Repository\ProductCategoryRepository;
use Shoppie\Repository\ProductRepository;
use Shoppie\Repository\ProductSubCategoryRepository;
use Shoppie\Repository\ShopCategoryRepository;
use Shoppie\Repository\ShopRepository;
use Shoppie\Shop;

class ShoppieController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var ShopCategoryRepository
     */
    protected $categories;

    /**
     * @var ShopRepository
     */
    protected $shops;

    /**
     * @var ProductRepository
     */
    protected $products;

    /**
     * @var ProductCategoryRepository
     */
    protected $productCategories;

    /**
     * @var ProductBrandRepository
     */
    protected $brands;

    /**
     * @var ProductSubCategoryRepository
     */
    protected $subcategories;

    /**
     * ShoppieController constructor.
     * @param ShopCategoryRepository $categories
     * @param ShopRepository $shops
     * @param ProductRepository $products
     * @param ProductCategoryRepository $productCategories
     * @param ProductBrandRepository $brands
     * @param ProductSubCategoryRepository $subcategories
     */
    public function __construct(ShopCategoryRepository $categories, ShopRepository $shops, ProductRepository $products,
                                ProductCategoryRepository $productCategories, ProductBrandRepository $brands,
                                ProductSubCategoryRepository $subcategories)
    {
        $this->categories = $categories;
        $this->shops = $shops;
        $this->products = $products;
        $this->productCategories = $productCategories;
        $this->brands = $brands;
        $this->subcategories = $subcategories;
    }

    /**
     * Shops view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function shops() {
        return view('shoppie::shops');
    }

    /**
     * User shop view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myShops() {
        return view('shoppie::me.shops.index');
    }

    /**
     * Create shop form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createShop() {
        return view('shoppie::me.shops.new-shop', ['categories' => $this->categories->all()]);
    }

    /**
     * Create new shop
     *
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function saveShop(Request $request) {
        $this->validate($request, [
            'category' => 'required|numeric',
            'name' => 'required|string',
            'phone_number' => 'required|numeric',
            'email' => 'required|email',
            'about' => 'required',
            'address' => 'required'
        ]);

        $this->shops->create(
            $request->user(),
            $this->categories->id($request->input('category')),
            array_merge($request->only(['name']), ['profile' => $request->only(['phone_number', 'email', 'about', 'address']), 'active' => 1])
        );

        return redirect()->route('my.shops');
    }

    /**
     * Show shop products
     *
     * @param Request $request
     * @param Shop $shop
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function shopProducts(Request $request, Shop $shop) {
        if (Auth::check()) {
            if ($request->user()->manages($shop))
                return view('shoppie::shop.admin.products', ['shop' => $shop]);

            if (!$shop->owner->country->is($request->user()->country))
                abort(404);
        }

        if (!$shop->active)
            abort(404);

        return view('shoppie::shop.basic.products', ['shop' => $shop]);
    }

    /**
     * Shop reviews
     *
     * @param Request $request
     * @param Shop $shop
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function shopReviews(Request $request, Shop $shop) {
        if (Auth::check()) {
            if ($request->user()->manages($shop))
                return view('shoppie::shop.admin.reviews', ['shop' => $shop]);

            if (!$shop->owner->country->is($request->user()->country))
                abort(404);
        }

        if (!$shop->active)
            abort(404);

        return view('shoppie::shop.basic.reviews', ['shop' => $shop]);
    }

    /**
     * Edit shop form
     *
     * @param Request $request
     * @param Shop $shop
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function shopEdit(Request $request, Shop $shop) {
        return view('shoppie::shop.admin.shop-info', ['shop' => $shop, 'categories' => $this->categories->all()]);
    }

    /**
     * Update shop
     *
     * @param Request $request
     * @param Shop $shop
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function shopUpdate(Request $request, Shop $shop) {
        $this->validate($request, [
            'category' => 'required|numeric',
            'name' => 'required|string',
            'phone_number' => 'required|numeric',
            'email' => 'required|email',
            'about' => 'required',
            'address' => 'required'
        ]);

        $attributes = [
            'name' => $request->input('name'),
            'profile' => $request->only(['phone_number', 'email', 'about', 'address'])
        ];

        $category = $this->categories->id($request->input('category'));
        if (!$shop->category->is($category)) {
            $attributes['category_id'] = $request->input('category');
        }

        $this->shops->update($shop, $attributes);
        return redirect()->route('my.shop.edit', ['shop' => $shop])->with('success', 'Shop updated successfully');
    }

    /**
     * Shop dashboard
     *
     * @param Request $request
     * @param Shop $shop
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function shopDashboard(Request $request, Shop $shop) {
        return view('shoppie::shop.admin.dashboard', ['shop' => $shop]);
    }

    /**
     * Shop inventory
     *
     * @param Request $request
     * @param Shop $shop
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function shopInventory(Request $request, Shop $shop) {
        return view('shoppie::shop.admin.inventory.index', ['shop' => $shop]);
    }

    /**
     * Shop messenger view
     *
     * @param Request $request
     * @param Shop $shop
     * @param User|null $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function shopMessenger(Request $request, Shop $shop, User $user = null) {
        return view('shoppie::shop.admin.messenger', ['shop' => $shop]);
    }

    /**
     * Shop wallet view
     *
     * @param Request $request
     * @param Shop $shop
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function shopWallet(Request $request, Shop $shop) {
        return view('shoppie::shop.admin.wallet', ['shop' => $shop]);
    }

    /**
     * Shop orders view
     *
     * @param Request $request
     * @param Shop $shop
     * @param Order|null $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function shopOrders(Request $request, Shop $shop, Order $order = null) {
        if ($order)
            if (!$order->isHandledBy($shop))
                abort(403);

        if ($request->user()->manages($shop))
            return view('shoppie::shop.admin.orders', ['shop' => $shop]);

        abort(404);
    }

    /**
     * Show user cart view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myCart() {
        return view('shoppie::me.cart.index');
    }

    /**
     * User cart checkout
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function myCartCheckout(Request $request) {
        $order = $request->user()->checkout();
        return redirect()->route('my.orders', ['order' => $order]);
    }

    /**
     * User wishlist
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myWishlist() {
        return view('shoppie::me.wishlist');
    }

    /**
     * User orders view
     *
     * @param Request $request
     * @param Order|null $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function myOrders(Request $request, Order $order = null) {
        if ($order)
            $this->authorize('update', $order);

        return view('shoppie::me.orders');
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function myOrderPayment(Request $request, Order $order) {
        return $this->myOrders($request, $order);
    }

    /**
     * Products view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function products() {
        return view('shoppie::products');
    }

    /**
     * Show product details
     *
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function product(Request $request, Product $product) {
        if (Auth::check()) {
            if ($request->user()->ownsProduct($product))
                return view('shoppie::shop.product.admin.index', ['product' => $product]);

            if (!$product->shop->owner->country->is($request->user()->country))
                abort(404);
        }

        if (!$product->active)
            abort(404);

        return view('shoppie::shop.product.basic.index', ['product' => $product]);
    }

    /**
     * Show product reviews
     *
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productReviews(Request $request, Product $product) {
        if (Auth::check()) {
            if ($request->user()->ownsProduct($product))
                return view('shoppie::shop.product.admin.reviews', ['product' => $product]);

            if (!$product->shop->owner->country->is($request->user()->country))
                abort(404);
        }

        if (!$product->active)
            abort(404);

        return view('shoppie::shop.product.basic.reviews', ['product' => $product]);
    }

    /**
     * Show product dashboard
     *
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productDashboard(Request $request, Product $product) {
        return view('shoppie::shop.product.admin.dashboard', ['product' => $product]);
    }

    /**
     * Show edit product form
     *
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productEdit(Request $request, Product $product) {
        return view('shoppie::shop.product.admin.edit-product', ['product' => $product]);
    }

    /**
     * Update product
     *
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function productUpdate(Request $request, Product $product) {
        $this->validate($request, [
            'category' => 'required|numeric',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'attributes' => 'required|string'
        ]);

        $brand = null;
        if ($request->has('brand') && $request->input('brand'))
            $brand = $this->brands->id($request->input('brand'));

        $category = $this->subcategories->id($request->input('category'));
        $attributes = array_merge(
            $request->only(['name', 'price', 'description']),
            ['settings' => ['attributes' => json_decode($request->input('attributes'))]]
        );
        $this->products->update($product,$category, $brand, $attributes);

        return redirect()->route('product.edit', ['product' => $product]);
    }

    /**
     * Product offers
     *
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productEditOffers(Request $request, Product $product) {
        return view('shoppie::shop.product.admin.edit-offers', ['product' => $product]);
    }

    /**
     * Product stock
     *
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productStock(Request $request, Product $product) {
        return view('shoppie::shop.product.admin.stock', ['product' => $product]);
    }

    /**
     * Product gallery
     *
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productGallery(Request $request, Product $product) {
        return view('shoppie::shop.product.admin.gallery', ['product' => $product]);
    }

    /**
     * Update product gallery
     *
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProductGallery(Request $request, Product $product) {
        $media = $product->addMediaFromRequest('images')->toMediaCollection('products');

        return response()->json($media->getKey());
    }

    public function shopCategories(Request $request, Shop $shop) {
        return view('shoppie::shop.admin.inventory.categories', ['shop' => $shop]);
    }

    public function shopSubCategories(Request $request, Shop $shop) {
        return view('shoppie::shop.admin.inventory.sub-categories', ['shop' => $shop]);
    }

    public function shopBrands(Request $request, Shop $shop) {
        return view('shoppie::shop.admin.inventory.brands', ['shop' => $shop]);
    }

    public function newProduct(Request $request, Shop $shop) {
        return view('shoppie::shop.admin.inventory.new-product', ['shop' => $shop]);
    }

    /**
     * @param Request $request
     * @param Shop $shop
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function saveProduct(Request $request, Shop $shop) {
        $this->validate($request, [
            'category' => 'required|numeric',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'attributes' => 'required|string',
            'description' => 'required|string',
        ]);

        $brand = null;
        if ($request->has('brand') && $request->input('brand'))
            $brand = $this->brands->id($request->input('brand'));

        $category = $this->subcategories->id($request->input('category'));
        $attributes = array_merge(
            $request->only(['name', 'price', 'description']),
            ['settings' => ['attributes' => json_decode($request->input('attributes'))]]
        );
        $product = $this->products->create($shop, $category, $brand, $attributes);

        return redirect()->route('product.gallery', ['product' => $product]);
    }
}
