<?php

namespace Tylercd100\Notify\Factories;

use Monolog\Logger;

class MonologHandlerFactory
{
    /**
     * Returns an instance of \Monolog\Handler\HandlerInterface
     * @param  string $name   Then name of the handler you want to create
     * @param  array  $config An array of config values to use
     * @return \Monolog\Handler\HandlerInterface
     */
    public static function create($name, array $config = [], $title = null){
        return call_user_func([MonologHandlerFactory::class,$name], $config, $title);
    }

    /**
     * Returns a PushoverHandler
     * @param  array  $config An array of config values to use
     * @param  string $title The title/subject to use
     * @return \Monolog\Handler\HandlerInterface
     */
    protected static function pushover(array $config = [], $title = null){
        $defaults = [
            "title" => null,
            "level" => Logger::DEBUG,
            "bubble" => true,
            "useSSL" => true,
            "highPriorityLevel" => Logger::CRITICAL,
            "emergencyLevel" => Logger::EMERGENCY,
            "retry" => 30,
            "expire" => 25200
        ];

        $c = array_merge($defaults,$config);

        $c['title'] = $title;

        return new \Monolog\Handler\PushoverHandler(
            $c['token'], 
            $c['users'], 
            $c['title'], 
            $c['level'], 
            $c['bubble'], 
            $c['useSSL'], 
            $c['highPriorityLevel'], 
            $c['emergencyLevel'], 
            $c['retry'], 
            $c['expire']);
    }

    /**
     * Returns a SlackHandler
     * @param  array  $config An array of config values to use
     * @param  string $title The title/subject to use
     * @return \Monolog\Handler\HandlerInterface
     */
    protected static function slack(array $config = [], $title = null){
        $defaults = [
            'username' => 'Monolog', 
            'useAttachment' => true, 
            'iconEmoji' => null, 
            'level' => Logger::CRITICAL, 
            'bubble' => true, 
            'useShortAttachment' => false, 
            'includeContextAndExtra' => false
        ];

        $c = array_merge($defaults,$config);

        return new \Monolog\Handler\SlackHandler(
            $c['token'], 
            $c['channel'], 
            $c['username'],
            $c['useAttachment'],
            $c['iconEmoji'],
            $c['level'],
            $c['bubble'],
            $c['useShortAttachment'],
            $c['includeContextAndExtra']);
    }

    /**
     * Returns a HipChatHandler
     * @param  array  $config An array of config values to use
     * @param  string $title The title/subject to use
     * @return \Monolog\Handler\HandlerInterface
     */
    protected static function hipchat(array $config = [], $title = null){
        $defaults = [
            'name'    => 'Monolog',
            'notify'  => false,
            'level'   => Logger::CRITICAL,
            'bubble'  => true,
            'useSSL'  => true,
            'format'  => 'text',
            'host'    => 'api.hipchat.com',
            'version' => 'v1'
        ];

        $c = array_merge($defaults,$config);

        return new \Monolog\Handler\HipChatHandler(
            $c['token'],
            $c['room'],
            $c['name'],
            $c['notify'],
            $c['level'],
            $c['bubble'],
            $c['useSSL'],
            $c['format'],
            $c['host'],
            $c['version']);
    }
}