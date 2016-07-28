<?php

namespace HsBremen\WebApi\tests;

use HsBremen\WebApi\Database\HDDDatabase;

class HDDDatabaseTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */


    public function testGetHDDDatabase(){
        $hddDatabase = new HDDDatabase();
        $this -> assertNotEmpty($hddDatabase->getDatabase());
    }


    public function testSetDatabase(){
        $hddDatabase = new HDDDatabase();
        $database = [1,2,3];
        $hddDatabase->setDatabase($database);
        $this-> assertContains(2, $hddDatabase->getDatabase());
    }

    public function testGetComponent(){
        $hddDatabase = new HDDDatabase();
        $this -> assertNotEmpty($hddDatabase->getComponent(2));
    }

    public function testAddComponent(){
        $hddDatabase = new HDDDatabase();
        $hddDatabase->addComponent(10,"test", 23, "test", 23);
        $this-> assertNotEmpty($hddDatabase->getComponent(10));
    }

    public function testUpdateComponent(){
        $hddDatabase = new HDDDatabase();
        $hddDatabase->updateComponent(1,"test", 23, "test", 23);
        $hdd = $hddDatabase->getComponent(1);
        $this-> assertEquals('test',$hdd->getName());
    }

    public function testDeleteComponent(){
        $hddDatabase = new HDDDatabase();
        $this -> assertEmpty($hddDatabase->deleteComponent(1));
    }
}
