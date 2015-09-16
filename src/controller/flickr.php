<?php
/**
 * Created by IntelliJ IDEA.
 * User: tony
 * Date: 9/14/15
 * Time: 6:43 PM
 */

class Controller_Flickr extends Controller_App{

    public function __construct(Request $request, Response $response) {
        parent::__construct( $request,  $response);
        $this->model_flickrapi = new Model_FlickrAPI();
    }



    public function action_search() {
        $this->template = "index";

        if (isset($this->request->params['text']) && trim($this->request->params['text'])) {

            $current_page = 1;
            if (isset($this->request->params['page']) && $this->request->params['page'] > 0) {
                $current_page = $this->request->params['page'];
            }

            $text = filter_var($_GET['text'], FILTER_SANITIZE_STRING);
            $text = filter_var($text, FILTER_SANITIZE_SPECIAL_CHARS);

            $images = $this->model_flickrapi->searchImage($text, 5, $current_page);

            //$pagination = new Pagination();
            //$pagination->items($total_num);
            //$pagination->limit(5);
            //$pagination->target("?text=".urlencode($_GET['text']));
            //$pagination->currentPage($current_page);
            $data = array();

            $data['images'] = $images;

            $data['images'] = $images;

            //$data['pagination'] = $pagination;

            $this->show($data);

        }


    }

}
