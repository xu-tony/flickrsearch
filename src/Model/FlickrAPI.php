<?php
namespace FlickrSearch\Model;

use FlickrSearch\Config;
use FlickrSearch\Library;
use FlickrSearch\Wrapper;

class FlickrAPI extends App
{
    /**
     * Send search request to Flickr API
     *
     * @param $text
     * @param $numPerPage
     * @param $pageSeq
     * @return mixed|string
     */
    public function send_request($text, $numPerPage, $pageSeq)
    {
        $config_flickr = new Config\Flickr();
        $library_curl = new Library\Curl();

        $request_url = $config_flickr->get_base_url()."?";

        $flickr_search_param = array();
        $flickr_search_param['method'] = $config_flickr->get_flickr_search_method();
        $flickr_search_param['format'] = $config_flickr->get_flickr_search_format();
        $flickr_search_param['api_key'] = $config_flickr->get_flickr_api_key();
        $flickr_search_param['nojsoncallback'] = $config_flickr->get_flickr_nojsoncallback();
        $flickr_search_param['text'] = $text;
        $flickr_search_param['per_page'] = $numPerPage;
        $flickr_search_param['page'] = $pageSeq;
        $request_url .= http_build_query($flickr_search_param);

        $response = $library_curl->get($request_url);
        return $response;
    }

    /**
     * specific search image function, build query url and parse json result.
     *
     * @param $text
     * @param $numPerPage
     * @param $pageSeq
     * @return array
     */
    public function search_image($text, $numPerPage, $pageSeq)
    {
        $response = $this->send_request($text, $numPerPage, $pageSeq);

        $result = json_decode($response, true);

        $images = array();
        if (isset($result['stat']) && $result['stat']=='ok') {
            foreach($result['photos']['photo'] as $photo) {
                $images[] = Wrapper\Flickrimage::from_array($photo);
            }
        }
        return $images;
    }
}
