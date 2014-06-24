<?php

use GuzzleHttp\Client;

class FooTest extends PHPUnit_Framework_TestCase
{

    /**
    * Tests heroku status is green
    */
    public function testHerokuStatus()
    {
        //$client = new Client('https://status.heroku.com');           // old line
        $client = new Client(array('https://status.heroku.com'));      // new line, parameter may be empty as well

        // $request = $client->get('api/v3/current-status');           // old line
        $request = $client->get('https://status.heroku.com/api/v3/current-status'); // new line

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
        $client = new Client();
        $request = $client->get('https://api.github.com/repos/doctrine/cache/collaborators/beberlei');
        $response = $request;
        $this->assertEquals($response->getStatusCode(), 204);
    }

}


// (Norbert C. Maier, 2014-Jun-24)
//
// This file is an update for the 2013-May-20 version of
//  https://github.com/o/rest-api-test-example/blob/master/tests/FooTest.php
// This file works with my Guzzle 4.1.2 (2014-06-18).
//
// The update was done empirically, not after the documentation.
// The documentation http://api.guzzlephp.org/ seems not up to date,
// e.g. it still tells the wrong namespace 'Guzzle\Http\Client'.
//
// The changes are as follow.
//
// (1) Namespace is no more Guzzle\Http\Client but GuzzleHttp\Client
// old-line : use Guzzle\Http\Client;
// new-line : use GuzzleHttp\Client;
//
// (2) The Client constructor wants no more a string but an array.
// old-line : $client = new Client('https://status.heroku.com');
// new-line : $client = new Client(array('https://status.heroku.com'));
// new-line : $client = new Client(); // alternative
// note : One question has still to be answered: If I pass the
//    base URL here as an array entry, how then can I utilize that
//    information in below call to $client->get()?
//    Passing the array here is actually useless. It works as well
//    without any parameter. It is useless, because in below get()
//    the same information is passed again. The line just demonstrates
//    that passing an array does not cause an error, as opposed to
//    passing a string.
//
// (3) Method $client->get() is not called with a partial URL, but a full URL.
// old-line : $request = $client->get('api/v3/current-status');
// new-line : $request = $client->get('https://status.heroku.com/api/v3/current-status');
// note : Actually, the partial URL should suffice, since the base URL
//    is already given in above constructor. I could not see quickly,
//    how to utilize that. So I quick'n'dirty pass the complete URL.
//    The original line causes cUrl error # 3 'URL malformed'.
//
// (4) Method $client->get() returns not a Request, but a Response object.
// old-line : $response = $request->send();
// new-line : $response = $request;
// note : Haha, this curious assignment is done just to preserve the
//    line. Normally, you merge the two names to one, and drop the line.
//
// Bye.

?>
