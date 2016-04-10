<?php

namespace Tylercd100\Notify\Drivers;

use Monolog\Logger;
use Tylercd100\Notify\Factories\MonologHandlerFactory as Factory;

class Base
{
    protected $levels = ["debug","info","notice","warning","error","critical","alert","emergency"];

    /**
     * @var array
     */
    protected $config;

    /**
     * @var array
     */
    protected $logger;

    /**
     * @param array $config An array of config values to overwrite
     */
    public function __construct(array $config = [], Logger $logger = null){
        //Merge the existing config with the provided config
        $this->config = array_merge_recursive(config('notify'),$config);

        if(!$logger instanceof Logger){
            $logger = new Logger($this->config['channel']);
        }
        $this->logger = $logger;

        $this->attachDrivers();
    }

    /**
     * Returns a list of names that correspond to a config key and the Tylercd100\Notify\Factory::create method
     * @return array An array of drivers to use
     */
    protected function getDrivers(){
        return [];
    }

    protected function getHandlerInstanceByName($name){
        $config = (isset($this->config[$name]) ? $this->config[$name] : []);
        return Factory::create($name,$config);
    }

    protected function attachHandler($handler){
        $this->logger->pushHandler($handler);
    }

    /**
     * This will attach all the monolog handlers specified in the drivers config array
     * @return void
     */
    protected function attachDrivers()
    {
        $drivers = $this->getDrivers();
        foreach ($drivers as $driver) {
            $handler = $this->getHandlerInstanceByName($driver);
            $this->attachHandler($handler);
        }
    }

    /**
     * This will call the log functions of Monolog\Logger
     * @param  string $method    The method to call
     * @param  array  $arguments The arguments provided
     * @return void
     */
    public function __call($method, $arguments)
    {
        if(in_array($method, $this->levels)){
            call_user_func([$this->logger,$method],$arguments);
        }
    }
}