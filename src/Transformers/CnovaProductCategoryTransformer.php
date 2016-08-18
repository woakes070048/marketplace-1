<?php

namespace Raidros\Marketplace\Transformers;

use Raidros\Storer\Transformer;

class CnovaProductCategoryTransformer extends Transformer
{
    protected function transform(array $categories)
    {
        return array_map(function ($category) {
            return implode('>', $category);
        }, $categories);
    }
}
