<?php
/**
 * Created by IntelliJ IDEA.
 * User: tony
 * Date: 9/14/15
 * Time: 5:04 PM
 */
class Config_Flickr {

    private $base_url = null;
    private $flickr_search_method = null;
    private $flickr_search_format = null;
    private $flickr_api_key = null;
    private $flickr_nojsoncallback = null;
    private $http_method_image_search = null;

    // we can pass different env to retrieve the different config
    public function __construct() {

        $this->base_url = "https://api.flickr.com/services/rest/";

        $this->flickr_search_method = "flickr.photos.search";
        $this->flickr_search_format = "json";
        $this->flickr_api_key = "e47dfff26e61503c2535cb032ae9def8";
        $this->flickr_nojsoncallback = "1";

        $this->http_method_image_search = 'GET';
    }

    public function get_base_url() {
        return $this->base_url;
    }
    public function get_flickr_search_method() {
        return $this->flickr_search_method;
    }
    public function get_flickr_search_format() {
        return $this->flickr_search_format;
    }
    public function get_flickr_api_key() {
        return $this->flickr_api_key;
    }
    public function get_flickr_nojsoncallback() {
        return $this->flickr_nojsoncallback;
    }
    public function get_http_method_image_search() {
        return $this->http_method_image_search;
    }

}
