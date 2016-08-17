<?php

namespace Raidros\Marketplace\Tests;

use Raidros\Collection\Exception\CollectionItemNotFound;
use Raidros\Marketplace\Api\Cnova;
use Raidros\Marketplace\Exception\ApiClassNotFound;
use Raidros\Marketplace\Hub;

class BasicTest extends TestCase
{

    public function testConfigInvalidApi()
    {
        $this->setExpectedException(ApiClassNotFound::class);

        $hub = new Hub([
            'InvalidApiName' => [
                'foo' => 'bar',
            ],
        ]);
    }

    public function testCallInvalidApi()
    {
        $this->setExpectedException(CollectionItemNotFound::class);

        $hub = new Hub([
            'Cnova' => [
                'client_id' => 'eoRyAoaewuUy',
                'access_token' => 'NW4fNasvBPdH',
            ],
        ]);

        $hub->invalidApi();
    }

    public function testCallApi()
    {
        $hub = new Hub([
            'Cnova' => [
                'client_id' => 'eoRyAoaewuUy',
                'access_token' => 'NW4fNasvBPdH',
            ],
        ]);

        $this->assertInstanceOf(Cnova::class, $hub->Cnova());
    }
}
