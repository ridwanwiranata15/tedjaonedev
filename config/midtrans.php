<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Midtrans Merchant ID
    |--------------------------------------------------------------------------
    */
    'merchant_id' => env('MIDTRANS_MERCHANT_ID'),

    /*
    |--------------------------------------------------------------------------
    | Midtrans Client Key (untuk frontend/Snap)
    |--------------------------------------------------------------------------
    */
    'client_key' => env('MIDTRANS_CLIENT_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Midtrans Server Key (untuk backend API calls)
    |--------------------------------------------------------------------------
    */
    'server_key' => env('MIDTRANS_SERVER_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Environment Setting
    |--------------------------------------------------------------------------
    | Set true untuk production, false untuk sandbox
    */
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),

    /*
    |--------------------------------------------------------------------------
    | Sanitization
    |--------------------------------------------------------------------------
    | Otomatis sanitize input untuk keamanan
    */
    'is_sanitized' => env('MIDTRANS_IS_SANITIZED', true),

    /*
    |--------------------------------------------------------------------------
    | 3D Secure
    |--------------------------------------------------------------------------
    | Enable 3DS untuk transaksi kartu kredit (recommended)
    */
    'is_3ds' => env('MIDTRANS_IS_3DS', true),

    /*
    |--------------------------------------------------------------------------
    | Snap URL
    |--------------------------------------------------------------------------
    */
    'snap_url' => env('MIDTRANS_IS_PRODUCTION', false)
        ? '<https://app.midtrans.com/snap/snap.js>'
        : '<https://app.sandbox.midtrans.com/snap/snap.js>',
];