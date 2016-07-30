<?php

namespace HsBremen\WebApi\tests;

use HsBremen\WebApi\Service\ComputerBodyService;

class ComputerBodyServiceTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */

    /*function tests*/
    public function testAddCdDrive(){
        $computerBodyService = new ComputerBodyService();
        $computerBodyService->addComputerBody(10,'test',2310,'test1');
        $this->assertNotEmpty($computerBodyService->getSingleComputerBody(10));
    }

    public function testUpdateCdDrive(){
        $computerBodyService = new ComputerBodyService();
        $computerBodyService->updateComputerBody(1,"test",2, 132,'test32');
        $computerBody = $computerBodyService->getSingleComputerBody(1);
        $this->assertSame('{"id":1,"name":"test","price":2,"form factor":132}', $computerBody->getContent());
    }

    public function testDeleteCdDrive(){
        $computerBodyService = new ComputerBodyService();
        $computerBody = $computerBodyService->deleteComputerBody(1);
        $this->assertSame('{"id":1,"name":"Sharkoon VS4-S","action":"deleteComputerBody","state":"success"}',$computerBody->getContent());
    }

    /*getter tests*/
    public function testGetList(){
        $computerBodyService= new ComputerBodyService();
        $this->assertNotEmpty($computerBodyService->getList());
    }

    public function testGetSingleComputerBody(){
        $computerBodyService = new ComputerBodyService();
        $this->assertNotEmpty($computerBodyService->getSingleComputerBody(2));
    }


}
