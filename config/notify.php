<?php

return [

    'channel'=>'Tylercd100\Notify',

    /**
     * Drivers to use for your notifications
     */
    'drivers' => ['mail'],

    /**
     * Mail settings
     */
    'mail'=>[
        'to'  =>'to@address.com',
        'from'=>'from@address.com',
        'smtp'=>true,
    ],

    /**
     * Mailgun settings
     */
    'mailgun'=>[
        'to'    => env('MAILGUN_TO'),
        'from'  => env('MAILGUN_FROM'),
        'token' => env('MAILGUN_APP_TOKEN'),
        'domain'=> env('MAILGUN_DOMAIN'),
    ],

    /**
     * Pushover settings
     */
    'pushover'=>[
        'token' => env('PUSHOVER_APP_TOKEN'),
        'users' => [env('PUSHOVER_USER_KEY')],
    ],

    /**
     * Slack settings
     */
    'slack'=>[
        'token'   => env('SLACK_APP_TOKEN'), //https://api.slack.com/web#auth
        'channel' => env('SLACK_CHANNEL', '#exceptions'), //Dont forget the '#'
        'username'=> env('SLACK_USERNAME', 'LERN'), //The 'from' name
    ],

    /**
     * HipChat settings
     */
    'hipchat'=>[
        'token' => env('HIPCHAT_APP_TOKEN'),
        'room'  => 'room',
        'name'  => 'name',
        'notify'=> true,
    ],

    /**
     * Flowdock settings
     */
    'flowdock'=>[
        'token' => env('FLOWDOCK_APP_TOKEN'),
    ],

    /**
     * Fleephook settings
     */
    'fleephook'=>[
        'token' => env('FLEEPHOOK_APP_TOKEN'),
    ],

    /**
     * Plivo settings
     */
    'plivo'=>[
        'auth_id' => env('PLIVO_AUTH_ID'),
        'token'   => env('PLIVO_AUTH_TOKEN'),
        'to'      => env('PLIVO_TO'),
        'from'    => env('PLIVO_FROM'),
        'limit'   => 160,
    ],

    /**
     * Twilio settings
     */
    'twilio'=>[
        'sid'    => env('TWILIO_AUTH_SID'),
        'secret' => env('TWILIO_AUTH_SECRET'),
        'to'     => env('TWILIO_TO'),
        'from'   => env('TWILIO_FROM'),
        'limit'  => 160,
    ],
    
    /**
     * Raven settings
     */
    'raven'=>[
        'dsn'    => env('RAVEN_DSN'),
        'level' => 'info',
    ]
];
