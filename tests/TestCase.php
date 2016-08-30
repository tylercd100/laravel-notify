<?php

namespace Tylercd100\Notify\Tests;

use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();        
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getPackageProviders($app)
    {
        return [
            'Tylercd100\Notify\Providers\NotifyServiceProvider',
        ];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getPackageAliases($app)
    {
        return [
            'Tylercd100\Notify\Facades\Notify',
            'Tylercd100\Notify\Facades\Pushover',
            'Tylercd100\Notify\Facades\Slack',
            'Tylercd100\Notify\Facades\HipChat',
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('notify',[

            'channel'=>'Tylercd100\Notify',

            /**
             * The drivers to use
             */
            'drivers' => ['pushover', 'slack', 'hipchat', 'mail'],

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
                'to'  =>'to@address.com',
                'from'=>'from@address.com',
                'token' => 'token',
                'domain'=> 'test.com',
            ],
            
            /**
             * Pushover settings
             */
            'pushover'=>[
                'token' => "Token",
                'users' => [
                    "User",
                ],
                'sound' => "Sound",
            ],

            /**
             * Slack settings
             */
            'slack'=>[
                'token'   => "Token",
                'channel' => "Value",
                'username'=> "Value",
            ],

            /**
             * HipChat settings
             */
            'hipchat'=>[
                'token' => "Token",
                'room'  => 'room',
                'name'  => 'name',
                'notify'=> true,
            ],

            /**
             * Flowdock settings
             */
            'flowdock'=>[
                'token' => "Token",
            ],

            /**
             * Fleephook settings
             */
            'fleephook'=>[
                'token' => "Token",
            ],

            /**
             * Plivo settings
             */
            'plivo'=>[
                'auth_id' => "Value",
                'token'   => "Token",
                'to'      => "Value",
                'from'    => "Value",
            ],

            /**
             * Twilio settings
             */
            'twilio'=>[
                'sid'    => "Value",
                'secret' => "Value",
                'to'     => "Value",
                'from'   => "Value",
            ],
    
            /**
             * Raven settings
             */
            'raven'=>[
                'dsn'    => null,
                'level' => 'error',
            ]
        ]);
    }

    /**
     * Call protected/private method of a class.
     *
     * @param object &$object    Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}