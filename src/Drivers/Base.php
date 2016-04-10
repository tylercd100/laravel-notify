<?php

namespace Tylercd100\Notify\Drivers;

use Monolog\Logger;
use Monolog\Handler\HandlerInterface;
use Tylercd100\Notify\Factories\MonologHandlerFactory as Factory;

abstract class Base
{
    /**
     * @var array
     */
    protected $levels = ["debug","info","notice","warning","error","critical","alert","emergency"];

    /**
     * @var array
     */
    protected $config;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @param array  $config An array of config values to overwrite
     * @param Logger $logger A Monolog instance to use
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
    abstract protected function getDrivers();

    /**
     * Gets a hanlder instance for the provided name
     * @param  string $name The name of the driver you want to use
     * @return HandlerInterface
     */
    protected function getHandlerInstanceByName($name){
        $config = (isset($this->config[$name]) ? $this->config[$name] : []);
        return Factory::create($name,$config);
    }

    /**
     * Pushes a Monolog Handler in to the Monolog Logger instance
     * @param  HandlerInterface $handler The Handler to attach
     * @return void
     */
    protected function attachHandler(HandlerInterface $handler){
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