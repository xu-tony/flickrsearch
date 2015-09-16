<?php
/**
 * Created by IntelliJ IDEA.
 * User: tony
 * Date: 9/14/15
 * Time: 5:26 PM
 */

class Model_FlickrAPI{

    public function __construct() {
        $this->config_flickr = new Config_Flickr();
        $this->library_curl = new Library_Curl();
    }

    public function search_image($text, $numPerPage, $pageSeq){
        $request_url = $this->config_flickr->get_base_url()."?";
        $flickr_search_param = array();
        $flickr_search_param['method'] = $this->config_flickr->get_flickr_search_method();
        $flickr_search_param['format'] = $this->config_flickr->get_flickr_search_format();
        $flickr_search_param['api_key'] = $this->config_flickr->get_flickr_api_key();
        $flickr_search_param['nojsoncallback'] = $this->config_flickr->get_flickr_nojsoncallback();
        $flickr_search_param['text'] = $text;
        $flickr_search_param['per_page'] = $numPerPage;
        $flickr_search_param['page'] = $pageSeq;
        $request_url .= http_build_query($flickr_search_param);
        $http_method_image_search = $this->config_flickr->get_http_method_image_search();

        $response = $this->library_curl->send_transaction($request_url, $http_method_image_search);

        $result = json_decode($response, true);

        $images = array();
        $total_num = null;
        $total_page = null;
        if (isset($result['stat']) && $result['stat']=='ok') {
            $total_page = $result['photos']['pages'];
            $total_num = $result['photos']['total'];
            foreach($result['photos']['photo'] as $photo){
                $images[] = Wrapper_Flickrimage::from_array($photo);
            }
        }

        return array($images, $total_num);
    }
}
