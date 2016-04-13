<?php

namespace Tylercd100\Notify\Providers;

use Illuminate\Support\ServiceProvider;
use Tylercd100\Notify\Drivers\FromConfig;
use Tylercd100\Notify\Drivers\HipChat;
use Tylercd100\Notify\Drivers\Mail;
use Tylercd100\Notify\Drivers\Pushover;
use Tylercd100\Notify\Drivers\Flowdock;
use Tylercd100\Notify\Drivers\FleepHook;
use Tylercd100\Notify\Drivers\Slack;
use Tylercd100\Notify\Drivers\Plivo;
use Tylercd100\Notify\Drivers\Twilio;
use Tylercd100\Notify\Drivers\Raven;

class NotifyServiceProvider extends ServiceProvider
{
    public function register() {
        $this->mergeConfigFrom(__DIR__ . '/../../config/notify.php', 'notify');

        $registerMap = [
            'notify' => FromConfig::class,
            'notify-pushover' => Pushover::class,
            'notify-slack' => Slack::class,
            'notify-hipchat' => HipChat::class,
            'notify-mail' => Mail::class,
            'notify-twilio' => Twilio::class,
            'notify-plivo' => Plivo::class,
            'notify-fleephook' => FleepHook::class,
            'notify-flowdock' => Flowdock::class,
            'notify-raven' => Raven::class,
        ];

        $this->registerSingletonsFromMap($registerMap);
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/notify.php' => base_path('config/notify.php'),
        ]);   
    }

    private function registerSingletonsFromMap($map){
        foreach ($map as $key => $class) {
            $this->app->singleton($key, function() use ($class){
                return new $class;
            });
        }
    }
}