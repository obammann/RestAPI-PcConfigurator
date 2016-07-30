<?php

namespace HsBremen\WebApi\tests;

use HsBremen\WebApi\Service\GraphicCardService;

class GraphicCardServiceTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */

    /*function tests*/
    public function testAddGraphicCard(){
        $graphicCardService = new GraphicCardService();
        $graphicCardService->addGraphicCard(10,'test',2310,17,23);
        $this->assertNotEmpty($graphicCardService->getSingleGraphicCard(10));
    }

    public function testUpdateGraphicCard(){
        $graphicCardService = new GraphicCardService();
        $graphicCardService->updateGraphicCard(1,"test",1111, 444,999);
        $graphicCard = $graphicCardService->getSingleGraphicCard(1);
        $this->assertSame('{"id":1,"name":"test","price":1111,"occupied slots":444,"memory":999}', $graphicCard->getContent());
    }

    public function testDeleteGraphicCard(){
        $graphicCardService = new GraphicCardService();
        $graphicCard = $graphicCardService->deleteGraphicCard(1);
        $this->assertSame('{"id":1,"name":"GeForce GTX 1070 Gaming X 8G","action":"deleteGraphicCard()","state":"success"}',$graphicCard->getContent());
    }

    /*getter tests*/
    public function testGetList(){
        $graphicCardService= new GraphicCardService();
        $this->assertNotEmpty($graphicCardService->getList());
    }

    public function testGetSingleGraphicCard(){
        $graphicCardService = new GraphicCardService();
        $this->assertNotEmpty($graphicCardService->getSingleGraphicCard(2));
    }


}
