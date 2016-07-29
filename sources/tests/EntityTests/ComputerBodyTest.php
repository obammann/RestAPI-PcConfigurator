<?php

namespace HsBremen\WebApi\tests;

use HsBremen\WebApi\Entity\ComputerBody;

class ComputerBodyTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */

    /*function test*/
    public function testjsonSerialize(){
        $computerBody = new ComputerBody(10,"test",69.90, 'test2');
        $this->assertNotEmpty($computerBody->jsonSerialize());
    }

    /*getter tests*/
    public function testGetId(){
        $computerBody = new ComputerBody(10,"test",69.90, 'test2');
        $this->assertEquals(10, $computerBody->getId());
    }

    public function testGetName(){
        $computerBody = new ComputerBody(10,"test",69.90, 'test2');
        $this->assertEquals('test', $computerBody->getName());
    }

    public function testGetPrice(){
        $computerBody = new ComputerBody(10,"test",69.90, 'test2');
        $this->assertEquals(69.90, $computerBody->getPrice());
    }

    public function testGetFormFactor(){
        $computerBody = new ComputerBody(10,"test",69.90, 'test2');
        $this->assertEquals('test2', $computerBody->getFormFactor());
    }

    /*setter tests*/
    public function testSetId(){
        $computerBody = new ComputerBody(10,"test",69.90, 'test2');
        $computerBody->setId(11);
        $this->assertEquals(11, $computerBody->getId());
    }

    public function testSetName(){
        $computerBody = new ComputerBody(10,"test",69.90, 'test2');
        $computerBody->setName("test23");
        $this->assertEquals("test23", $computerBody->getName());
    }

    public function testSetPrice(){
        $computerBody = new ComputerBody(10,"test",69.90, 'test2');
        $computerBody->setPrice(2000);
        $this->assertEquals(2000, $computerBody->getPrice(2000));
    }

    public function testSetFormFactor(){
        $computerBody = new ComputerBody(10,"test",69.90, 'test2');
        $computerBody->setFormFactor('test1234');
        $this->assertEquals('test1234', $computerBody->getFormFactor());
    }
    
}
