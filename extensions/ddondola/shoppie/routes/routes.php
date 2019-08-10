<?php

Route::namespace('Shoppie\Http\Controllers')->middleware(['web'])->group(function () {
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::prefix('me')->group(function () {
            Route::prefix('cart')->group(function () {
                Route::get('/', 'ShoppieController@myCart')->name('my.cart');
                Route::get('checkout', 'ShoppieController@myCartCheckout')->name('my.cart.checkout')->middleware(['cart.checkout']);
            });
            Route::get('wishlist', 'ShoppieController@myWishlist')->name('my.wishlist');
            Route::get('orders/{order?}', 'ShoppieController@myOrders')->name('my.orders');
            Route::prefix('shops')->group(function () {
                Route::get('/', 'ShoppieController@myShops')->name('my.shops');
                Route::get('create', 'ShoppieController@createShop')->name('create.shop');
                Route::post('save', 'ShoppieController@saveShop')->name('save.shop');
            });
        });
        Route::middleware(['admin.staff'])->prefix('admin')->group(function (){
            Route::get('shops/{shop?}', 'AdminController@shops')->name('admin.shops');
            Route::get('categories', 'AdminController@categories')->name('admin.categories');
        });
    });

    Route::prefix('shops')->group(function () {
        Route::get('/', 'ShoppieController@shops')->name('shops');
        Route::get('{shop}', 'ShoppieController@shopProducts')->name('shop');
        Route::get('{shop}/reviews', 'ShoppieController@shopReviews')->name('shop.reviews');
        Route::middleware(['auth', 'verified'])->group(function () {
            Route::get('{shop}/dashboard', 'ShoppieController@shopDashboard')->name('my.shop.dashboard');
            Route::prefix('{shop}/inventory')->group(function () {
                Route::get('/', 'ShoppieController@shopInventory')->name('my.shop.inventory');
                Route::get('categories', 'ShoppieController@shopCategories')->name('my.shop.categories');
                Route::get('sub-categories', 'ShoppieController@shopSubCategories')->name('my.shop.sub-categories');
                Route::get('brands', 'ShoppieController@shopBrands')->name('my.shop.brands');
                Route::get('new-product', 'ShoppieController@newProduct')->name('my.shop.inventory.new-product');
                Route::post('new-product', 'ShoppieController@saveProduct')->name('my.shop.inventory.save-product');
            });
            Route::get('{shop}/messenger/{user?}', 'ShoppieController@shopMessenger')->name('my.shop.messenger');
            Route::get('{shop}/orders/{order?}', 'ShoppieController@shopOrders')->name('my.shop.orders');
            Route::get('{shop}/edit', 'ShoppieController@shopEdit')->name('my.shop.edit');
            Route::post('{shop}/update', 'ShoppieController@shopUpdate')->name('my.shop.update');
        });
    });

    Route::prefix('products')->group(function () {
        Route::get('/', 'ShoppieController@products')->name('products');
        Route::get('{product}', 'ShoppieController@product')->name('product');
        Route::get('{product}/reviews', 'ShoppieController@productReviews')->name('product.reviews');
        Route::middleware(['auth', 'verified'])->group(function () {
            Route::get('{product}/dashboard', 'ShoppieController@productDashboard')->name('product.dashboard');
            Route::get('{product}/stock', 'ShoppieController@productStock')->name('product.stock');
            Route::get('{product}/edit', 'ShoppieController@productEdit')->name('product.edit');
            Route::post('{product}/update', 'ShoppieController@productUpdate')->name('product.update');
            Route::get('{product}/edit/offers', 'ShoppieController@productEditOffers')->name('product.edit.offers');
            Route::get('{product}/gallery', 'ShoppieController@productGallery')->name('product.gallery');
            Route::post('{product}/gallery', 'ShoppieController@updateProductGallery')->name('product.gallery');
        });
    });
});