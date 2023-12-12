<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TodoListControllerTest extends WebTestCase
{
    public function testReadAll()
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertResponseIsSuccessful();
    }

    public function testCreate()
    {
        $client = static::createClient();
        $list = [
            "name" => "Courses",
            "description" => "Ma super liste de courses",
            "color" => "red",
            "date" => "12-12-2023"
        ];
        $client->request(
            'POST',
            "/create",
            $list,
        );
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}
