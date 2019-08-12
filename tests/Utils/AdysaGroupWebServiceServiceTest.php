<?php

namespace App\Tests\Utils;

use App\Utils\WebServices\AdysaGroup\AdysaGroupWebServiceService;
use PHPUnit\Framework\TestCase;

class AdysaGroupWebServiceServiceTest extends TestCase {

    /**
     * @test
     */
    public function testSearch() {

        $objeto = new \stdClass();
        $objeto->title = 'PROSEGUR ACTIVA WEBSITE CORPORATIVO';
        $objeto->url = 'http://www.adysagroup.com/es/experiencia?PROSEGUR-ACTIVA-WEBSITE-CORPORATIVO';

        $search = new AdysaGroupWebServiceService();
        $result = $search->search('PROSEGUR');
        $this->assertEquals([$objeto], $result);
        
    }

}
