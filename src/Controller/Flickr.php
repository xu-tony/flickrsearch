<?php
/**
 * Created by IntelliJ IDEA.
 * User: tony
 * Date: 9/14/15
 * Time: 6:43 PM
 */

class Controller_Flickr extends Controller_App{

    const IMAGES_PER_PAGE = 5;

    public function __construct(Request $request, Response $response) {
        parent::__construct( $request,  $response);
        $this->model_flickrapi = new Model_FlickrAPI();
    }

    public function action_search() {
        $this->template = "index";
        $data = array();

        if (isset($this->request->params['text']) && trim($this->request->params['text'])) {

            $text = Helper_Utility::sanitizing($this->request->params['text']);

            $current_page = 1;
            if (isset($this->request->params['page']) && is_numeric($this->request->params['page']) && $this->request->params['page']>0) {
                $current_page = intval($this->request->params['page']);
            }

            list($images, $total_num) = $this->model_flickrapi->search_image($text, self::IMAGES_PER_PAGE, $current_page);

            $urlPattern = "?text=".urlencode($this->request->params['text'])."&page=(:num)";

            $pagination = new Library_Pagination($total_num, self::IMAGES_PER_PAGE, $current_page, $urlPattern);

            $data['images'] = $images;
            $data['pagination'] = $pagination;
        }
        $this->show($data);
    }
}
