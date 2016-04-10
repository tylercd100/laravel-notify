<?php

namespace Tylercd100\Notify;

class Factory
{
    /**
     * Returns an instance of \Monolog\Handler\HandlerInterface
     * @param  string $name   Then name of the handler you want to create
     * @param  array  $config An array of config values to use
     * @return \Monolog\Handler\HandlerInterface
     */
    public static function create($name,array $config = []){
        return forward_static_call_array($name,[$config]);
    }

    /**
     * Returns a PushoverHandler
     * @param  array $config An array of config values to use
     * @return \Monolog\Handler\HandlerInterface
     */
    protected static function pushover($config){
        return new \Monolog\Handler\PushoverHandler();
    }

    /**
     * Returns a SlackHandler
     * @param  array $config An array of config values to use
     * @return \Monolog\Handler\HandlerInterface
     */
    protected static function slack($config){
        return new \Monolog\Handler\SlackHandler();
    }

    /**
     * Returns a HipChatHandler
     * @param  array $config An array of config values to use
     * @return \Monolog\Handler\HandlerInterface
     */
    protected static function hipchat($config){
        return new \Monolog\Handler\HipChatHandler();
    }
}