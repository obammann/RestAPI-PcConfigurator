<?php

namespace HsBremen\WebApi\tests;

use HsBremen\WebApi\Service\ProcessorService;

class ProcessorServiceTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */

    /*function tests*/
    public function testAddProcessor(){
        $processorService = new ProcessorService();
        $processorService->addProcessor(10, 'test', 123, '456', 789, 0);
        $this->assertNotEmpty($processorService->getSingleProcessor(10));
    }

    public function testUpdateProcessor(){
        $processorService = new ProcessorService();
        $processorService->updateProcessor(1,"test",1.99,'1', 2, 2);
        $processor = $processorService->getSingleProcessor(1);
        $this->assertSame('{"id":1,"name":"test","price":1.99,"processor socket":"1","frequency":2,"cores":2}', $processor->getContent());
    }

    public function testDeleteProcessor(){
        $processorService = new ProcessorService();
        $processor = $processorService->deleteProcessor(0);
        $this->assertSame('{"id":0,"name":"Intel Core i7-6700K","action":"deleteProcessor","state":"success"}',$processor->getContent());
    }

    /*getter tests*/
    public function testGetList(){
        $processorService= new ProcessorService();
        $this->assertNotEmpty($processorService->getList());
    }

    public function testGetSinglProcessor(){
        $processorService = new ProcessorService();
        $this->assertNotEmpty($processorService->getSingleProcessor(2));
    }


}
