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
        if (isset($this->request->params['text']) && trim($this->request->params['text'])) {
            $text = Helper_Utility::sanitizing($this->request->params['text']);

            $current_page = 1;
            if (isset($this->request->params['page'])) {
                $page = Helper_Utility::sanitizing($this->request->params['page']);
                $current_page = $page;
            }

            list($images, $total_num) = $this->model_flickrapi->search_image($text, self::IMAGES_PER_PAGE, $current_page);

            $pagination = new Library_Pagination();
            $pagination->items($total_num);
            $pagination->limit(self::IMAGES_PER_PAGE);
            $pagination->target("?text=".urlencode($_GET['text']));
            $pagination->currentPage($current_page);
            $data = array();

            $data['images'] = $images;

            $data['pagination'] = $pagination;

            $this->show($data);

        }

    }

}
