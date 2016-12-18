<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TemporadasControllerTest extends WebTestCase
{
    public function testListar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/temporadas/{serieId}');
    }

}
