<?php

namespace Raidros\Marketplace\Support;

use Raidros\Storer\Api;

class BaseApi extends Api
{
    public function orders()
    {
        return new Orders($this);
    }
}
