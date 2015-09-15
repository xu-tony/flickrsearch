<?php
/**
 * Created by IntelliJ IDEA.
 * User: tony
 * Date: 9/14/15
 * Time: 5:26 PM
 */
include('../config/flickrconfig.php');
include('../connection/connection.php');

class Model_FlickrAPI extends Connection{

    public function __construct() {
        parent::__construct();
        $this->flickrconfig = new FlickrConfig();
    }

    public function __destruct() {
    }

    public function searchImage($text, $numPerPage, $pageSeq){
        $request_url = $this->flickrconfig->get_base_url()."?";

        $flickr_search_param = $this->flickrconfig->get_flickr_basic_search_params();
        $flickr_search_param['text'] = urlencode($text);
        $flickr_search_param['per_page'] = $numPerPage;
        $flickr_search_param['page'] = $pageSeq;

        $request_url .= http_build_query($flickr_search_param);

        $http_method_image_search = $this->flickrconfig->get_http_method_image_search();

        $response = $this->send_transaction($request_url, $http_method_image_search);

        $result = json_decode($response, true);

        return $result;
    }
}
