<?php

//use Guzzle\Http\Client;                                              // old line
use GuzzleHttp\Client;                                                 // new line

class Guzzle4FooTest extends PHPUnit_Framework_TestCase
{

    /**
    * Tests heroku status is green
    */
    public function testHerokuStatus()
    {
        //$client = new Client('https://status.heroku.com');           // old line
        $client = new Client(['base_url' => 'https://status.heroku.com']); // new line

        $request = $client->get('api/v3/current-status');

        //$response = $request->send();                                // old line
        $response = $request;                                          // new line, could be eliminated

        $decodedResponse = $response->json();
        $this->assertEquals($decodedResponse['status']['Production'], 'green');
        $this->assertEquals($decodedResponse['status']['Development'], 'green');
    }

    /**
     * Test is beberlei collaborator of doctrine/cache
     */
    public function testCollaboratorExists()
    {
        // As opposed to above test, this one calls the Client constructor
        //  without passing a base URL, and instead uses a full URL in get().
        $client = new Client();
        $request = $client->get('https://api.github.com/repos/doctrine/cache/collaborators/beberlei');
        $response = $request;
        $this->assertEquals($response->getStatusCode(), 204);
    }

}


// (Norbert C. Maier, 2014-Jun-25)
//
// This file is a supplement for the 2013-May-20 Guzzle-3 file
//  https://github.com/o/rest-api-test-example/blob/master/tests/FooTest.php
// This file is tested with Guzzle 4.1.2 (2014-06-18).
//
// Note that the documentation at http://api.guzzlephp.org/ seems not up
// to date, e.g. it still tells the old namespace 'Guzzle\Http\Client'. The
// actual documentation is http://guzzle.readthedocs.org/en/latest/clients.html .
//
// The changes are as follow.
//
// (1) Namespace
// old-line : use Guzzle\Http\Client;
// new-line : use GuzzleHttp\Client;
//
// (2) The Client constructor wants no more a string but an array.
// old-line : $client = new Client('https://status.heroku.com');
// new-line : $client = new Client(['base_url' => 'https://status.heroku.com']);
// new-line : $client = new Client(); // alternative
// note : Having an associative array as constructor parameter indicates,
//    there will be other informations beside the base URL, which can
//    be passed. Just I could not find quickly, what those are.
//
// (3) Method $client->get() returns not a Request, but a Response object.
// old-line : $response = $request->send();
// new-line : $response = $request;
// note : Haha, this curious assignment is done just to preserve the
//    line. Normally, you merge the two names to one, and drop the line.
//
// Bye.

?>
