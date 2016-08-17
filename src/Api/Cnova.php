<?php

namespace Raidros\Marketplace\Api;

use Raidros\Marketplace\Support\BaseApi;
use Raidros\Marketplace\Transformers\CnovaOrderResponseTransformer;
use Raidros\Marketplace\Transformers\CnovaRequestTransformer;

class Cnova extends BaseApi
{
    public function __construct($config)
    {
        parent::__construct('https://sandbox.cnova.com/api/v2/', function ($api) use ($config) {
            // headers
            $api->header([
                'Content-Type' => 'application/json',
                'client_id'    => $config['client_id'],
                'access_token' => $config['access_token'],
            ], 'headers');

            // endpoints
            $api->endpoint('get', 'orders', 'get.orders')
                ->transformer(new CnovaOrderResponseTransformer(), 'response')
                ->transformer(new CnovaRequestTransformer(), 'request');

            $api->endpoint('get', 'orders/status/approved', 'get.orders.approved')
                ->transformer(new CnovaOrderResponseTransformer(), 'response')
                ->transformer(new CnovaRequestTransformer(), 'request');

            $api->endpoint('get', 'orders/status/canceled', 'get.orders.canceled')
                ->transformer(new CnovaOrderResponseTransformer(), 'response')
                ->transformer(new CnovaRequestTransformer(), 'request');

            $api->endpoint('get', 'orders/status/sent', 'get.orders.sent')
                ->transformer(new CnovaOrderResponseTransformer(), 'response')
                ->transformer(new CnovaRequestTransformer(), 'request');

            $api->endpoint('get', 'orders/status/delivered', 'get.orders.delivered')
                ->transformer(new CnovaOrderResponseTransformer(), 'response')
                ->transformer(new CnovaRequestTransformer(), 'request');
        });
    }
}
