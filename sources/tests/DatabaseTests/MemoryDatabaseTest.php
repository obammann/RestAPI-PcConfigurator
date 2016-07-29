<?php

namespace HsBremen\WebApi\tests;

use HsBremen\WebApi\Database\MemoryDatabase;

class MemoryDatabaseTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */

    /*function tests*/
    public function testAddComponent(){
        $memoryDatabase = new MemoryDatabase();
        $memoryDatabase->addComponent(10,"test", 76, "ddr25", 2, 16);
        $this-> assertNotEmpty($memoryDatabase->getComponent(10));
    }

    public function testUpdateComponent(){
        $memoryDatabase = new MemoryDatabase();
        $memoryDatabase->updateComponent(1,"test", 76, "ddr25", 2, 16);
        $memory = $memoryDatabase->getComponent(1);
        $this-> assertEquals('test',$memory->getName());
    }

    public function testDeleteComponent(){
        $memoryDatabase = new MemoryDatabase();
        $this -> assertEmpty($memoryDatabase->deleteComponent(1));
    }

    /*getter tests*/
    public function testGetHDDDDatabase(){
        $memoryDatabase = new MemoryDatabase();
        $this -> assertNotEmpty($memoryDatabase->getDatabase());
    }

    public function testGetComponent(){
        $memoryDatabase = new MemoryDatabase();
        $this -> assertNotEmpty($memoryDatabase->getComponent(2));
    }

    /*setter tests*/
    public function testSetDatabase(){
        $memoryDatabase = new MemoryDatabase();
        $database = [1,2,3];
        $memoryDatabase->setDatabase($database);
        $this-> assertContains(2, $memoryDatabase->getDatabase());
    }




}
