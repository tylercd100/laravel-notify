<?php

namespace Tylercd100\Notify\Providers;

use Illuminate\Support\ServiceProvider;
use Tylercd100\Notify\Drivers\FromConfig;
use Tylercd100\Notify\Drivers\HipChat;
use Tylercd100\Notify\Drivers\Mail;
use Tylercd100\Notify\Drivers\Pushover;
use Tylercd100\Notify\Drivers\Slack;
use Tylercd100\Notify\Drivers\Plivo;
use Tylercd100\Notify\Drivers\Twilio;

class NotifyServiceProvider extends ServiceProvider
{
    public function register() {
        $this->mergeConfigFrom(__DIR__ . '/../../config/notify.php', 'notify');

        $this->app->singleton('notify', function() {
            return new FromConfig;
        });

        $this->app->singleton('notify-pushover', function() {
            return new Pushover;
        });

        $this->app->singleton('notify-slack', function() {
            return new Slack;
        });

        $this->app->singleton('notify-hipchat', function() {
            return new HipChat;
        });

        $this->app->singleton('notify-mail', function() {
            return new Mail;
        });

        $this->app->singleton('notify-twilio', function() {
            return new Twilio;
        });

        $this->app->singleton('notify-plivo', function() {
            return new Plivo;
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/notify.php' => base_path('config/notify.php'),
        ]);   
    }
}