<?php
namespace FlickrSearch\Model;

use FlickrSearch\Config;
use FlickrSearch\Library;
use FlickrSearch\Wrapper;

class FlickrAPI extends AppModel
{

    protected $images;
    protected $images_total_num = null;
    /**
     * flickr api, get config class and initialize curl
     */
    public function __construct() {
        $this->config_flickr = new Config\Flickr();
        $this->library_curl = new Library\Curl();

        $this->images = array();
        $this->images_total_num = null;
    }

    /**
     * @param $text
     * @param $numPerPage
     * @param $pageSeq
     * @return array
     *
     * specific search image function, build query url and parse json result.
     */
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

        $response = $this->library_curl->get($request_url);

        $result = json_decode($response, true);

        $images = array();
        $total_num = null;
        $total_page = null;
        if (isset($result['stat']) && $result['stat']=='ok') {
            $total_page = $result['photos']['pages'];
            $total_num = $result['photos']['total'];
            foreach($result['photos']['photo'] as $photo){
                $images[] = Wrapper\Flickrimage::from_array($photo);
            }
        }
        $this->set_images($images);
        $this->set_images_total_num($total_num);

    }

    protected function set_images($images){
        $this->images = $images;
    }

    public function get_images(){
        return $this->images;
    }

    protected function set_images_total_num($images_total_num){
        $this->images_total_num = $images_total_num;
    }

    public function get_images_total_num(){
        return $this->images_total_num;
    }
}
