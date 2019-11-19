<?php

use Illuminate\Database\Seeder;
use Illuminate\Contracts\Console\Kernel as ConsoleKernelContract;

class UsersTableSeeder extends Seeder
{
    /**
     * @var \Ddondola\Repositories\CountryRepository
     */
    protected $countries;

    /**
     * @var \Shoppie\Repository\ShopCategoryRepository
     */
    protected $categories;

    /**
     * @var \Ddondola\Repositories\UserRepository
     */
    protected $users;

    /**
     * @var \Ddondola\Repository\RoleRepository
     */
    protected $roles;

    /**
     * @var ConsoleKernelContract
     */
    protected $artisan;

    /**
     * UsersTableSeeder constructor.
     * @param \Ddondola\Repositories\CountryRepository $countries
     * @param \Shoppie\Repository\ShopCategoryRepository $categories
     * @param \Ddondola\Repositories\UserRepository $users
     * @param ConsoleKernelContract $artisan
     * @param \Ddondola\Repository\RoleRepository $roles
     */
    public function __construct(\Ddondola\Repositories\CountryRepository $countries,
                                \Shoppie\Repository\ShopCategoryRepository $categories,
                                \Ddondola\Repositories\UserRepository $users,
                                ConsoleKernelContract $artisan, \Ddondola\Repository\RoleRepository $roles)
    {
        $this->countries = $countries;
        $this->categories = $categories;
        $this->users = $users;
        $this->artisan = $artisan;
        $this->roles = $roles;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // creating admin bank account
        $this->artisan->call('bank:account');

        $this->countries->addCountries();
        $country = $this->countries->default();
        $vendor_role = $this->roles->create(['name' => 'Vendor', 'tag' => 'vendor', 'description' => 'Enables user to sell on the platform']);

        $this->users->create($country, [
            'first_name' => 'Andrew',
            'last_name' => 'Mpande',
            'email' => 'andrew@ddondola.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'password' => bcrypt('secret'),
            'is_staff' => 1,
            'is_superuser' => 1
        ]);

        $vendor = $this->users->create($country, [
            'first_name' => 'Faridah',
            'last_name' => 'Nankinzi',
            'email' => 'faridah@ddondola.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'password' => bcrypt('secret')
        ]);

        $this->roles->assignRole($vendor, $vendor_role);

        $this->users->create($country, [
            'first_name' => 'Hajara',
            'last_name' => 'Naluwalo',
            'email' => 'hajara@ddondola.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'password' => bcrypt('secret')
        ]);

        $category = $this->categories->create(["name" => 'Consumer Electronics/Home Appliances']);

        $vendor->newShop($category, [
            'name' => 'Electro',
            'profile' => [
                'email' => 'info@electro.com',
                'phone_number' => '0700000001',
                'about' => 'This is an electronics shop',
                'address' => 'Kiira, Mulawa'
            ]
        ]);
    }
}
