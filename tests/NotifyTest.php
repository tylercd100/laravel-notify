<?php

namespace Tylercd100\Notify\Tests;

use Monolog\Logger;
use Tylercd100\Notify\Drivers\FromConfig as Notify;

class NotifyTest extends TestCase
{

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