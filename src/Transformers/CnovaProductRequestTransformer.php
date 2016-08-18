<?php

namespace Raidros\Marketplace\Transformers;

use Raidros\Storer\Transformer;

class CnovaProductRequestTransformer extends Transformer
{
    protected function transform(array $data)
    {
        $categoryTransformer = new CnovaProductCategoryTransformer();

        return [
            'skuId' => $data['skuId'],
            'skuSellerId' => $data['skuSellerId'],
            'productSellerId' => $data['skuSellerId'],
            'title' => $data['title'],
            'description' => $data['description'],
            'brand' => $data['brand'],
            'gtin' => $data['gtin'],
            'categories' => $categoryTransformer->transformData($data['categories']),
            'images' => $data['images'],
            'videos' => $data['videos'],
            'price' => [
                'default' => $data['price'],
                'offer' => $data['offer'],
            ],
            'stock' => [
                'quantity' => $data['stock'],
                'crossDockingTime' => $data['crossDockingTime'],
            ],
            'dimensions' => [
                'weight' => $data['weight'],
                'length' => $data['length'],
                'width'  => $data['width'],
                'height' => $data['height'],
            ],
            'giftWrap' => [
                'available' => false,
                'value' => 0,
                'messageSupport' => false,
            ],
            'attributes' => $data['attributes'],
        ];
    }
}
