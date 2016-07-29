<?php

namespace HsBremen\WebApi\tests;

use HsBremen\WebApi\Service\MainboardService;

class MainboardServiceTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */

    /*function tests*/
    public function testAddMainboard(){
        $mainboardService = new MainboardService();
        $mainboardService->addMainboard(10,"test",3.99,"32",1,2,3,4);
        $this->assertNotEmpty($mainboardService->getSingleMainboard(10));
    }

    public function testUpdateMainboard(){
        $mainboardService = new MainboardService();
        $mainboardService->updateMainboard(1,"test",1.99,"555",4,3,2,1);
        $mainboard = $mainboardService->getSingleMainboard(1);
        $this->assertSame('{"id":1,"name":"test","price":1.99,"processor socket":"555","number of DDR3 slots":4,"number of DDR4 slots":3,"number of SATA connectors":2}', $mainboard->getContent());
    }

    public function testDeleteMainboard(){
        $mainboardService = new MainboardService();
        $mainboard = $mainboardService->deleteMainboard(1);
        $this->assertSame('{"id":1,"name":"MSI Z170A","action":"deleteMainboard()","state":"success"}',$mainboard->getContent());
    }

    /*getter tests*/
    public function testGetList(){
        $mainboardService= new MainboardService();
        $this->assertNotEmpty($mainboardService->getList());
    }

    public function testGetSingleMainboard(){
        $mainboardService = new MainboardService();
        $this->assertNotEmpty($mainboardService->getSingleMainboard(2));
    }


}
