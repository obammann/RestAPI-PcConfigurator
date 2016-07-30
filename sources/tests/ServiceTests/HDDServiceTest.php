<?php

namespace HsBremen\WebApi\tests;

use HsBremen\WebApi\Service\HDDService;

class HDDServiceTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */

    /*function tests*/
    public function testAddHDD(){
        $hddService = new HDDService();
        $hddService->addHDD(10,"test", 9002, "test1", 27);
        $this->assertNotEmpty($hddService->getSingleHDD(10));
    }

    public function testUpdateHDD(){
        $hddService = new HDDService();
        $hddService->updateHDD(1,"test",1234,'test1',3232);
        $hdd = $hddService->getSingleHDD(1);
        $this->assertSame('{"id":1,"name":"test","price":1234,"type":"test1","memory":3232}', $hdd->getContent());
    }

    public function testDeleteHDD(){
        $hddService = new HDDService();
        $hdd = $hddService->deleteHDD(1);
        $this->assertSame('{"id":1,"name":"HGST HUH728080AL5200","action":"deleteHDD","state":"success"}',$hdd->getContent());
    }

    /*getter tests*/
    public function testGetList(){
        $hddService= new HDDService();
        $this->assertNotEmpty($hddService->getList());
    }

    public function testGetSingleHDD(){
        $hddService = new HDDService();
        $this->assertNotEmpty($hddService->getSingleHDD(2));
    }


}
