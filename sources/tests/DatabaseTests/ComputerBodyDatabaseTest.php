<?php

namespace HsBremen\WebApi\tests;

use HsBremen\WebApi\Database\ComputerBodyDatabase;

class ComputerBodyDatabaseTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */

    /*function tests*/
    public function testAddComponent(){
        $computerBodyDatabase = new ComputerBodyDatabase();
        $computerBodyDatabase->addComponent(10, "Fractal Design Define R5 ", 99.99,"ATX");
        $this-> assertNotEmpty($computerBodyDatabase->getComponent(10));
    }

    public function testUpdateComponent(){
        $computerBodyDatabase = new ComputerBodyDatabase();
        $computerBodyDatabase->updateComponent(1, "test", 123,"test");
        $computerBody = $computerBodyDatabase->getComponent(1);
        $this-> assertEquals('test',$computerBody->getName());
    }

    public function testDeleteComponent(){
        $computerBodyDatabase = new ComputerBodyDatabase();
        $this -> assertEmpty($computerBodyDatabase->deleteComponent(1));
    }

    /*getter tests*/
    public function testGetComputerBodyDatabase(){
        $computerBodyDatabase = new ComputerBodyDatabase();
        $this -> assertNotEmpty($computerBodyDatabase->getDatabase());
    }

    public function testGetComponent(){
        $computerBodyDatabase = new ComputerBodyDatabase();
        $this -> assertNotEmpty($computerBodyDatabase->getComponent(2));
    }

    /*setter tests*/
    public function testSetDatabase(){
        $computerBodyDatabase = new ComputerBodyDatabase();
        $database = [1,2,3];
        $computerBodyDatabase->setDatabase($database);
        $this-> assertContains(2, $computerBodyDatabase->getDatabase());
    }



}
