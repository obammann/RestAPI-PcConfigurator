<?php

namespace HsBremen\WebApi\tests;

use HsBremen\WebApi\Entity\PowerSupply;

class PowerSupplyTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */

    /*function test*/
    public function testjsonSerialize(){
        $powerSupply = new PowerSupply(10, "test" ,20, 30);
        $this->assertNotEmpty($powerSupply->jsonSerialize());
    }

    /*getter tests*/
    public function testGetId(){
        $powerSupply = new PowerSupply(10, "test" ,20, 30);
        $this->assertEquals(10, $powerSupply->getId());
    }

    public function testGetName(){
        $powerSupply = new PowerSupply(10, "test" ,20, 30);
        $this->assertEquals('test', $powerSupply->getName());
    }

    public function testGetPrice(){
        $powerSupply = new PowerSupply(10, "test" ,20, 30);
        $this->assertEquals(20, $powerSupply->getPrice());
    }

    public function testGetPower(){
        $powerSupply = new PowerSupply(10, "test" ,20, 30);
        $this->assertEquals(30, $powerSupply->getPower());
    }

    /*setter tests*/
    public function testSetId(){
        $powerSupply = new PowerSupply(10, "test" ,20, 30);
        $powerSupply->setId(11);
        $this->assertEquals(11, $powerSupply->getId());
    }

    public function testSetName(){
        $powerSupply = new PowerSupply(10, "test" ,20, 30);
        $powerSupply->setName("test23");
        $this->assertEquals("test23", $powerSupply->getName());
    }

    public function testSetPrice(){
        $powerSupply = new PowerSupply(10, "test" ,20, 30);
        $powerSupply->setPrice(2000);
        $this->assertEquals(2000, $powerSupply->getPrice(2000));
    }

    public function testSetPower(){
        $powerSupply = new PowerSupply(10, "test" ,20, 30);
        $powerSupply->setPower(2);
        $this->assertEquals(2, $powerSupply->getPower());
    }

}
