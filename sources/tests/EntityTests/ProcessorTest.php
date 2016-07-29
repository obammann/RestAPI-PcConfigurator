<?php

namespace HsBremen\WebApi\tests;

use HsBremen\WebApi\Entity\Processor;

class ProcessorTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */

    /*function test*/
    public function testjsonSerialize(){
        $processor = new Processor(10, 'test', 123, '3434', 123, 18);
        $this->assertNotEmpty($processor->jsonSerialize());
    }

    /*Getter tests*/
    public function testGetId(){
        $processor = new Processor(10, 'test', 123, '3434', 123, 18);
        $this->assertEquals(10, $processor->getId());
    }

    public function testGetName(){
        $processor = new Processor(10, 'test', 123, '3434', 123, 18);
        $this->assertEquals('test', $processor->getName());
    }

    public function testGetPrice(){
        $processor = new Processor(10, 'test', 123, '3434', 123, 18);
        $this->assertEquals(123, $processor->getPrice());
    }

    public function testGetProcessorSocket(){
        $processor = new Processor(10, 'test', 123, '3434', 123, 18);
        $this->assertEquals('3434', $processor->getProcessorSocket());
    }
    
    public function testGetFrequency(){
        $processor = new Processor(10, 'test', 123, '3434', 123, 18);
        $this->assertEquals(123, $processor->getFrequency());
    }

       
    public function testGetCores(){
        $processor = new Processor(10, 'test', 123, '3434', 123, 18);
        $this->assertEquals(18, $processor->getCores());
    }

    /*setter tests*/
    public function testSetId(){
        $processor = new Processor(10, 'test', 123, '3434', 123, 18);
        $processor->setId(11);
        $this->assertEquals(11, $processor->getId());
    }

    public function testSetName(){
        $processor = new Processor(10, 'test', 123, '3434', 123, 18);
        $processor->setName("test23");
        $this->assertEquals("test23", $processor->getName());
    }

    public function testSetPrice(){
        $processor = new Processor(10, 'test', 123, '3434', 123, 18);
        $processor->setPrice(2000);
        $this->assertEquals(2000, $processor->getPrice(2000));
    }

    public function testSetProcessorSocket(){
        $processor = new Processor(10, 'test', 123, '3434', 123, 18);
        $processor->setProcessorSocket('test1');
        $this->assertEquals('test1', $processor->getProcessorSocket());
    }
    
    public function testSetFrequency(){
        $processor = new Processor(10, 'test', 123, '3434', 123, 18);
        $processor->setFrequency(9000);
        $this->assertEquals(9000, $processor->getFrequency());
    }

    public function testSetCores(){
        $processor = new Processor(10, 'test', 123, '3434', 123, 18);
        $processor->setCores(34);
        $this->assertEquals(34, $processor->getCores());
    }

}
