<?php
/**
 * Created by IntelliJ IDEA.
 * User: tony
 * Date: 9/14/15
 * Time: 5:04 PM
 */
class FlickrConfig {

    private $base_url = null;
    private $flickr_basic_search_params = array();
    private $http_method_image_search = null;

    // we can pass different env to retrieve the different config
    public function __construct() {

        $this->base_url = "https://api.flickr.com/services/rest/";

        $this->flickr_basic_search_params['method'] = "flickr.photos.search";
        $this->flickr_basic_search_params['format'] = "json";
        $this->flickr_basic_search_params['api_key'] = "e47dfff26e61503c2535cb032ae9def8";
        $this->flickr_basic_search_params['nojsoncallback'] = "1";

        $this->http_method_image_search = 'GET';
    }

    public function get_base_url() {
        return $this->base_url;
    }

    public function get_flickr_basic_search_params() {
        return $this->flickr_basic_search_params;
    }

    public function get_http_method_image_search() {
        return $this->http_method_image_search;
    }

}
