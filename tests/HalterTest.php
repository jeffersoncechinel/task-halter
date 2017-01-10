<?php
namespace JC\TaskHalter\Tests;

use JC\TaskHalter\Halter;

class HalterTest extends \PHPUnit_Framework_TestCase
{

    public function testHalter()
    {
        $halter = new Halter();
        $halter->setName('app1');
        $this->assertEquals('app1', $halter->getName());

        $halter->setRuntimePath('/tmp');
        $this->assertEquals('/tmp', $halter->getRuntimePath());

        $halter->setFileExtension('.halt2');
        $this->assertEquals('.halt2', $halter->getFileExtension());

        $this->assertEquals(1, $halter->halt());
        $this->assertEquals(1, $halter->isSetToHalt());
    }
}