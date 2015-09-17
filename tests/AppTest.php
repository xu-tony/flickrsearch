<?php
namespace FlickrSearch\Tests;

use FlickrSearch;
use FlickrSearch\Http;

class AppTest extends \PHPUnit_Framework_TestCase
{
    public function testInstance()
    {
        $app1 = FlickrSearch\App::Instance();
        $app2 = FlickrSearch\App::Instance();
        $this->assertEquals($app1 === $app2, True);
    }

    public function testRun()
    {
        $app = FlickrSearch\App::Instance();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['SERVER_NAME'] = '127.0.0.1';

        $_SERVER['REQUEST_URI'] = '/testclass/testaction';
        $_SERVER['QUERY_STRING'] = 'name=test123';
        $request = new Http\Request();
        $controller = $app->run($request);
        $this->assertEquals($controller->get_request(), $request);
        $this->assertEquals($request->controller, 'FlickrSearch\Controller\Testclass');
        $this->assertEquals($request->action, 'action_testaction');
        $this->assertEquals($request->params['name'], 'test123');
    }
}