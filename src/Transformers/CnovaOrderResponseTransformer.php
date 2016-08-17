<?php

namespace Raidros\Marketplace\Transformers;

use Raidros\Storer\Transformer;

class CnovaOrderResponseTransformer extends Transformer
{
    protected function transform(array $data)
    {
        $orders = array_map(function($order){

            return [
                'shop' => $order['site'],
                'martketplace' => [
                    'id' => 1,
                    'code' => 'cnova',
                    'title' => 'Cnova',
                ],
                'mktOrderId' => $order['id'],
                'mktOrderCode' => $order['orderSiteId'],
                'updatedAt' => date('Y-m-d H:i:s', strtotime($order['updatedAt'])),
                'approvedAt' => date('Y-m-d H:i:s', strtotime($order['approvedAt'])),
                'purchasedAt' => date('Y-m-d H:i:s', strtotime($order['purchasedAt'])),
            ];

        }, $data['orders']);

        $metadata = $this->extractMetadata($data['metadata']);

        return [
            'data' => $orders,
            'meta' => [
                'total' => $metadata['totalRows'],
                'limit' => $metadata['limit'],
                'offset' => $metadata['offset'],
            ],
        ];
    }

    protected function extractMetadata($metadata)
    {
        $result = [];

        foreach($metadata as $data){
            $result[$data['key']] = $data['value'];
        }

        return $result;
    }
}
