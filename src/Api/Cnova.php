<?php

namespace Raidros\Marketplace\Api;

use Raidros\Marketplace\Support\BaseApi;
use Raidros\Marketplace\Transformers\CnovaOrderResponseTransformer;
use Raidros\Marketplace\Transformers\CnovaProductRequestTransformer;
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
            $api->endpointGroup('get', [
                'get.orders'           => 'orders',
                'get.orders.approved'  => 'orders/status/approved',
                'get.orders.canceled'  => 'orders/status/canceled',
                'get.orders.sent'      => 'orders/status/sent',
                'get.orders.delivered' => 'orders/status/delivered',
            ], new CnovaRequestTransformer(), new CnovaOrderResponseTransformer());

            $api->endpoint('post', 'loads/products', 'post.products.loads')
                ->transformer(new CnovaProductRequestTransformer(), 'request');
        });
    }
}
