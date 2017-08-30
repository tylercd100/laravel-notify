<?php

namespace Tylercd100\Notify\Factories;

use Mail;
use Monolog\Logger;
use Swift_Message;
use Monolog\Formatter\LineFormatter;

class MonologHandlerFactory
{
    /**
     * Returns an instance of \Monolog\Handler\HandlerInterface
     * @param  string $name   Then name of the handler you want to create
     * @param  array  $config An array of config values to use
     * @param string $title
     * @return \Monolog\Handler\HandlerInterface
     */
    public static function create($name, array $config = [], $title = null){
        $handler = call_user_func([MonologHandlerFactory::class,$name], $config, $title);
        
        // Keep newline characters
        $format = ['fleephook', 'hipchat', 'mail', 'mailgun', 'pushover', 'raven', 'slack'];
        
        if(in_array($name, $format)) {
            $handler->setFormatter(new LineFormatter(null, null, true));
        }

        if ($handler instanceof \Monolog\Handler\NativeMailerHandler) {
            $handler->setContentType('text/html');
        }

        return $handler;
    }

    /**
     * Returns a PushoverHandler
     * @param  array  $config An array of config values to use
     * @param  string $title The title/subject to use
     * @return \Monolog\Handler\PushoverHandler
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
     * Returns a PushoverHandler
     * @param  array  $config An array of config values to use
     * @param  string $title The title/subject to use
     * @return \Tylercd100\Monolog\Handler\MailgunHandler
     */
    protected static function mailgun(array $config = [], $title = null){
        $defaults = [
            "title" => null,
            "level" => Logger::CRITICAL,
            "bubble" => true,
            "host" => 'api.mailgun.net',
            "version" => 'v3'
        ];

        $c = array_merge($defaults,$config);

        $c['title'] = $title;

        return new \Tylercd100\Monolog\Handler\MailgunHandler(
            $c["to"],
            $c["title"],
            $c["from"],
            $c["token"],
            $c["domain"],
            $c["level"],
            $c["bubble"],
            $c["host"],
            $c["version"]);
    }

    /**
     * Returns a FlowdockHandler
     * @param  array  $config An array of config values to use
     * @param  string $title The title/subject to use
     * @return \Monolog\Handler\FlowdockHandler
     */
    protected static function flowdock(array $config = [], $title = null){
        $defaults = [
            "level" => Logger::DEBUG,
            "bubble" => true,
        ];

        $c = array_merge($defaults,$config);

        return new \Monolog\Handler\FlowdockHandler(
            $c['token'],
            $c['level'],
            $c['bubble']);
    }

    /**
     * Returns a FleepHookHandler
     * @param  array  $config An array of config values to use
     * @param  string $title The title/subject to use
     * @return \Monolog\Handler\FleepHookHandler
     */
    protected static function fleephook(array $config = [], $title = null){
        $defaults = [
            "level" => Logger::DEBUG,
            "bubble" => true,
        ];

        $c = array_merge($defaults,$config);

        return new \Monolog\Handler\FleepHookHandler(
            $c['token'],
            $c['level'],
            $c['bubble']);
    }

    /**
     * Returns a PlivoHandler
     * @param  array  $config An array of config values to use
     * @param  string $title The title/subject to use
     * @return \Tylercd100\Monolog\Handler\PlivoHandler
     */
    protected static function plivo(array $config = [], $title = null){
        $defaults = [
            'level' => Logger::DEBUG,
            'bubble' => true,
            'useSSL' => true,
            'host' => 'api.plivo.com',
            'version' => 'v1',
            'limit' => 160,
        ];

        $c = array_merge($defaults,$config);

        return new \Tylercd100\Monolog\Handler\PlivoHandler(
            $c['token'],
            $c['auth_id'],
            $c['from'],
            $c['to'],
            $c['level'],
            $c['bubble'],
            $c['useSSL'],
            $c['host'],
            $c['version'],
            $c['limit']);
    }

    /**
     * Returns a TwilioHandler
     * @param  array  $config An array of config values to use
     * @param  string $title The title/subject to use
     * @return \Tylercd100\Monolog\Handler\TwilioHandler
     */
    protected static function twilio(array $config = [], $title = null){
        $defaults = [
            'level' => Logger::DEBUG,
            'bubble' => true,
            'useSSL' => true,
            'host' => 'api.twilio.com',
            'version' => '2010-04-01',
            'limit' => 160,
        ];

        $c = array_merge($defaults,$config);

        return new \Tylercd100\Monolog\Handler\TwilioHandler(
            $c['secret'],
            $c['sid'],
            $c['from'],
            $c['to'],
            $c['level'],
            $c['bubble'],
            $c['useSSL'],
            $c['host'],
            $c['version'],
            $c['limit']);
    }

    /**
     * Returns a RavenHandler
     * @param  array  $config An array of config values to use
     * @param  string $title The title/subject to use
     * @return \Monolog\Handler\RavenHandler
     */
    protected static function raven(array $config = [], $title = null){
        $defaults = [
            'dsn'    => null,
            'level'  => Logger::ERROR,
            'bubble' => true,
        ];

        $c = array_merge($defaults, $config);

        return new \Monolog\Handler\RavenHandler(
            new \Raven_Client($c['dsn'], array_except($c, ['dsn'])),
            $c['level'],
            $c['bubble']
        );
    }

    /**
     * Returns a SlackHandler
     * @param  array  $config An array of config values to use
     * @param  string $title The title/subject to use
     * @return \Monolog\Handler\SlackHandler
     */
    protected static function slack(array $config = [], $title = null){
        $defaults = [
            'username' => 'Monolog',
            'useAttachment' => true,
            'iconEmoji' => null,
            'level' => Logger::DEBUG,
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
     * @return \Monolog\Handler\HipChatHandler
     */
    protected static function hipchat(array $config = [], $title = null){
        $defaults = [
            'name'    => 'Monolog',
            'notify'  => false,
            'level'   => Logger::DEBUG,
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

    /**
     * Creates Mail Monolog Handler
     * @param  array  $config An array of config values to use
     * @param  string $title The title/subject to use
     * @return \Monolog\Handler\MailHandler
     */
    protected static function mail(array $config = [], $title = null)
    {
        if (isset($config['smtp']) && $config['smtp']) {
            return self::swiftMail($config,$title);
        } else {
            return self::nativeMail($config,$title);
        }
    }

    /**
     * Creates Mail Monolog Handler
     * @param  array  $config An array of config values to use
     * @param  string $title The title/subject to use
     * @return \Monolog\Handler\SwiftMailerHandler
     */
    protected static function swiftMail(array $config, $title = null)
    {
        $defaults = [
            'level' => Logger::DEBUG,
            'bubble' => true
        ];

        $c = array_merge($defaults,$config);

        $c['title'] = $title;

        $swift = new Swift_Message($c['title']);
        $swift->setFrom($c['from'])
            ->setTo($c['to'])
            ->setContentType('text/html');

        return new \Monolog\Handler\SwiftMailerHandler(
            Mail::getSwiftMailer(),
            $swift,
            $c['level'],
            $c['bubble']
        );
    }

    /**
     * Creates Mail Monolog Handler
     * @param  array  $config An array of config values to use
     * @param  string $title The title/subject to use
     * @return \Monolog\Handler\NativeMailerHandler
     */
    protected static function nativeMail(array $config, $title = null)
    {
        $defaults = [
            'level' => Logger::DEBUG,
            'bubble' => true,
            'maxColumnWidth' => 70
        ];

        $c = array_merge($defaults,$config);

        $c['title'] = $title;

        return new \Monolog\Handler\NativeMailerHandler(
            $c['to'],
            $c['title'],
            $c['from'],
            $c['level'],
            $c['bubble'],
            $c['maxColumnWidth']
        );
    }
}