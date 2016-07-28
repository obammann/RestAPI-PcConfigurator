<?php

namespace HsBremen\WebApi\tests;

use HsBremen\WebApi\Entity\CdDrive;

class CdDriveTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */




    public function testjsonSerialize(){
        $cdDrive = new CdDrive(10,"LG BH16NS55",69.90, 12, 16, true , true );
        $this->assertNotEmpty($cdDrive->jsonSerialize());
    }
    
    public function testGetId(){
        $cdDrive = new CdDrive(10,"LG BH16NS55",69.90, 12, 16, true , true );
        $this->assertEquals(10, $cdDrive->getId());
    }

    public function testGetName(){
        $cdDrive = new CdDrive(10,"LG BH16NS55",69.90, 12, 16, true , true );
        $this->assertEquals('LG BH16NS55', $cdDrive->getName());
    }
    
    public function testGetPrice(){
        $cdDrive = new CdDrive(10,"LG BH16NS55",69.90, 12, 16, true , true );
        $this->assertEquals(69.90, $cdDrive->getPrice());
    }

    public function testGetIsBluray(){
        $cdDrive = new CdDrive(10,"LG BH16NS55",69.90, 12, 16, true , true );
        $this->assertTrue($cdDrive->getIsBluRay());
    }

    public function testGetIsWritable(){
        $cdDrive = new CdDrive(10,"LG BH16NS55",69.90, 12, 16, true , true );
        $this->assertTrue($cdDrive->getIsWritable());
    }

    public function testGetReadingTime(){
        $cdDrive = new CdDrive(10,"LG BH16NS55",69.90, 12, 16, true , true );
        $this->assertEquals(12, $cdDrive->getReadingTime());
    }

    public function testGetWritingTime(){
        $cdDrive = new CdDrive(10,"LG BH16NS55",69.90, 12, 16, true , true );
        $this->assertEquals(16, $cdDrive->getWritingTime());
    }

    public function testSetId(){
        $cdDrive = new CdDrive(10,"LG BH16NS55",69.90, 12, 16, true , true );
        $cdDrive->setId(11);
        $this->assertEquals(11, $cdDrive->getId());
    }

    public function testSetName(){
        $cdDrive = new CdDrive(10,"LG BH16NS55",69.90, 12, 16, true , true );
        $cdDrive->setName("test");
        $this->assertEquals("test", $cdDrive->getName());
    }

    public function testSetPrice(){
        $cdDrive = new CdDrive(10,"LG BH16NS55",69.90, 12, 16, true , true );
        $cdDrive->setPrice(2000);
        $this->assertEquals(2000, $cdDrive->getPrice(2000));
    }

    public function testSetIsBluray(){
        $cdDrive = new CdDrive(10,"LG BH16NS55",69.90, 12, 16, true , true );
        $cdDrive->setIsBluRay(false);
        $this->assertFalse($cdDrive->getIsBluRay());
    }

    public function testSetIsWritable(){
        $cdDrive = new CdDrive(10,"LG BH16NS55",69.90, 12, 16, true , true );
        $cdDrive->setIsWritable(false);
        $this->assertFalse($cdDrive->getIsWritable());
    }

    public function setReadingTime(){
        $cdDrive = new CdDrive(10,"LG BH16NS55",69.90, 12, 16, true , true );
        $cdDrive->setReadingTime(35);
        $this->assertEquals(35, $cdDrive->getReadingTime());
    }

    public function testSetWritingTime(){
        $cdDrive = new CdDrive(10,"LG BH16NS55",69.90, 12, 16, true , true );
        $cdDrive->setWritingTime(233);
        $this->assertEquals(233, $cdDrive->getWritingTime());
    }
    
}
