<?php

namespace HsBremen\WebApi\tests;

use HsBremen\WebApi\Database\ProcessorDatabase;

class ProcessorDatabaseTest extends \PHPUnit_Framework_TestCase {
  /**
   * @test
   */


  /*function tests*/
  public function testAddComponent(){
    $processorDatabase = new ProcessorDatabase();
    $processorDatabase->addComponent(10, 'test', 123, 'test4', 1234, 1);
    $this-> assertNotEmpty($processorDatabase->getComponent(10));
  }

  public function testUpdateComponent(){
    $processorDatabase = new ProcessorDatabase();
    $processorDatabase->updateComponent(1, 'test', 123, 'test4', 1234, 1);
    $processor = $processorDatabase->getComponent(1);
    $this-> assertEquals('test',$processor->getName());
  }

  public function testDeleteComponent(){
    $processorDatabase = new ProcessorDatabase();
    $this -> assertEmpty($processorDatabase->deleteComponent(1));
  }

  /*getter tests*/
  public function testGetProcessorDatabase(){
    $processorDatabase = new ProcessorDatabase();
    $this -> assertNotEmpty($processorDatabase->getDatabase());
  }

  public function testGetComponent(){
    $processorDatabase = new ProcessorDatabase();
    $this -> assertNotEmpty($processorDatabase->getComponent(2));
  }

  /*setter tests*/
  public function testSetDatabase(){
    $processorDatabase = new ProcessorDatabase();
    $database = [1,2,3];
    $processorDatabase->setDatabase($database);
    $this-> assertContains(2, $processorDatabase->getDatabase());
  }


  
}
