<?php

namespace HsBremen\WebApi\tests;

use HsBremen\WebApi\Entity\GraphicCard;

class GraphicCardTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */


    /*function test*/
    public function testjsonSerialize(){
        $graphicCard = new GraphicCard(10,"TestForce", 4929, 22, 28);
        $this->assertNotEmpty($graphicCard->jsonSerialize());
    }

    /*getter tests*/
    public function testGetId(){
        $graphicCard = new GraphicCard(10,"TestForce", 4929, 22, 28);
        $this->assertEquals(10, $graphicCard->getId());
    }

    public function testGetName(){
        $graphicCard = new GraphicCard(10,"TestForce", 4929, 22, 28);
        $this->assertEquals('TestForce', $graphicCard->getName());
    }

    public function testGetPrice(){
        $graphicCard = new GraphicCard(10,"TestForce", 4929, 22, 28);
        $this->assertEquals(4929, $graphicCard->getPrice());
    }
    
    public function testGetSlotsOccupied(){
        $graphicCard = new GraphicCard(10,"TestForce", 4929, 22, 28);
        $this->assertEquals(22, $graphicCard->getSlotsOccupied());
    }
    
    public function testGetMemory(){
        $graphicCard = new GraphicCard(10,"TestForce", 4929, 22, 28);
        $this->assertEquals(28, $graphicCard->getMemory());
    }

    /*setter tests*/
    public function testSetId(){
        $graphicCard = new GraphicCard(10,"TestForce", 4929, 22, 28);
        $graphicCard->setId(11);
        $this->assertEquals(11, $graphicCard->getId());
    }

    public function testSetName(){
        $graphicCard = new GraphicCard(10,"TestForce", 4929, 22, 28);
        $graphicCard->setName("test23");
        $this->assertEquals("test23", $graphicCard->getName());
    }

    public function testSetPrice(){
        $graphicCard = new GraphicCard(10,"TestForce", 4929, 22, 28);
        $graphicCard->setPrice(2000);
        $this->assertEquals(2000, $graphicCard->getPrice(2000));
    }

    public function testSetSlotsOccupied(){
        $graphicCard = new GraphicCard(10,"TestForce", 4929, 22, 28);
        $graphicCard->setSlotsOccupied(2000);
        $this->assertEquals(2000, $graphicCard->getSlotsOccupied());
    }

    public function testSetMemory(){
        $graphicCard = new GraphicCard(10,"TestForce", 4929, 22, 28);
        $graphicCard->setMemory(320);
        $this->assertEquals(320, $graphicCard->getMemory());
    }

}
