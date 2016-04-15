<?php

namespace Tylercd100\Notify\Drivers;

use Monolog\Logger;
use Monolog\Handler\HandlerInterface;
use Psr\Log\LoggerInterface;
use Tylercd100\Notify\Factories\MonologHandlerFactory as Factory;

abstract class Base implements LoggerInterface
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var string
     */
    private $title;

    /**
     * @param array  $config An array of config values to overwrite
     * @param Logger $logger A Monolog instance to use
     * @param string $title  The title to set for the handlers
     */
    public function __construct(array $config = [], Logger $logger = null, $title = ""){
        //Merge the existing config with the provided config
        $default = is_array(config('notify')) ? config('notify') : [];
        $this->config = array_merge($default,$config);

        if(!$logger instanceof Logger){
            $logger = new Logger($this->config['channel']);
        }
        $this->logger = $logger;
        $this->title = $title;

        $this->attachDrivers();
    }

    /**
     * Returns a list of driver names to load
     * @return array An array of drivers to use
     */
    abstract protected function getDrivers();

    /**
     * Gets a handler instance for the provided name
     * @param  string $name The name of the driver you want to use
     * @return HandlerInterface
     */
    protected function getHandlerInstanceByName($name){
        $config = (isset($this->config[$name]) ? $this->config[$name] : []);
        return Factory::create($name,$config,$this->title);
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
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function emergency($message, array $context = array())
    {
        $this->logger->emergency($message,$context);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function alert($message, array $context = array())
    {
        $this->logger->alert($message,$context);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function critical($message, array $context = array())
    {
        $this->logger->critical($message,$context);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function error($message, array $context = array())
    {
        $this->logger->error($message,$context);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function warning($message, array $context = array())
    {
        $this->logger->warning($message,$context);
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function notice($message, array $context = array())
    {
        $this->logger->notice($message,$context);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function info($message, array $context = array())
    {
        $this->logger->info($message,$context);
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function debug($message, array $context = array())
    {
        $this->logger->debug($message,$context);
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     */
    public function log($level, $message, array $context = array())
    {
        $this->logger->log($level, $message, $context);
    }

}