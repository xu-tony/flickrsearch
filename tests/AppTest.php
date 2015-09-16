<?php
namespace MyApp\Tests;

use MyApp;
use MyApp\Http;

class AppTest extends \PHPUnit_Framework_TestCase
{
    public function testInstance()
    {
        $app1 = MyApp\App::Instance();
        $app2 = MyApp\App::Instance();
        $this->assertEquals($app1 === $app2, True);
    }

    public function testRun()
    {
        $app = MyApp\App::Instance();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['SERVER_NAME'] = '127.0.0.1';

        $_SERVER['REQUEST_URI'] = 'testclass/testaction';
        $_SERVER['QUERY_STRING'] = 'name=test123';
        $request = new Http\Request();
        $respsonse = new Http\Response();
        $app->run($request, $respsonse);
        $this->assertEquals($app->get_request(), $request);
        $this->assertEquals($request->controller, 'Controller_Testclass');
        $this->assertEquals($request->action, 'testaction');
        $this->assertEquals($request->params['name'], 'test123');
    }
}