<?php

namespace HsBremen\WebApi\tests;

use HsBremen\WebApi\Database\ProcessorCoolerDatabase;

class ProcessorCoolerDatabaseTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */

    /*function tests*/
    public function testAddComponent(){
        $processorCoolerDatabase = new ProcessorCoolerDatabase();
        $processorCoolerDatabase->addComponent(10,"test", 111,"3232");
        $this-> assertNotEmpty($processorCoolerDatabase->getComponent(10));
    }

    public function testUpdateComponent(){
        $processorCoolerDatabase = new ProcessorCoolerDatabase();
        $processorCoolerDatabase->updateComponent(1,"test", 111,"3232");
        $processorCooler = $processorCoolerDatabase->getComponent(1);
        $this-> assertEquals('test',$processorCooler->getName());
    }

    public function testDeleteComponent(){
        $processorCoolerDatabase = new ProcessorCoolerDatabase();
        $this -> assertEmpty($processorCoolerDatabase->deleteComponent(1));
    }
    
    /*getter tests*/
    public function testGetHDDDDatabase(){
        $processorCoolerDatabase = new ProcessorCoolerDatabase();
        $this -> assertNotEmpty($processorCoolerDatabase->getDatabase());
    }

    public function testGetComponent(){
        $processorCoolerDatabase = new ProcessorCoolerDatabase();
        $this -> assertNotEmpty($processorCoolerDatabase->getComponent(2));
    }

    /*setter tests*/
    public function testSetDatabase(){
        $processorCoolerDatabase = new ProcessorCoolerDatabase();
        $database = [1,2,3];
        $processorCoolerDatabase->setDatabase($database);
        $this-> assertContains(2, $processorCoolerDatabase->getDatabase());
    }


    
}
