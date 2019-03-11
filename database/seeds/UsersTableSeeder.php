<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * @var \Ddondola\Repositories\UserRepository
     */
    protected $users;

    /**
     * UsersTableSeeder constructor.
     * @param \Ddondola\Repositories\UserRepository $users
     */
    public function __construct(\Ddondola\Repositories\UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = $this->users->create([
            'first_name' => 'Andrew',
            'last_name' => 'Mpande',
            'email' => 'andrew@ddondola.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'password' => bcrypt('secret')
        ]);

        $user_2 = $this->users->create([
            'first_name' => 'Faridah',
            'last_name' => 'Nankinzi',
            'email' => 'faridah@ddondola.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'password' => bcrypt('secret')
        ]);

        $shopCategory = \Shoppie\Facades\Shoppie::newShopCategory('Fashion', 'This represents fashion shops');
        $shop = $user->newShop($shopCategory, ['name' => 'K & K Electronics']);

        $productCategory = \Shoppie\Facades\Shoppie::newProductCategory($shop, "Men's Collection");
        $productSubCategory = \Shoppie\Facades\Shoppie::newProductSubCategory($productCategory, "T-shirts");
        $productBrand = \Shoppie\Facades\Shoppie::newProductBrand($shop, "Calvin Klein");
        $product = \Shoppie\Facades\Shoppie::newProduct($productSubCategory, $productBrand, ['name' => 'Elegant Lake', 'price' => '100000']);

    }
}
