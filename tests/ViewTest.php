<?php
namespace FlickrSearch\Tests;

use FlickrSearch;

class ViewTest extends \PHPUnit_Framework_TestCase
{
    public function test_initialize()
    {
        FlickrSearch\View::Initialize('/test');
        $view = new FlickrSearch\View();
        $this->assertEquals($view->get_view_dir(), '/test/');
        $this->assertEquals(defined('VIEW_INITIALIZED'), true);
    }

    public function test_render_template()
    {
        FlickrSearch\View::Initialize(realpath(__DIR__ . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'views');
        $view = new FlickrSearch\View('test');
        $data = array('test' => 'test1');
        $view->set_data($data);
        $view->set_var('test2', 'test22');
        $result = $view->apply_template();
        $this->assertEquals($view->get_template(), 'test');
        $this->assertEquals($view->get_data(), array('test' => 'test1', 'test2' => 'test22'));
        $this->assertEquals($result, 'test1');
        $view->set_template('test2');
        $this->assertEquals($view->get_template(), 'test2');
    }
}