<?php
/**
 * Created by IntelliJ IDEA.
 * User: tony
 * Date: 9/15/15
 * Time: 6:50 PM
 */
class Wrapper_Page{
    private $num = null;
    private $url = null;
    private $is_current = false;

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
