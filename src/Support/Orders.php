<?php

namespace Raidros\Marketplace\Support;

use Raidros\Storer\Api;

class Orders
{
    protected $api;
    protected $filter;
    protected $offsetVal;
    protected $limitVal;
    protected $pageVal;

    public function __construct(Api $api)
    {
        $this->api = $api;

        $this->offsetVal = 0;
        $this->limitVal = 100;
        $this->pageVal = 1;
    }

    /**
     * Set filter to approved orders.
     *
     * @return self
     */
    public function approved($page = 1)
    {
        $this->filter = '.approved';

        return $this->get($page);
    }

    /**
     * Set filter to canceled orders.
     *
     * @return self
     */
    public function canceled($page = 1)
    {
        $this->filter = '.canceled';

        return $this->get($page);
    }

    /**
     * Set filter to sent orders.
     *
     * @return self
     */
    public function sent($page = 1)
    {
        $this->filter = '.sent';

        return $this->get($page);
    }

    /**
     * Set filter to delivered orders.
     *
     * @return self
     */
    public function delivered($page = 1)
    {
        $this->filter = '.delivered';

        return $this->get($page);
    }

    /**
     * Get the orders.
     *
     * @return array
     */
    public function get($page = 1)
    {
        $this->offsetVal = ($page - 1) * $this->limitVal;
        $data = [
            'limit'  => $this->limitVal,
            'offset' => $this->offsetVal,
        ];

        return $this->api->execute('get.orders'.$this->filter, $data)->getBody();
    }
}
