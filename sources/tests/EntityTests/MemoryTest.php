<?php

namespace HsBremen\WebApi\tests;

use HsBremen\WebApi\Entity\Memory;

class MemoryTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */


    public function testjsonSerialize(){
        $memory = new Memory(10,"test", 70, "test1", 1, 2);
        $this->assertNotEmpty($memory->jsonSerialize());
    }

    public function testGetId(){
        $memory = new Memory(10,"test", 70, "test1", 1, 2);
        $this->assertEquals(10, $memory->getId());
    }

    public function testGetName(){
        $memory = new Memory(10,"test", 70, "test1", 1, 2);
        $this->assertEquals('test', $memory->getName());
    }

    public function testGetPrice(){
        $memory = new Memory(10,"test", 70, "test1", 1, 2);
        $this->assertEquals(70, $memory->getPrice());
    }

    public function testGetType(){
        $memory = new Memory(10,"test", 70, "test1", 1, 2);
        $this->assertEquals('test1', $memory->getType());
    }

    public function testGetModule(){
        $memory = new Memory(10,"test", 70, "test1", 1, 2);
        $this->assertEquals(1, $memory->getModule());
    }

    public function testGetMemory(){
        $memory = new Memory(10,"test", 70, "test1", 1, 2);
        $this->assertEquals(2, $memory->getMemory());
    }

    public function testSetId(){
        $memory = new Memory(10,"test", 70, "test1", 1, 2);
        $memory->setId(11);
        $this->assertEquals(11, $memory->getId());
    }

    public function testSetName(){
        $memory = new Memory(10,"test", 70, "test1", 1, 2);
        $memory->setName("test23");
        $this->assertEquals("test23", $memory->getName());
    }

    public function testSetPrice(){
        $memory = new Memory(10,"test", 70, "test1", 1, 2);
        $memory->setPrice(2000);
        $this->assertEquals(2000, $memory->getPrice(2000));
    }

    public function testSetType(){
        $memory = new Memory(10,"test", 70, "test1", 1, 2);
        $memory->setType(2);
        $this->assertEquals(2, $memory->getType());
    }

    public function testSetModule(){
        $memory = new Memory(10,"test", 70, "test1", 1, 2);
        $memory->setModule(3);
        $this->assertEquals(3, $memory->getModule());
    }

}
