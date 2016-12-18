<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SeriesControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
    }

    public function testGerenciar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/series/gerenciar');
    }

}
