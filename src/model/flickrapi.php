<?php
/**
 * Created by IntelliJ IDEA.
 * User: tony
 * Date: 9/14/15
 * Time: 5:26 PM
 */

class Model_FlickrAPI extends Connection{

    public function __construct() {
        parent::__construct();
        $this->flickrconfig = new FlickrConfig();
    }

    public function searchImage($text, $numPerPage, $pageSeq){
        $request_url = $this->flickrconfig->get_base_url()."?";
        $flickr_search_param = array();

        $flickr_search_param['method'] = $this->flickrconfig->get_flickr_search_method();
        $flickr_search_param['format'] = $this->flickrconfig->get_flickr_search_format();
        $flickr_search_param['api_key'] = $this->flickrconfig->get_flickr_api_key();
        $flickr_search_param['nojsoncallback'] = $this->flickrconfig->get_flickr_nojsoncallback();
        $flickr_search_param['text'] = $text;
        $flickr_search_param['per_page'] = $numPerPage;
        $flickr_search_param['page'] = $pageSeq;

        $request_url .= http_build_query($flickr_search_param);

        $http_method_image_search = $this->flickrconfig->get_http_method_image_search();

        $response = $this->send_transaction($request_url, $http_method_image_search);

        $result = json_decode($response, true);

        return $result;
    }
}
