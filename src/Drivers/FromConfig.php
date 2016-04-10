<?php

namespace Tylercd100\Notify\Drivers;

use Tylercd100\Notify;

class FromConfig extends Base
{
    /**
     * Returns a list of names that correspond to a config key and the Tylercd100\Notify\Factory::create method
     * @return array An array of drivers to use
     */
    protected function getDrivers(){
        return $this->config['drivers'];
    }
}