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
use Shoppie\Repository\ProductRepository;
use Shoppie\Repository\ShopCategoryRepository;
use Shoppie\Repository\ShopRepository;
use Shoppie\Shop;

class ShoppieController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $categories;

    protected $shops;

    protected $products;

    public function __construct(ShopCategoryRepository $categories, ShopRepository $shops, ProductRepository $products)
    {
        $this->categories = $categories;
        $this->shops = $shops;
        $this->products = $products;
    }

    public function shops() {
        return view('shoppie::shops');
    }

    public function myShops() {
        return view('shoppie::me.shops.index');
    }

    public function createShop() {
        return view('shoppie::me.shops.new-shop', ['categories' => $this->categories->builder()->get()]);
    }

    /**
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
            'description' => 'required',
            'address' => 'required'
        ]);

        $request->user()->newShop(
            $this->categories->id($request->input('category')), [
            'name' => $request->input('name'),
            'profile' => $request->only(['phone_number', 'email', 'description', 'address']),
            'active' => 1
        ]);

        return redirect()->route('my.shops');
    }

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

    public function shopEdit(Request $request, Shop $shop) {
        if ($request->user()->manages($shop))
            return view('shoppie::shop.admin.shop-info',
                ['shop' => $shop, 'categories' => $this->categories->builder()->get()]);

        abort(404);
    }

    /**
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
            'description' => 'required',
            'address' => 'required'
        ]);

        $attributes = [
            'name' => $request->input('name'),
            'profile' => $request->only(['phone_number', 'email', 'description', 'address'])
        ];

        $category = $this->categories->id($request->input('category'));
        if (!$shop->category->is($category)) {
            $attributes['category_id'] = $request->input('category');
        }

        $this->shops->update($shop, $attributes);
        return redirect()->route('my.shop.edit', ['shop' => $shop])->with('success', 'Shop updated successfully');
    }

    public function shopDashboard(Request $request, Shop $shop) {
        if ($request->user()->manages($shop))
            return view('shoppie::shop.admin.dashboard', ['shop' => $shop]);

        abort(404);
    }

    public function shopInventory(Request $request, Shop $shop) {
        if ($request->user()->manages($shop))
            return view('shoppie::shop.admin.inventory.index', ['shop' => $shop]);

        abort(404);
    }

    public function shopMessenger(Request $request, Shop $shop, User $user = null) {
        if ($request->user()->manages($shop))
            return view('shoppie::shop.admin.messenger', ['shop' => $shop]);

        abort(404);
    }

    public function shopOrders(Request $request, Shop $shop, Order $order = null) {
        if ($order)
            if (!$order->isHandledBy($shop))
                abort(404);

        if ($request->user()->manages($shop))
            return view('shoppie::shop.admin.orders', ['shop' => $shop]);

        abort(404);
    }

    public function myCart() {
        return view('shoppie::me.cart.index');
    }

    public function myCartCheckout() {
        return view('shoppie::me.cart.checkout');
    }

    public function myWishlist() {
        return view('shoppie::me.wishlist');
    }

    public function myOrders(Request $request, Order $order = null) {
        if ($order)
            if (!$order->by->is($request->user()))
                abort(404);

        return view('shoppie::me.orders');
    }

    public function products() {
        return view('shoppie::products');
    }

    public function product(Request $request, Product $product) {
        if (Auth::check()) {
            if ($request->user()->ownsProduct($product))
                return view('shoppie::shop.product.admin.index', ['product' => $product]);

            if (!$product->shop()->owner->country->is($request->user()->country))
                abort(404);
        }

        if (!$product->active)
            abort(404);

        return view('shoppie::shop.product.basic.index', ['product' => $product]);
    }

    public function productReviews(Request $request, Product $product) {
        if (Auth::check()) {
            if ($request->user()->ownsProduct($product))
                return view('shoppie::shop.product.admin.reviews', ['product' => $product]);

            if (!$product->shop()->owner->country->is($request->user()->country))
                abort(404);
        }

        if (!$product->active)
            abort(404);

        return view('shoppie::shop.product.basic.reviews', ['product' => $product]);
    }

    public function productDashboard(Request $request, Product $product) {
        if ($request->user()->ownsProduct($product))
            return view('shoppie::shop.product.admin.dashboard', ['product' => $product]);

        abort(404);
    }

    public function productStock(Request $request, Product $product) {
        if ($request->user()->ownsProduct($product))
            return view('shoppie::shop.product.admin.stock', ['product' => $product]);

        abort(404);
    }

    public function productEdit(Request $request, Product $product) {
        if ($request->user()->ownsProduct($product))
            return view('shoppie::shop.product.admin.edit-product', ['product' => $product]);

        abort(404);
    }

    public function productEditOffers(Request $request, Product $product) {
        if ($request->user()->ownsProduct($product))
            return view('shoppie::shop.product.admin.edit-offers', ['product' => $product]);

        abort(404);
    }

    public function productGallery(Request $request, Product $product) {
        if ($request->user()->ownsProduct($product))
            return view('shoppie::shop.product.admin.gallery', ['product' => $product]);

        abort(404);
    }

    public function shopCategories(Request $request, Shop $shop) {
        if ($request->user()->manages($shop))
            return view('shoppie::shop.admin.inventory.categories', ['shop' => $shop]);

        abort(404);
    }

    public function shopSubCategories(Request $request, Shop $shop) {
        if ($request->user()->manages($shop))
            return view('shoppie::shop.admin.inventory.sub-categories', ['shop' => $shop]);

        abort(404);
    }

    public function shopBrands(Request $request, Shop $shop) {
        if ($request->user()->manages($shop))
            return view('shoppie::shop.admin.inventory.brands', ['shop' => $shop]);

        abort(404);
    }

    public function newProduct(Request $request, Shop $shop) {
        if ($request->user()->manages($shop))
            return view('shoppie::shop.admin.inventory.new-product', ['shop' => $shop]);

        abort(404);
    }
}