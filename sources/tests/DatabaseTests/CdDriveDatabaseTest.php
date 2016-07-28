<?php

namespace HsBremen\WebApi\tests;

use HsBremen\WebApi\Database\CdDriveDatabase;

class CdDriveDatabaseTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */

    
    public function testGetCdDriveDatabase(){
        $cdDriveDatabase = new CdDriveDatabase();
        $this -> assertNotEmpty($cdDriveDatabase->getDatabase());
    }


    public function testSetDatabase(){
        $cdDriveDatabase = new CdDriveDatabase();
        $database = [1,2,3];
        $cdDriveDatabase->setDatabase($database);
        $this-> assertContains(2, $cdDriveDatabase->getDatabase());
    }

    public function testGetComponent(){
        $cdDriveDatabase = new CdDriveDatabase();
        $this -> assertNotEmpty($cdDriveDatabase->getComponent(2));
    }

    public function testAddComponent(){
        $cdDriveDatabase = new CdDriveDatabase();
        $cdDriveDatabase->addComponent(10, 'test', 123, 12, 1234, false,true);
        $this-> assertNotEmpty($cdDriveDatabase->getComponent(10));
    }

    public function testUpdateComponent(){
        $cdDriveDatabase = new CdDriveDatabase();
        $cdDriveDatabase->updateComponent(1, 'test', 123, 12, 1234, false,true);
        $cdDrive = $cdDriveDatabase->getComponent(1);
        $this-> assertEquals('test',$cdDrive->getName());
    }

    public function testDeleteComponent(){
        $cdDriveDatabase = new CdDriveDatabase();
        $this -> assertEmpty($cdDriveDatabase->deleteComponent(1));
    }
}
