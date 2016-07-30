<?php

namespace HsBremen\WebApi\tests;

use HsBremen\WebApi\Service\PowerSupplyService;

class PowerSupplyServiceTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */

    /*function tests*/
    public function testAddPowerSupply(){
        $powerSupplyService = new PowerSupplyService();
        $powerSupplyService->addPowerSupply(10, "test" ,123, 9000);
        $this->assertNotEmpty($powerSupplyService->getSinglePowerSupply(10));
    }

    public function testUpdatePowerSupply(){
        $powerSupplyService = new PowerSupplyService();
        $powerSupplyService->updatePowerSupply(1,"test",1.99,1,2);
        $powerSupply = $powerSupplyService->getSinglePowerSupply(1);
        $this->assertSame('{"id":1,"name":"test","price":1.99,"power":1}', $powerSupply->getContent());
    }

    public function testDeletePowerSupply(){
        $powerSupplyService = new PowerSupplyService();
        $powerSupply = $powerSupplyService->deletePowerSupply(1);
        $this->assertSame('{"id":1,"name":"Thermaltake Berlin","action":"deletePowerSupply()","state":"success"}',$powerSupply->getContent());
    }

    /*getter tests*/
    public function testGetList(){
        $powerSupplyService= new PowerSupplyService();
        $this->assertNotEmpty($powerSupplyService->getList());
    }

    public function testGetSinglPowerSupply(){
        $powerSupplyService = new PowerSupplyService();
        $this->assertNotEmpty($powerSupplyService->getSinglePowerSupply(2));
    }


}
