<?php

namespace Raidros\Marketplace\Transformers;

use Raidros\Storer\Transformer;

class CnovaOrderListTransformer extends Transformer
{
    /**
     * Transform all orders of a response in Cnova api.
     *
     * @param array $data
     *
     * @return array
     */
    protected function transform(array $data)
    {
        return array_map(function ($order) {
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
        }, $data);
    }
}
