<?php
/**
 * Created by IntelliJ IDEA.
 * User: tony
 * Date: 9/15/15
 * Time: 6:31 PM
 */
class Library_Pagination
{
    const NUM_PLACEHOLDER = '(:num)';

    protected $total_items;
    protected $num_pages;
    protected $items_per_page;
    protected $current_page;
    protected $url_pattern;
    protected $max_pages_to_show = 10;

    /**
     * @param int $total_items The total number of items.
     * @param int $items_per_page The number of items per page.
     * @param int $current_page The current page number.
     * @param string $url_pattern A URL for each page, with (:num) as a placeholder for the page number. Ex. '&page=(:num)'
     */
    public function __construct($total_items, $items_per_page, $current_page, $url_pattern = '')
    {
        $this->total_items = $total_items;
        $this->items_per_page = $items_per_page;
        $this->current_page = $current_page;
        $this->url_pattern = $url_pattern;

        $this->update_num_pages();
    }

    protected function update_num_pages()
    {
        $this->num_pages = ($this->items_per_page == 0 ? 0 : (int) ceil($this->total_items/$this->items_per_page));
    }

    /**
     * @return int
     */
    public function get_num_pages()
    {
        return $this->num_pages;
    }

    /**
     * @param int $pageNum
     * @return string
     */
    public function get_page_url($pageNum)
    {
        return str_replace(self::NUM_PLACEHOLDER, $pageNum, $this->url_pattern);
    }

    public function get_next_page()
    {
        if ($this->current_page < $this->num_pages) {
            return $this->current_page + 1;
        }

        return null;
    }

    public function get_prev_page()
    {
        if ($this->current_page > 1) {
            return $this->current_page - 1;
        }

        return null;
    }

    public function get_next_url()
    {
        if (!$this->get_next_page()) {
            return null;
        }

        return $this->get_page_url($this->get_next_page());
    }

    /**
     * @return string|null
     */
    public function get_prev_url()
    {
        if (!$this->get_prev_page()) {
            return null;
        }

        return $this->get_page_url($this->get_prev_page());
    }

    /**
     * Get an array of paginated page data.
     *
     * Example:
     * array(
     *     Wrapper_Page ('num' => 1,     'url' => '&page=1',  'is_current' => false),
     *     Wrapper_Page ('num' => '...', 'url' => NULL,       'is_current' => false),
     *     Wrapper_Page ('num' => 3,     'url' => '&page=1',  'is_current' => false),
     *     Wrapper_Page ('num' => 4,     'url' => '&page=1',  'is_current' => true ),
     *     Wrapper_Page ('num' => 5,     'url' => '&page=1',  'is_current' => false),
     *     Wrapper_Page ('num' => '...', 'url' => NULL,       'is_current' => false),
     *     Wrapper_Page ('num' => 10,    'url' => '&page=1',  'is_current' => false),
     * )
     *
     * @return array
     */
    public function get_pages()
    {
        $pages = array();

        if ($this->num_pages <= 1) {
            return array();
        }

        if ($this->num_pages <= $this->max_pages_to_show) {
            for ($i = 1; $i <= $this->num_pages; $i++) {
                $pages[] = $this->create_page($i, $i == $this->current_page);
            }
        } else {

            // Determine the sliding range, centered around the current page.
            $num_adjacents = (int) floor(($this->max_pages_to_show - 3) / 2);

            if ($this->current_page + $num_adjacents > $this->num_pages) {
                $sliding_start = $this->num_pages - $this->max_pages_to_show + 2;
            } else {
                $sliding_start = $this->current_page - $num_adjacents;
            }
            if ($sliding_start < 2) $sliding_start = 2;

            $sliding_end = $sliding_start + $this->max_pages_to_show - 3;
            if ($sliding_end >= $this->num_pages) $sliding_end = $this->num_pages - 1;

            // Build the list of pages.
            $pages[] = $this->create_page(1, $this->current_page == 1);
            if ($sliding_start > 2) {
                $pages[] = $this->create_page_ellipsis();
            }
            for ($i = $sliding_start; $i <= $sliding_end; $i++) {
                $pages[] = $this->create_page($i, $i == $this->current_page);
            }
            if ($sliding_end < $this->num_pages - 1) {
                $pages[] = $this->create_page_ellipsis();
            }
            $pages[] = $this->create_page($this->num_pages, $this->current_page == $this->num_pages);
        }


        return $pages;
    }


    /**
     * Create a page data structure.
     *
     * @param int $page_num
     * @param bool $is_current
     * @return Array
     */
    protected function create_page($page_num, $is_current = false)
    {
        return new Wrapper_Page($page_num,$this->get_page_url($page_num),$is_current);
    }

    /**
     * @return array
     */
    protected function create_page_ellipsis()
    {
        return new Wrapper_Page('...',null,false);
    }
}
