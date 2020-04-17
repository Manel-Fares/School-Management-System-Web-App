<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ecurityControllerTest extends WebTestCase
{
    public function testAuthentification()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/authentification');
    }

    public function testRedirect()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/home');
    }

}
