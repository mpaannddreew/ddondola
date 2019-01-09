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
            'email' => 'andrewmvp007@gmail.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'password' => bcrypt('admin/admin')
        ]);

        $user_2 = $this->users->create([
            'first_name' => 'Faridah',
            'last_name' => 'Nankinzi',
            'email' => 'nankinzifaridah@gmail.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'password' => bcrypt('save/save')
        ]);

        $shopCategory = \Shoppie\Facades\Shoppie::newShopCategory('Electronics', 'This represents fashion shops');
        $shop = $user->newShop($shopCategory,'K & K Electronics');

        $productCategory = $shop->newProductCategory("Music gadgets");
        $product = $shop->newProduct($productCategory, ['name' => 'JB audio headsets', 'price' => '100000']);

        $product->checkIn('12', $user, "Stock increase");
        $product->checkIn('15', $user, "Stock increase");

        $this->users->id($user->id)->cart->addProduct($product, 5);
        $this->users->id($user_2->id)->cart->addProduct($product, 3);
    }
}
