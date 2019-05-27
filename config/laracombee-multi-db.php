<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 08/05/2019
 * Time: 11:32
 */

return [
    'default' => 'default',
    'databases' => [
        'default' => [
            'database' => 'product-mine',
            'token'    => 'APPWeex8lqDrz7F6T9zIcdPqTsii6xBSe7E0x8aM5HWnUUovJYuqNlLP1YNClBgS',
            'timeout' => 2000,
            'protocol' => 'http',
            'parties' => [
                'user'  => \Ddondola\User::class,
                'item'  => \Shoppie\Product::class,
            ],
        ],
        'shop-mine' => [
            'database' => 'shop-mine',
            'token'    => 'UOu6hjcAnrFIibN8Q3DyUk2KAEbKokxVumbYB16QPfoqsmHN9LSs5vfdg6ahZSAh',
            'timeout' => 2000,
            'protocol' => 'http',
            'parties' => [
                'user'  => \Ddondola\User::class,
                'item'  => \Shoppie\Shop::class,
            ],
        ]
    ]
];