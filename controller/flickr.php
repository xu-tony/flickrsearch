<?php
/**
 * Created by IntelliJ IDEA.
 * User: tony
 * Date: 9/14/15
 * Time: 6:43 PM
 */

include('./model/flickrapi.php');
include('./model/flickrimage.php');
class Controller_Flickr{

    public function __construct() {
        $this->flickr_api = new Model_FlickrAPI();

        define('IMAGES_PER_PAGE', 5);

    }

    public function generate_search_box() {

    }

    public function generate_pagination($total_num, $total_page) {
        return null;
    }

    public function get_images($text, $page_num = null) {

        $text = filter_var($text, FILTER_SANITIZE_STRING);
        $numPerPage = IMAGES_PER_PAGE;
        $result = $this->flickr_api->searchImage($text, $numPerPage, $page_num);
        $images = array();
        $total_num = null;
        $total_page = null;
        if (isset($result['stat']) && $result['stat']=='ok') {
            $total_page = $result['photos']['pages'];
            $total_num = $result['photos']['total'];
            foreach($result['photos']['photo'] as $photo){
                $images[] = FlickrImage::from_array($photo);
            }
        }

        return array($images, $total_num, $total_page);
    }


}
