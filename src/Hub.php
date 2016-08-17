<?php

namespace Raidros\Marketplace;

use Raidros\Collection\Collection;
use Raidros\Collection\Exception\CollectionItemNotFound;
use Raidros\Marketplace\Exception\ApiClassNotFound;
use Raidros\Storer\Api;

class Hub
{
    protected $apis;

    public function __construct($configuration)
    {
        $this->apis = new Collection(Api::class);

        array_map(function($api, $config){
            $apiClass = 'Raidros\Marketplace\Api\\'.$api;

            if (! class_exists($apiClass)) {
                throw new ApiClassNotFound('Api class not found: '.$apiClass);
            }

            return $this->apis->add(new $apiClass($config), $api);
        }, array_keys($configuration), $configuration);
    }

    /**
     * Add a third party api in the hub.
     *
     * @param Raidros\Storer\Api $api
     * @param string             $name
     *
     * @return Raidros\Storer\Api
     */
    public function addApi(Api $api, $name)
    {
        return $this->apis->add($api, $name);
    }

    public function __call($method, $args) {
        try {
            return $this->apis->findOrFail($method);
        } catch (\Exception $e) {
            throw new CollectionItemNotFound('Method or Api not found in marketplace hub: '.$method);
        }
    }
}
