<?php

namespace Tylercd100\Notify\Tests;

use Monolog\Logger;
use Tylercd100\Notify\Drivers\FromConfig as Notify;
use Tylercd100\Notify\Drivers\HipChat;
use Tylercd100\Notify\Drivers\Mail;
use Tylercd100\Notify\Drivers\Pushover;
use Tylercd100\Notify\Drivers\Slack;
use Tylercd100\Notify\Facades\HipChat as HipChatFacade;
use Tylercd100\Notify\Facades\Mail as MailFacade;
use Tylercd100\Notify\Facades\Notify as NotifyFacade;
use Tylercd100\Notify\Facades\Pushover as PushoverFacade;
use Tylercd100\Notify\Facades\Slack as SlackFacade;

class NotifyTest extends TestCase
{
    public function testPushoverFacade(){
        $obj = PushoverFacade::getFacadeRoot();
        $this->assertInstanceOf(Pushover::class,$obj);
    }

    public function testHipChatFacade(){
        $obj = HipChatFacade::getFacadeRoot();
        $this->assertInstanceOf(HipChat::class,$obj);
    }

    public function testSlackFacade(){
        $obj = SlackFacade::getFacadeRoot();
        $this->assertInstanceOf(Slack::class,$obj);
    }

    public function testNotifyFacade(){
        $obj = NotifyFacade::getFacadeRoot();
        $this->assertInstanceOf(Notify::class,$obj);
    }

    public function testMailFacade(){
        $obj = MailFacade::getFacadeRoot();
        $this->assertInstanceOf(Mail::class,$obj);
    }

    public function testMailFacadeWithNoSmtp(){
        config()->set('notify.mail.smtp',false);
        $obj = MailFacade::getFacadeRoot();
        $this->assertInstanceOf(Mail::class,$obj);
    }

    public function testAllLogLevelMethods(){
        $levels = ["debug","info","notice","warning","error","critical","alert","emergency"];
        foreach ($levels as $level) {
            $result = $this->doLogLevel($level);
        }
    }

    protected function doLogLevel($level){
        $mock = $this->getMock(Logger::class, [$level], ["Testing"]);
        
        $mock->expects($this->once())
             ->method($level);

        $obj = new Notify([],$mock);

        $obj->{$level}("test message");
    }
}