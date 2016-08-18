<?php

namespace Raidros\Marketplace\Sandbox;

use Raidros\Marketplace\Api\Cnova;

class CnovaSandbox
{
    protected $api;

    public function __construct(Cnova $api)
    {
        $this->api = $api;
    }

    public function sendFakerProducts($max = 1)
    {
        $productFactory = new CnovaProductFactory();

        return $this->api->execute('post.products', $productFactory->generateData($max));
    }
}
