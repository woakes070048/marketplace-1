<?php

namespace Raidros\Marketplace\Support;

use Raidros\Storer\Api;
use Raidros\Storer\Transformer;

class BaseApi extends Api
{
    public function orders()
    {
        return new Orders($this);
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
    public function endpointGroup($method, array $endpoints, Transformer $requestTransformer, Transformer $responseTransformers)
    {
        array_map(function ($key, $point) use ($method, $requestTransformer, $responseTransformers) {
            return $this->endpoint($method, $point, $key)
                ->transformer($responseTransformers, 'response')
                ->transformer($requestTransformer, 'request');
        }, array_keys($endpoints), $endpoints);

        return $this;
    }
}
