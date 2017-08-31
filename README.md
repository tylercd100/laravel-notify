# Laravel 5 Notify
[![Latest Version](https://img.shields.io/github/release/tylercd100/laravel-notify.svg?style=flat-square)](https://github.com/tylercd100/laravel-notify/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://travis-ci.org/tylercd100/laravel-notify.svg?branch=master)](https://travis-ci.org/tylercd100/laravel-notify)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/tylercd100/laravel-notify/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/tylercd100/laravel-notify/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/tylercd100/laravel-notify/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/tylercd100/laravel-notify/?branch=master)
[![Dependency Status](https://www.versioneye.com/user/projects/56f3252c35630e0029db0187/badge.svg?style=flat)](https://www.versioneye.com/user/projects/56f3252c35630e0029db0187)
[![Total Downloads](https://img.shields.io/packagist/dt/tylercd100/laravel-notify.svg?style=flat-square)](https://packagist.org/packages/tylercd100/laravel-notify)

Laravel Notify is a Laravel 5 package that will let you send notification messages to various services.

Currently supported notification channels via [Monolog](https://github.com/Seldaek/monolog)
- Email
- [Pushover](https://pushover.net/)
- [Slack](https://slack.com/)
- [Hipchat](https://www.hipchat.com/)
- [Fleephook](https://fleep.io/)
- [Flowdock](https://www.flowdock.com/)
- [Plivo](https://www.plivo.com/) an SMS messaging service.
- [Twilio](https://www.twilio.com/) an SMS messaging service.
- [Sentry](https://getsentry.com) via [Raven](https://github.com/getsentry/raven-php)
- [Mailgun](https://mailgun.com)

## Version Compatibility

 Laravel  | Laravel Notify
:---------|:----------------
 5.1.x    | 1.x
 5.2.x    | 1.x
 5.3.x    | 1.x
 5.4.x    | 1.x
 5.5.x    | 2.x

## Installation

Version 2.x uses [Package Discovery](https://laravel.com/docs/5.5/packages#package-discovery). If you are using 1.x you will need to follow these [instructions.](https://github.com/tylercd100/laravel-notify/tree/1.8.5)

Install via [composer](https://getcomposer.org/) - In the terminal:
```bash
composer require tylercd100/laravel-notify
```

Then you will need to run this in order to copy the config file.
```bash
php artisan vendor:publish --provider="Tylercd100\Notify\Providers\NotifyServiceProvider"
```

## Usage

After you have changed your configuration file (`config/notify.php`) you can simply use it like so:
```php
Notify::debug("This is a debug message!");
Notify::info("This is a info message!");
Notify::notice("This is a notice message!");
Notify::warning("This is a warning message!");
Notify::error("This is a error message!");
Notify::critical("This is a critical message!");
Notify::alert("This is a alert message!");
Notify::emergency("This is a emergency message!");

# Add context
Notify::info("This is a info message with context!",['user'=>$user, 'data'=>$data]);
```

## Other Features
Laravel Notify also exposes extra Facades. To use them you will need to add them to your `config/app.php` file in your aliases array.
```php
"HipChat"   => Tylercd100\Notify\Facades\HipChat::class,
"Pushover"  => Tylercd100\Notify\Facades\Pushover::class,
"Flowdock"  => Tylercd100\Notify\Facades\Flowdock::class,
"FleepHook" => Tylercd100\Notify\Facades\FleepHook::class,
"Slack"     => Tylercd100\Notify\Facades\Slack::class,
"Plivo"     => Tylercd100\Notify\Facades\Plivo::class,
"Twilio"    => Tylercd100\Notify\Facades\Twilio::class,
"Raven"     => Tylercd100\Notify\Facades\Raven::class,
"Mailgun"   => Tylercd100\Notify\Facades\Mailgun::class,
```
And then use them like this
```php
Slack::info("This is information!");
Pushover::critical("Everything is broken and the server room caught fire!");
```
