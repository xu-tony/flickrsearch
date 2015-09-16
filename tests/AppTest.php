<?php

class AppTest extends PHPUnit_Framework_TestCase
{
    public function testInstance()
    {
        $app1 = App::Instance();
        $app2 = App::Instance();
        $this->assertEquals($app1 === $app2, True);
    }

    public function testRun()
    {
        $app = App::Instance();

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['SERVER_NAME'] = '127.0.0.1';

        $_SERVER['REQUEST_URI'] = '/';
        $_SERVER['QUERY_STRING'] = 'name=test';
        $request = new Request();
        $respsonse = new Response();
        $app->run($request, $respsonse);
        $this->assertEquals($app->get_request(), $request);
    }
}