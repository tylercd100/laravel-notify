<?php

namespace Tylercd100\Notify\Drivers;

use Tylercd100\Notify;

class Plivo extends Base
{
    /**
     * Returns a list of driver names to load
     * @return array An array of drivers to use
     */
    protected function getDrivers(){
        return ['plivo'];
    }
}