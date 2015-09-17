<?php
namespace FlickrSearch\Tests\Library;

use FlickrSearch\Library;

class CurlTest extends \PHPUnit_Framework_TestCase
{
    /** @var $curl */
    protected $curl;
    protected $valid_request_url = "www.google.com";
    protected $invalid_request_url = "gdfas";


    public function test_get()
    {
        $curl = $this->getMockBuilder('FlickrSearch\Library\Curl')
            ->setMethods(array('curl_exec'))
            ->getMock();

        $curl->expects($this->once())
            ->method('curl_exec')
            ->willReturn("200 ok");

        $response = $curl->get($this->valid_request_url);
        $this->assertEquals("200 ok", $response);
    }


}