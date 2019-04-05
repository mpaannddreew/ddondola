<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * @var \Ddondola\Repositories\CountryRepository
     */
    protected $countries;

    /**
     * UsersTableSeeder constructor.
     * @param \Ddondola\Repositories\CountryRepository $countries
     */
    public function __construct(\Ddondola\Repositories\CountryRepository $countries)
    {
        $this->countries = $countries;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->countries->addCountries();
        $country = $this->countries->code('ug');

        $users = [
            [
                'first_name' => 'Andrew',
                'last_name' => 'Mpande',
                'email' => 'andrew@ddondola.com',
                'email_verified_at' => \Carbon\Carbon::now(),
                'password' => bcrypt('secret')
            ],
            [
                'first_name' => 'Faridah',
                'last_name' => 'Nankinzi',
                'email' => 'faridah@ddondola.com',
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
            \Shoppie\Facades\Shoppie::newShopCategory($category);
        }

    }
}
