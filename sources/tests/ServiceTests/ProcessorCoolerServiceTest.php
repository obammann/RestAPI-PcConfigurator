<?php

namespace HsBremen\WebApi\tests;

use HsBremen\WebApi\Service\ProcessorCoolerService;

class ProcessorCoolerServiceTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */

    /*function tests*/
    public function testAddProcessorCooler(){
        $processorCoolerService = new ProcessorCoolerService();
        $processorCoolerService->addProcessorCooler(10,"test", 59,"test");
        $this->assertNotEmpty($processorCoolerService->getSingleProcessorCooler(10));
    }

    public function testUpdateProcessorCooler(){
        $processorCoolerService = new ProcessorCoolerService();
        $processorCoolerService->updateProcessorCooler(1,"test",1.99,1,2);
        $processorCooler = $processorCoolerService->getSingleProcessorCooler(1);
        $this->assertSame('{"id":1,"name":"test","price":1.99,"processor socket":1}', $processorCooler->getContent());
    }

    public function testDeleteProcessorCooler(){
        $processorCoolerService = new ProcessorCoolerService();
        $processorCooler = $processorCoolerService->deleteProcessorCooler(0);
        $this->assertSame('{"id":0,"name":"be quiet! Dark Rock 3","action":"deleteProcessorCooler","state":"success"}',$processorCooler->getContent());
    }

    /*getter tests*/
    public function testGetList(){
        $processorCoolerService= new ProcessorCoolerService();
        $this->assertNotEmpty($processorCoolerService->getList());
    }

    public function testGetSinglProcessorCooler(){
        $processorCoolerService = new ProcessorCoolerService();
        $this->assertNotEmpty($processorCoolerService->getSingleProcessorCooler(2));
    }


}
