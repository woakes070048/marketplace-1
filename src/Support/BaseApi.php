<?php

namespace Raidros\Marketplace\Support;

use Raidros\Marketplace\Support\Orders;
use Raidros\Storer\Api;

class BaseApi extends Api
{
    public function orders()
    {
        return new Orders($this);
    }
}
