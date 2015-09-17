<?php
namespace FlickrSearch\Tests\Library;

use FlickrSearch\Library;

class PaginationTest extends \PHPUnit_Framework_TestCase
{
    /** @var Library\Pagination $pagination */
    protected $pagination;

    public function setUp()
    {
        $numItems = 100;
        $itemsPerPage = 10;
        $currentPage = 5;
        $urlPattern = "?text=bmw&page=(:num)";
        $this->pagination = new Library\Pagination($numItems, $itemsPerPage, $currentPage, $urlPattern);
    }


    public function test_get_next_page()
    {
        $this->assertEquals(6, $this->pagination->get_next_page());
    }
    public function test_get_prev_page()
    {
        $this->assertEquals(4, $this->pagination->get_prev_page());
    }

    public function test_get_next_url()
    {
        $this->assertEquals('?text=bmw&page=6', $this->pagination->get_next_url());
    }

    public function test_get_prev_url()
    {
        $this->assertEquals('?text=bmw&page=4', $this->pagination->get_prev_url());
    }
    /**
     * @dataProvider getTestData
     */
    public function test_get_pages($numPages, $currentPage, $expected)
    {
        $pagination = new Library\Pagination($numPages, 1, $currentPage);
        $pages = $pagination->get_pages();
        $pageNums = array_map(function($page) { return $page->get_num(); }, $pages);
        $this->assertEquals($expected, $pageNums);
    }
    public function get_test_data()
    {
        return array(
            // num pages, current page, max pages to show, expected pagination
            array(20, 1, array(1, 2, 3, 4, 5, 6, 7, 8, 9, "...", 20)),
            array(20, 2, array(1, 2, 3, 4, 5, 6, 7, 8, 9, '...', 20)),
            array(20, 20, array(1, '...', 12, 13, 14, 15, 16, 17, 18, 19, 20)),
            array(20, 19, array(1, '...', 12, 13, 14, 15, 16, 17, 18, 19, 20)),
            array(20, 10, array(1, '...', 7, 8, 9, 10, 11, 12, 13, 14, '...', 20)),
            array(20, 9, array(1, '...', 6, 7, 8, 9, 10, 11, 12, 13, '...', 20)),
            array(5, 3, array(1, 2, 3, 4, 5)),
            array(1, 1, array()) // No pagination if there's only one page.
        );
    }

}