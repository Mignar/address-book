<?php

namespace Tests\AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use PHPUnit\Framework\TestCase;

class ContactControllerTest extends WebTestCase
{
    /**
     * Test if these pages are reachable
     * 
     * @dataProvider provideUrls
     */
    public function testPageIsSuccessful($url) : void
    {
        $client = self::createClient();

        $client->request('GET', $url);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function provideUrls() : array
    {
        return [
            ['/'],
            ['/contacts'],
            ['/contacts/create'],
        ];
    }
}
