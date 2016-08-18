<?php

namespace Raidros\Marketplace\Support;

use Raidros\Storer\Api;

class BaseApi extends Api
{
    public function orders()
    {
        return new Orders($this);
    }

    public function endpointGroup($method, $endpoints)
    {
        return array_map(function ($key, $point) use ($method) {
            return $this->endpoint($method, $point, $key);
        }, array_keys($endpoints), $endpoints);
    }

    public function transformerGroup($endpoints, $requestTransformer, $responseTransformers)
    {
        array_map(function ($endpoint) use ($responseTransformers, $requestTransformer) {
            $endpoint->transformer($responseTransformers, 'response');
            $endpoint->transformer($requestTransformer, 'request');
        }, $endpoints);

        return $this;
    }
}
