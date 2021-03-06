<?php

namespace Raidros\Marketplace\Tests;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response as Psr7Response;
use Raidros\Collection\Exception\CollectionItemNotFound;
use Raidros\Marketplace\Api\Cnova;
use Raidros\Marketplace\Factory\ProductFactory;
use Raidros\Marketplace\Hub;
use Raidros\Marketplace\Support\BaseApi;
use Raidros\Marketplace\Transformers\CnovaOrderResponseTransformer;
use Raidros\Marketplace\Transformers\CnovaProductRequestTransformer;
use Raidros\Marketplace\Transformers\CnovaRequestTransformer;
use Raidros\Storer\Response;

class HubTest extends TestCase
{
    protected $hub;
    protected $api;
    protected $responseTemplate;
    public function setup()
    {
        parent::setup();

        $this->responseTemplate = file_get_contents('tests/json/CnovaOrders.json');
        $this->hub = new Hub([]);

        $mock = new MockHandler([
            new Psr7Response(200, [], $this->responseTemplate),
            new Psr7Response(200, [], $this->responseTemplate),
            new Psr7Response(200, [], $this->responseTemplate),
            new Psr7Response(200, [], $this->responseTemplate),
            new Psr7Response(200, [], $this->responseTemplate),
            new Psr7Response(200, []),
        ]);

        $handler = HandlerStack::create($mock);

        $this->api = new BaseApi(['handler' => $handler], function ($api) {
            $api->endpointGroup('get', [
                'get.orders'           => 'orders',
                'get.orders.approved'  => 'orders/status/approved',
                'get.orders.canceled'  => 'orders/status/canceled',
                'get.orders.sent'      => 'orders/status/sent',
                'get.orders.delivered' => 'orders/status/delivered',
            ], new CnovaRequestTransformer(), new CnovaOrderResponseTransformer());
            $api->endpoint('get', '/loads/products', 'post.products.loads')->transformer(new CnovaProductRequestTransformer(), 'request');
        });

        $this->hub->addApi($this->api, 'testApi');
    }

    public function testGetOrders()
    {
        $transformedResponse = new Response(new Psr7Response(200, [], $this->responseTemplate), new CnovaOrderResponseTransformer);

        $all = $this->hub->testApi()->orders()->limit(100)->offset(0)->page(1)->get();
        $approved = $this->hub->testApi()->orders()->approved()->get(1);
        $canceled = $this->hub->testApi()->orders()->canceled()->get(1);
        $sent = $this->hub->testApi()->orders()->sent()->get(1);
        $delivered = $this->hub->testApi()->orders()->delivered()->get(1);

        $this->assertEquals($all, $transformedResponse->getBody());
    }

    public function testSendLoads()
    {
        $factory = new ProductFactory();
        $data = $factory->generateData();
        $response = $this->hub->testApi()->products()->send($data);

        $this->assertEquals(['200'], [$response->promise()->getStatusCode()]);
    }

}
