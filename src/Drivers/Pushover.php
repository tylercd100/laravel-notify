<?php

namespace Tylercd100\Notify\Drivers;

use Tylercd100\Notify;

class Pushover extends Base
{
    /**
     * Returns an array of names that correspond to a config key and the Tylercd100\Notify\Factory::create method
     * @return array An array of drivers to use
     */
    protected function getDrivers(){
        return ['pushover'];
    }
}