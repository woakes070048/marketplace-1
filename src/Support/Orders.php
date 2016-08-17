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
    public function approved()
    {
        $this->filter = '.approved';

        return $this;
    }

    /**
     * Set filter to canceled orders.
     *
     * @return self
     */
    public function canceled()
    {
        $this->filter = '.canceled';

        return $this;
    }

    /**
     * Set filter to sent orders.
     *
     * @return self
     */
    public function sent()
    {
        $this->filter = '.sent';

        return $this;
    }

    /**
     * Set filter to delivered orders.
     *
     * @return self
     */
    public function delivered()
    {
        $this->filter = '.delivered';

        return $this;
    }

    /**
     * Set the limit of request.
     *
     * @return selft
     */
    public function limit($limit)
    {
        $this->limitVal = $limit;

        return $this;
    }

    /**
     * Set the offset of request.
     *
     * @return selft
     */
    public function offset($offset)
    {
        $this->offsetVal = $offset;

        return $this;
    }

    /**
     * Set the page and offset of request.
     *
     * @return selft
     */
    public function page($page)
    {
        $this->pageVal = $page;
        $this->offsetVal = ($page - 1) * $this->limitVal;

        return $this;
    }

    /**
     * Get the orders.
     *
     * @return array
     */
    public function get($page = 1)
    {
        $this->page($page);
        $data = [
            'limit'  => $this->limitVal,
            'offset' => $this->offsetVal
        ];

        return $this->api->execute('get.orders'.$this->filter, $data)->getBody();
    }
}
