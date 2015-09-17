<?php
namespace FlickrSearch\Tests\Http;

use FlickrSearch\Http;

class ResponseTest extends \PHPUnit_Framework_TestCase
{
    public function test_response()
    {
        $response = new Http\Response();
        $this->assertEquals($response->get_header(), array('HTTP/1.1 200 OK'));
        $response->clear_header();
        $this->assertEquals($response->get_header(), array());
        $response->add_header('Test Header');
        $this->assertEquals($response->get_header(), array('Test Header'));
        $response->set_body('Test Hello1');
        $this->assertEquals($response->get_body(), 'Test Hello1');
        $this->assertEquals(strval($response), 'Test Hello1');
    }
}