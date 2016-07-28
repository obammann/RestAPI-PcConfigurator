<?php

namespace HsBremen\WebApi\tests;

use HsBremen\WebApi\Database\MainboardDatabase;

class MainboardDatabaseTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */


    public function testGetHDDDDatabase(){
        $mainboardDatabase = new MainboardDatabase();
        $this -> assertNotEmpty($mainboardDatabase->getDatabase());
    }


    public function testSetDatabase(){
        $mainboardDatabase = new MainboardDatabase();
        $database = [1,2,3];
        $mainboardDatabase->setDatabase($database);
        $this-> assertContains(2, $mainboardDatabase->getDatabase());
    }

    public function testGetComponent(){
        $mainboardDatabase = new MainboardDatabase();
        $this -> assertNotEmpty($mainboardDatabase->getComponent(2));
    }

    public function testAddComponent(){
        $mainboardDatabase = new MainboardDatabase();
        $mainboardDatabase->addComponent(10,"test",179.90,"test",0,4,1,3);
        $this-> assertNotEmpty($mainboardDatabase->getComponent(10));
    }

    public function testUpdateComponent(){
        $mainboardDatabase = new MainboardDatabase();
        $mainboardDatabase->updateComponent(1,"test",179.90,"test",0,4,1,3);
        $mainboard = $mainboardDatabase->getComponent(1);
        $this-> assertEquals('test',$mainboard->getName());
    }

    public function testDeleteComponent(){
        $mainboardDatabase = new MainboardDatabase();
        $this -> assertEmpty($mainboardDatabase->deleteComponent(1));
    }
}
