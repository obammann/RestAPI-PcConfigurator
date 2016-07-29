<?php

namespace HsBremen\WebApi\tests;

use HsBremen\WebApi\Entity\HDD;

class HDDTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */

    /*function test*/
    public function testjsonSerialize(){
        $hdd = new HDD(0,'test',3232,'test1', 23);
        $this->assertNotEmpty($hdd->jsonSerialize());
    }

    /*getter tests*/
    public function testGetId(){
        $hdd = new HDD(10,'test',3232,'test1', 23);
        $this->assertEquals(10, $hdd->getId());
    }

    public function testGetName(){
        $hdd = new HDD(10,'test',3232,'test1', 23);
        $this->assertEquals('test', $hdd->getName());
    }

    public function testGetPrice(){
        $hdd = new HDD(10,'test',3232,'test1', 23);
        $this->assertEquals(3232, $hdd->getPrice());
    }

    public function testGetType(){
        $hdd = new HDD(0,'test',3232,'test1', 23);
        $this->assertEquals('test1', $hdd->getType());
    }

    public function testGetMemory(){
        $hdd = new HDD(0,'test',3232,'test1', 23);
        $this->assertEquals(23, $hdd->getMemory());
    }

    /*setter tests*/
    public function testSetId(){
        $hdd = new HDD(0,'test',3232,'test1', 23);
        $hdd->setId(11);
        $this->assertEquals(11, $hdd->getId());
    }

    public function testSetName(){
        $hdd = new HDD(0,'test',3232,'test1', 23);
        $hdd->setName("test23");
        $this->assertEquals("test23", $hdd->getName());
    }

    public function testSetPrice(){
        $hdd = new HDD(0,'test',3232,'test1', 23);
        $hdd->setPrice(2000);
        $this->assertEquals(2000, $hdd->getPrice(2000));
    }

    public function testSetType(){
        $hdd = new HDD(0,'test',3232,'test1', 23);
        $hdd->setType('test23');
        $this->assertEquals('test23', $hdd->getType());
    }

    public function testSetMemory(){
        $hdd = new HDD(0,'test',3232,'test1', 23);
        $hdd->setMemory(320);
        $this->assertEquals(320, $hdd->getMemory());
    }

}
