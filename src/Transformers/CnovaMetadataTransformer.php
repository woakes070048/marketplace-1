<?php

namespace Raidros\Marketplace\Transformers;

use Raidros\Storer\Transformer;

class CnovaMetadataTransformer extends Transformer
{
    protected function transform(array $metadata)
    {
        $result = [];

        foreach ($metadata as $data) {
            $result[$data['key']] = $data['value'];
        }

        return $result;
    }
}
