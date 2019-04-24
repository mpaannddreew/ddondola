<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 18/04/2019
 * Time: 15:10
 */

return [
    'default' => env('PAYMENT_METHOD', 'mtn'),
    'methods' => [
        'mtn' => [
            'common' => [
                'callbackHost' => env('MOMO_CALLBACK_HOST', 'http://localhost:8000'),
                'callbackUrl' => env('MOMO_CALLBACK_URL', 'http://localhost:8000/callback'),
                'environment' => env('MOMO_TARGET_ENVIRONMENT', 'sandbox'),
                'accountHolderIdType' => env('MOMO_PARTY_ID_TYPE', 'msisdn'),
                'xReferenceId' => env('MOMO_API_USER_ID', ''),
                'apiKey' => env('MOMO_API_USER_KEY', ''),
                'accessToken' => env('MOMO_ACCESS_TOKEN', ''),
            ],
            'products' => [
                'collection' => [
                    'subscriptionKey' => env('MOMO_COLLECTION_SUBSCRIPTION_KEY', ''),
                    'preApproval' => env('MOMO_COLLECTION_PREAPPROVAL', false),
                ],
                'disbursement' => [
                    'subscriptionKey' => env('MOMO_DISBURSEMENT_SUBSCRIPTION_KEY', '')
                ],
                'remittance' => [
                    'subscriptionKey' => env('MOMO_COLLECTION_SUBSCRIPTION_KEY', ''),
                ],
            ]
        ]
    ]
];