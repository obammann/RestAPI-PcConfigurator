<?php

namespace HsBremen\WebApi\tests;

use HsBremen\WebApi\Database\PowerSupplyDatabase;

class PowerSupplyDatabaseTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */


    public function testGetHDDDDatabase(){
        $powerSupplyDatabase = new PowerSupplyDatabase();
        $this -> assertNotEmpty($powerSupplyDatabase->getDatabase());
    }


    public function testSetDatabase(){
        $powerSupplyDatabase = new PowerSupplyDatabase();
        $database = [1,2,3];
        $powerSupplyDatabase->setDatabase($database);
        $this-> assertContains(2, $powerSupplyDatabase->getDatabase());
    }

    public function testGetComponent(){
        $powerSupplyDatabase = new PowerSupplyDatabase();
        $this -> assertNotEmpty($powerSupplyDatabase->getComponent(2));
    }

    public function testAddComponent(){
        $powerSupplyDatabase = new PowerSupplyDatabase();
        $powerSupplyDatabase->addComponent(10,"test", 76, "ddr25", 2, 16);
        $this-> assertNotEmpty($powerSupplyDatabase->getComponent(10));
    }

    public function testUpdateComponent(){
        $powerSupplyDatabase = new PowerSupplyDatabase();
        $powerSupplyDatabase->updateComponent(1,"test", 76, "ddr25", 2, 16);
        $powerSupply = $powerSupplyDatabase->getComponent(1);
        $this-> assertEquals('test',$powerSupply->getName());
    }

    public function testDeleteComponent(){
        $powerSupplyDatabase = new PowerSupplyDatabase();
        $this -> assertEmpty($powerSupplyDatabase->deleteComponent(1));
    }
}
