<?php

namespace Raidros\Marketplace\Support;

use Raidros\Storer\Api;

class ProductSupport
{
    protected $api;

    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    public function send(array $data)
    {
        return $this->api->execute('post.products.loads', $data);
    }
}
