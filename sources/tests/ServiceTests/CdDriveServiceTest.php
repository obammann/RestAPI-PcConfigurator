<?php

namespace HsBremen\WebApi\tests;

use HsBremen\WebApi\Service\CdDriveService;

class CdDriveServiceTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */

    /*function tests*/
    public function testAddCdDrive(){
        $cdDriveService = new CdDriveService();
        $cdDriveService->addCdDrive(10,'test',2310,43,43,true,false);
        $this->assertNotEmpty($cdDriveService->getSingleCdDrive(10));
    }

    public function testUpdateCdDrive(){
        $cdDriveService = new CdDriveService();
        $cdDriveService->updateCdDrive(1,"test",2, 132, 12, false , true );
        $cdDrive = $cdDriveService->getSingleCdDrive(1);
        $this->assertSame('{"id":1,"name":"test","price":2,"reading time":132,"writing time":12,"is writable":false,"is Blu Ray":true}', $cdDrive->getContent());
    }

    public function testDeleteCdDrive(){
        $cdDriveService = new CdDriveService();
        $cdDrive = $cdDriveService->deleteCdDrive(1);
        $this->assertSame('{"id":1,"name":"ASUS BW-16D1HT ","action":"deleteCdDrive()","state":"success"}',$cdDrive->getContent());
    }

    /*getter tests*/
    public function testGetList(){
        $cdDriveService = new CdDriveService();
        $this->assertNotEmpty($cdDriveService->getList());
    }
    
    public function testGetSingleCdDrive(){
        $cdDriveService = new CdDriveService();
        $this->assertNotEmpty($cdDriveService->getSingleCdDrive(2));
    }


}
