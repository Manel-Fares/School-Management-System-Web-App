<?php

namespace schoolBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class securityControllerTest extends WebTestCase
{
    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/add');
    }

    public function testRedirect()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/userhome');
    }

}
