<?php
namespace FlickrSearch\Tests\Library;

use FlickrSearch\Library;

class CurlTest extends \PHPUnit_Framework_TestCase
{
    /** @var $curl */
    protected $curl;
    protected $valid_request_url = "www.google.com";
    protected $invalid_request_url = "gdfas";

    public function setUp()
    {
        $this->curl = new Library\Curl();
    }

    public function test_get()
    {
        $response = $this->curl->get($this->valid_request_url);

        echo $response;
    }


}