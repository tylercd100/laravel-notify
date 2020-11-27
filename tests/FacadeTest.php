<?php

namespace Tylercd100\Notify\Tests;

use Tylercd100\Notify\Drivers\FromConfig as Notify;
use Tylercd100\Notify\Drivers\Mailgun;
use Tylercd100\Notify\Drivers\Mail;
use Tylercd100\Notify\Drivers\Plivo;
use Tylercd100\Notify\Drivers\Pushover;
use Tylercd100\Notify\Drivers\Flowdock;
use Tylercd100\Notify\Drivers\FleepHook;
use Tylercd100\Notify\Drivers\Slack;
use Tylercd100\Notify\Drivers\Twilio;
use Tylercd100\Notify\Facades\Mailgun as MailgunFacade;
use Tylercd100\Notify\Facades\Mail as MailFacade;
use Tylercd100\Notify\Facades\Notify as NotifyFacade;
use Tylercd100\Notify\Facades\Plivo as PlivoFacade;
use Tylercd100\Notify\Facades\Pushover as PushoverFacade;
use Tylercd100\Notify\Facades\Slack as SlackFacade;
use Tylercd100\Notify\Facades\Twilio as TwilioFacade;
use Tylercd100\Notify\Facades\Flowdock as FlowdockFacade;
use Tylercd100\Notify\Facades\FleepHook as FleepHookFacade;

class FacadeTest extends TestCase
{
    public function testPushoverFacade(){
        $obj = PushoverFacade::getFacadeRoot();
        $this->assertInstanceOf(Pushover::class,$obj);
    }

    public function testFlowdockFacade(){
        $obj = FlowdockFacade::getFacadeRoot();
        $this->assertInstanceOf(Flowdock::class,$obj);
    }

    public function testFleepHookFacade(){
        $obj = FleepHookFacade::getFacadeRoot();
        $this->assertInstanceOf(FleepHook::class,$obj);
    }

    public function testPlivoFacade(){
        $obj = PlivoFacade::getFacadeRoot();
        $this->assertInstanceOf(Plivo::class,$obj);
    }

    public function testTwilioFacade(){
        $obj = TwilioFacade::getFacadeRoot();
        $this->assertInstanceOf(Twilio::class,$obj);
    }

    public function testMailgunFacade(){
        $obj = MailgunFacade::getFacadeRoot();
        $this->assertInstanceOf(Mailgun::class,$obj);
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

}
