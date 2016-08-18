<?php

namespace Raidros\Marketplace\Transformers;

use Raidros\Storer\Transformer;

class CnovaOrderRequestPostTransformer extends Transformer
{
    protected function transform(array $data)
    {
        return [
            'site'  => 'ex',
            'items' => [
            [
              'skuSellerId' => 'string',
              'name'        => 'string',
              'salePrice'   => 0,
              'quantity'    => 0
            ]
          ],
          'customer' => [
            'name' => 'string',
            'gender' => 'string',
            'documentNumber' => 'string',
            'type' => 'PF',
            'email' => 'string',
            'bornAt' => '2016-08-18',
            'billing' => [
              'address' => 'string',
              'number' => 'string',
              'complement' => 'string',
              'quarter' => 'string',
              'reference' => 'string',
              'city' => 'string',
              'state' => 'string',
              'countryId' => 'string',
              'zipCode' => 'string'
            ],
            'phones' => [
              'mobile' => 'string',
              'home' => 'string',
              'office' => 'string'
            ]
          ]
        ];
    }
}
