<?php
namespace FlickrSearch\Tests\Http;

use FlickrSearch\Http;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    public function test_init()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['SERVER_NAME'] = '127.0.0.1';

        $_SERVER['REQUEST_URI'] = '/testclass/testaction';
        $_SERVER['QUERY_STRING'] = 'name=test123';
        $request = new Http\Request();
    }
}