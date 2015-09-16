<?php

class CurlTest extends PHPUnit_Framework_TestCase
{
    /** @var pagination */
    protected $curl;
    protected $valid_request_url = "www.google.com";
    protected $invalid_request_url = "gdfas";

    public function set_up()
    {
        $this->curl = new Library_Curl();
    }

    public function test_get()
    {
        $response = $this->curl->get($this->valid_request_url);

        echo $response;
    }


}