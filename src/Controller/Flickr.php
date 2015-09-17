<?php
namespace FlickrSearch\Controller;

use FlickrSearch\Http;
use FlickrSearch\Model;
use FlickrSearch\Library;
use FlickrSearch\View;

class Flickr extends App
{

    const IMAGES_PER_PAGE = 5;

    /**
     * @param $text
     * @param $current_page
     * @return array
     */
    public function search_image($text, $current_page)
    {
        $model_flickrapi = new Model\FlickrAPI();
        return $model_flickrapi->search_image($text, self::IMAGES_PER_PAGE, $current_page);
    }

    /**
     * control the image search and display
     */
    public function action_search()
    {
        $data = array();
        $view = new View('index');

        if (isset($this->request->params['text']) && trim($this->request->params['text'])) {
            // sanitizing
            $text = filter_var($this->request->params['text'], FILTER_SANITIZE_STRING);
            $text = filter_var($text, FILTER_SANITIZE_SPECIAL_CHARS);

            $current_page = 1;
            if (isset($this->request->params['page']) && is_numeric($this->request->params['page']) && $this->request->params['page'] > 0) {
                $current_page = intval($this->request->params['page']);
            }

            list($images, $total_num) = $this->search_image($text, $current_page);

            $urlPattern = "?text=" . urlencode($this->request->params['text']) . "&page=(:num)";
            $pagination = new Library\Pagination($total_num, self::IMAGES_PER_PAGE, $current_page, $urlPattern);

            $result_view = new View('searchresult');
            $result_view->set_data(array("images" => $images));

            $pagination_view = new View('pagination');
            $pagination_view->set_data(array("pagination" => $pagination));
            $page = $pagination->get_next_page();
            $data['search_result_view'] = $this->show($result_view);
            $data['pagination_view'] = $this->show($pagination_view);
        }
        $view->set_data($data);
        return $this->show($view);
    }
}
