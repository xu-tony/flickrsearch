<?php
namespace FlickrSearch\Tests\Controller;

class AppTest extends \PHPUnit_Framework_TestCase
{
    public function test_app()
    {
        $request = $this->getMockBuilder('FlickrSearch\Http\Request')->getMock();
        $app = $this->getMockBuilder('FlickrSearch\Controller\App')->getMock();
    }
}