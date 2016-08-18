<?php

namespace Raidros\Marketplace\Transformers;

use Raidros\Storer\Transformer;

class CnovaOrderResponseTransformer extends Transformer
{
    /**
     * Transform orders from Cnova api.
     *
     * @param  array $data
     *
     * @return array
     */
    protected function transform(array $data)
    {
        $metaTransformer = new CnovaMetadataTransformer();
        $orderTransformer = new CnovaOrderListTransformer();

        return [
            'data' => $orderTransformer->transformData($data['orders']),
            'meta' => $metaTransformer->transformData($data['metadata']),
        ];
    }
}
