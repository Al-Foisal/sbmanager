<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware {
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/pay-via-ajax',
        '/success',
        '/cancel',
        '/fail',
        
        //subscription uri
        '/subscription_success',
        '/subscription_fail',
        '/subscription__cancel',
        
        //online market uri
        '/online_market_success',
        '/online_market_fail',
        '/online_market__cancel',

        //default ipn
        '/ipn',
    ];
}
