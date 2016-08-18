<?php

namespace Raidros\Marketplace\Support;

use Raidros\Storer\Api;
use Raidros\Storer\Transformer;

class BaseApi extends Api
{
    public function orders()
    {
        return new OrderSupport($this);
    }

    public function products()
    {
        return new ProductSupport($this);
    }

    /**
     * Create endpoints based on array data.
     *
     * @param string                     $method
     * @param array                      $endpoints
     * @param Raidros\Storer\Transformer $requestTransformer
     * @param Raidros\Storer\Transformer $responseTransformers
     *
     * @return self
     */
    public function endpointGroup($method, array $endpoints, Transformer $reqTrans, Transformer $respTrans)
    {
        array_map(function ($key, $point) use ($method, $reqTrans, $respTrans) {
            return $this->endpoint($method, $point, $key)
                ->transformer($respTrans, 'response')
                ->transformer($reqTrans, 'request');
        }, array_keys($endpoints), $endpoints);

        return $this;
    }
}
