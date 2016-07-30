<?php

namespace HsBremen\WebApi\tests;

use HsBremen\WebApi\Service\MemoryService;

class MemoryServiceTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */

    /*function tests*/
    public function testAddMemory(){
        $memoryService = new MemoryService();
        $memoryService->addMemory(10,"test", 11, "tet1", 1, 2);
        $this->assertNotEmpty($memoryService->getSingleMemory(10));
    }

    public function testUpdateMemory(){
        $memoryService = new MemoryService();
        $memoryService->updateMemory(1,"test",1.99,"testitest",1,2);
        $memory = $memoryService->getSingleMemory(1);
        $this->assertSame('{"id":1,"name":"test","price":1.99,"type":"testitest","module":1,"memory":2}', $memory->getContent());
    }

    public function testDeleteMemory(){
        $memoryService = new MemoryService();
        $memory = $memoryService->deleteMemory(1);
        $this->assertSame('{"id":1,"name":"Corsair DIMM","action":"deleteMemory()","state":"success"}',$memory->getContent());
    }

    /*getter tests*/
    public function testGetList(){
        $memoryService= new MemoryService();
        $this->assertNotEmpty($memoryService->getList());
    }

    public function testGetSingleMemory(){
        $memoryService = new MemoryService();
        $this->assertNotEmpty($memoryService->getSingleMemory(2));
    }


}
