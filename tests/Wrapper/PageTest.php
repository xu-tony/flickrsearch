<?php
namespace FlickrSearch\Tests\Wrapper;

use FlickrSearch\Wrapper;

class PageTest extends \PHPUnit_Framework_TestCase
{
    /** @var Wrapper\Page $page */
    protected $page;

    public function setUp()
    {
        $num = 2;
        $is_current = 1;
        $url = "?text=bmw&page=2";
        $this->page = new Wrapper\Page($num, $url, $is_current);
    }


    public function test_get_num()
    {
        $this->assertEquals(2, $this->page->get_num());
    }

    public function test_get_url()
    {
        $this->assertEquals("?text=bmw&page=2", $this->page->get_url());
    }

    public function test_is_current()
    {
        $this->assertEquals(1, $this->page->is_current());
    }

}