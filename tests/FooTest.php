<?php

use Guzzle\Http\Client;

class FooTest extends PHPUnit_Framework_TestCase
{

    /**
    * Tests heroku status is green
    */
    public function testHerokuStatus()
    {
        $client = new Client('https://status.heroku.com');
        $request = $client->get('api/v3/current-status');
        $response = $request->send();
        $decodedResponse = $response->json();
        $this->assertEquals($decodedResponse['status']['Production'], 'green');
        $this->assertEquals($decodedResponse['status']['Development'], 'green');
    }
    
    /**
     * Test is beberlei collaborator of doctrine/cache
     */
    public function testCollaboratorExists()
    {
        $client = new Client('https://api.github.com');
        $request = $client->get('/repos/doctrine/cache/collaborators/beberlei');
        $response = $request->send();
        $this->assertEquals($response->getStatusCode(), 204);
    }

}