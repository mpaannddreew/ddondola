<?php

use Illuminate\Database\Seeder;

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
     * UsersTableSeeder constructor.
     * @param \Ddondola\Repositories\CountryRepository $countries
     * @param \Shoppie\Repository\ShopCategoryRepository $categories
     * @param \Ddondola\Repositories\UserRepository $users
     */
    public function __construct(\Ddondola\Repositories\CountryRepository $countries,
                                \Shoppie\Repository\ShopCategoryRepository $categories,
                                \Ddondola\Repositories\UserRepository $users)
    {
        $this->countries = $countries;
        $this->categories = $categories;
        $this->users = $users;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->countries->addCountries();
        $country = $this->countries->default();

        $users = [
            [
                'first_name' => 'Andrew',
                'last_name' => 'Mpande',
                'email' => 'andrew@ddondola.com',
                'email_verified_at' => \Carbon\Carbon::now(),
                'password' => bcrypt('secret'),
                'is_staff' => 1,
                'is_superuser' => 1
            ],
            [
                'first_name' => 'Faridah',
                'last_name' => 'Nankinzi',
                'email' => 'faridah@ddondola.com',
                'email_verified_at' => \Carbon\Carbon::now(),
                'password' => bcrypt('secret')
            ],
            [
                'first_name' => 'Hajara',
                'last_name' => 'Naluwalo',
                'email' => 'hajara@ddondola.com',
                'email_verified_at' => \Carbon\Carbon::now(),
                'password' => bcrypt('secret')
            ],
            [
                'first_name' => 'Joze',
                'last_name' => 'Ddiba',
                'email' => 'joze@ddondola.com',
                'email_verified_at' => \Carbon\Carbon::now(),
                'password' => bcrypt('secret')
            ],
            [
                'first_name' => 'Mikel',
                'last_name' => 'Terzz',
                'email' => 'mikel@ddondola.com',
                'email_verified_at' => \Carbon\Carbon::now(),
                'password' => bcrypt('secret')
            ]
        ];

        foreach ($users as $user) {
            $country->users()->create($user);
        }

        $shop_categories = [
            'Machinery/Mechanical Parts/Tools', 'Consumer Electronics/Home Appliances', 'Auto/Transportation',
            'Apparel/Textiles/Timepieces', 'Home & Garden/Construction/Lights', 'Beauty & Personal Care/Health'
        ];

        foreach ($shop_categories as $category) {
            $this->categories->create(["name" => $category]);
        }

        $shops = [
            [
                'name' => 'Apex Beauty Parlour',
                'profile' => [
                    'email' => 'info@apex.com',
                    'phone_number' => '0700000000',
                    'about' => 'This is a beauty shop',
                    'address' => 'Kiira, Bulindo'
                ]
            ],
            [
                'name' => 'Electro',
                'profile' => [
                    'email' => 'info@electro.com',
                    'phone_number' => '0700000001',
                    'about' => 'This is an electronics shop',
                    'address' => 'Kiira, Mulawa'
                ]
            ],
            [
                'name' => 'Duplex Mechanics',
                'profile' => [
                    'email' => 'info@duplex.com',
                    'phone_number' => '0700000002',
                    'about' => 'This is a mechanics shop',
                    'address' => 'Kiira, Nsasa'
                ]
            ]
        ];
        $category = $this->categories->id(1);
        $user = $this->users->id(1);
        foreach ($shops as $shop) {
            $user->newShop($category, $shop);
        }
    }
}
