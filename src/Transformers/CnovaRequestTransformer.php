<?php

namespace Raidros\Marketplace\Transformers;

use Raidros\Storer\Transformer;

class CnovaRequestTransformer extends Transformer
{
    protected function transform(array $data)
    {
        return [
            '_limit' => $data['limit'],
            '_offset' => $data['offset'],
        ];
    }
}
