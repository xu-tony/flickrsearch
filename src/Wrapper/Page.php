<?php
namespace MyApp\Wrapper;

class Page{
    private $num;
    private $url;
    private $is_current;

    public function __construct($num, $url, $is_current) {
        $this->num = $num;
        $this->url = $url;
        $this->is_current = $is_current;
    }

    /**
     * @return null
     */
    public function get_num()
    {
        return $this->num;
    }

    /**
     * @return null
     */
    public function get_url()
    {
        return $this->url;
    }

    /**
     * @return null
     */
    public function is_current()
    {
        return $this->is_current;
    }

}
