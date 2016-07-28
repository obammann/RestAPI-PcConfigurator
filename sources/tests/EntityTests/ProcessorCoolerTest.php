<?php

namespace HsBremen\WebApi\tests;

use HsBremen\WebApi\Entity\processorCooler;

class processorCoolerTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */


    public function testjsonSerialize(){
        $processorCooler = new ProcessorCooler(10,"test", 100,"test1");
        $this->assertNotEmpty($processorCooler->jsonSerialize());
    }

    public function testGetId(){
        $processorCooler = new ProcessorCooler(10,"test", 100,"test1");
        $this->assertEquals(10, $processorCooler->getId());
    }

    public function testGetName(){
        $processorCooler = new ProcessorCooler(10,"test", 100,"test1");
        $this->assertEquals('test', $processorCooler->getName());
    }

    public function testGetPrice(){
        $processorCooler = new ProcessorCooler(10,"test", 100,"test1");
        $this->assertEquals(100, $processorCooler->getPrice());
    }

    public function testGetProcessorCoolerSocket(){
        $processorCooler = new ProcessorCooler(10,"test", 100,"test1");
        $this->assertEquals('test1', $processorCooler->getProcessorSocket());
    }


    public function testSetId(){
        $processorCooler = new ProcessorCooler(10,"test", 100,"test1");
        $processorCooler->setId(11);
        $this->assertEquals(11, $processorCooler->getId());
    }

    public function testSetName(){
        $processorCooler = new ProcessorCooler(10,"test", 100,"test1");
        $processorCooler->setName("test23");
        $this->assertEquals("test23", $processorCooler->getName());
    }

    public function testSetPrice(){
        $processorCooler = new ProcessorCooler(10,"test", 100,"test1");
        $processorCooler->setPrice(2000);
        $this->assertEquals(2000, $processorCooler->getPrice(2000));
    }

    public function testSetProcessorSocket(){
        $processorCooler = new ProcessorCooler(10,"test", 100,"test1");
        $processorCooler->setProcessorSocket('test24');
        $this->assertEquals('test24', $processorCooler->getProcessorSocket());
    }


}
