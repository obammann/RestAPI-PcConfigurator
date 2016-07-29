<?php

namespace HsBremen\WebApi\tests;

use HsBremen\WebApi\Entity\Mainboard;

class MainboardTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */

    /*function test*/
    public function testjsonSerialize(){
        $mainboard = new Mainboard(10,"test",200.00,"test1",1,2,3,4);
        $this->assertNotEmpty($mainboard->jsonSerialize());
    }

    /*getter tests*/
    public function testGetId(){
        $mainboard = new Mainboard(10,"test",200.00,"test1",1,2,3,4);
        $this->assertEquals(10, $mainboard->getId());
    }

    public function testGetName(){
        $mainboard = new Mainboard(10,"test",200.00,"test1",1,2,3,4);
        $this->assertEquals('test', $mainboard->getName());
    }

    public function testGetPrice(){
        $mainboard = new Mainboard(110,"test",200.00,"test1",1,2,3,4);
        $this->assertEquals(200, $mainboard->getPrice());
    }

    public function testGetProcessorSocket(){
        $mainboard = new Mainboard(10,"test",200.00,"test1",1,2,3,4);
        $this->assertEquals('test1', $mainboard->getProcessorSocket());
    }

    public function testGetNumberDDR3Slots(){
        $mainboard = new Mainboard(10,"test",200.00,"test1",1,2,3,4);
        $this->assertEquals(1, $mainboard->getNumberDDR3Slots());
    }

    public function testGetNumberDDR4Slots(){
        $mainboard = new Mainboard(10,"test",200.00,"test1",1,2,3,4);
        $this->assertEquals(2, $mainboard->getNumberDDR4Slots());
    }

    public function testGetNumberSataConnectors(){
        $mainboard = new Mainboard(10,"test",200.00,"test1",1,2,3,4);
        $this->assertEquals(3, $mainboard->getNumberSataConnectors());
    }

    public function testGetNumberPCIeSlots(){
        $mainboard = new Mainboard(10,"test",200.00,"test1",1,2,3,4);
        $this->assertEquals(4, $mainboard->getNumberPCIeSlots());
    }

    /*setter tests*/
    public function testSetId(){
        $mainboard = new Mainboard(10,"test",200.00,"test1",1,2,3,4);
        $mainboard->setId(11);
        $this->assertEquals(11, $mainboard->getId());
    }

    public function testSetName(){
        $mainboard = new Mainboard(10,"test",200.00,"test1",1,2,3,4);
        $mainboard->setName("test23");
        $this->assertEquals("test23", $mainboard->getName());
    }

    public function testSetPrice(){
        $mainboard = new Mainboard(10,"test",200.00,"test1",1,2,3,4);
        $mainboard->setPrice(2000);
        $this->assertEquals(2000, $mainboard->getPrice(2000));
    }

    public function testSetNumberDDR3Slots(){
        $mainboard = new Mainboard(10,"test",200.00,"test1",1,2,3,4);
        $mainboard->setNumberDDR3Slots(2);
        $this->assertEquals(2, $mainboard->getNumberDDR3Slots());
    }

    public function testSetNumberDDR4Slots(){
        $mainboard = new Mainboard(10,"test",200.00,"test1",1,2,3,4);
        $mainboard->setNumberDDR4Slots(3);
        $this->assertEquals(3, $mainboard->getNumberDDR4Slots());
    }

    public function testSetNumberSataConnectors(){
        $mainboard = new Mainboard(10,"test",200.00,"test1",1,2,3,4);
        $mainboard->setNumberSataConnectors(4);
        $this->assertEquals(4, $mainboard->getNumberSataConnectors());
    }

    public function testSetNumberPCIeSlots(){
        $mainboard = new Mainboard(10,"test",200.00,"test1",1,2,3,4);
        $mainboard->setNumberPCIeSlots(5);
        $this->assertEquals(5, $mainboard->getNumberPCIeSlots());
    }


}
