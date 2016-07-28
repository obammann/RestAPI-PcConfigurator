<?php

namespace HsBremen\WebApi\tests;

use HsBremen\WebApi\Database\GraphicCardDatabase;

class GraphicCardDatabaseTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */


    public function testGetgraphicCardDatabase(){
        $graphicCardDatabase = new GraphicCardDatabase();
        $this -> assertNotEmpty($graphicCardDatabase->getDatabase());
    }


    public function testSetDatabase(){
        $graphicCardDatabase = new GraphicCardDatabase();
        $database = [1,2,3];
        $graphicCardDatabase->setDatabase($database);
        $this-> assertContains(2, $graphicCardDatabase->getDatabase());
    }

    public function testGetComponent(){
        $graphicCardDatabase = new GraphicCardDatabase();
        $this -> assertNotEmpty($graphicCardDatabase->getComponent(2));
    }

    public function testAddComponent(){
        $graphicCardDatabase = new GraphicCardDatabase();
        $graphicCardDatabase->addComponent(10,"test", 123, 4, 2);
        $this-> assertNotEmpty($graphicCardDatabase->getComponent(10));
    }

    public function testUpdateComponent(){
        $graphicCardDatabase = new GraphicCardDatabase();
        $graphicCardDatabase->updateComponent(1,"test", 123, 4, 2);
        $graphicCard = $graphicCardDatabase->getComponent(1);
        $this-> assertEquals('test',$graphicCard->getName());
    }

    public function testDeleteComponent(){
        $graphicCardDatabase = new GraphicCardDatabase();
        $this -> assertEmpty($graphicCardDatabase->deleteComponent(1));
    }
}
