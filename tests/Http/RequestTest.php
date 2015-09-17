<?php
namespace FlickrSearch\Tests\Http;

use FlickrSearch\Http;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['SERVER_NAME'] = '127.0.0.1';
        $_SERVER['REQUEST_URI'] = '/testclass/testaction';
        $_SERVER['QUERY_STRING'] = 'name=test123';
    }

    public function test_request()
    {
        $request = new Http\Request();
        $this->assertEquals($request->method, 'GET');
        $this->assertEquals($request->request_uri, '/testclass/testaction');
        $this->assertEquals($request->server_name, '127.0.0.1');
        $this->assertEquals($request->params, array('name'=>'test123'));
    }

    public function test_route()
    {
        $request = new Http\Request();
        $result = $request->route('/testclass/testaction');
        $this->assertEquals($result, array('FlickrSearch\Controller\Testclass', 'action_testaction'));
    }
}