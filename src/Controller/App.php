<?php
namespace FlickrSearch\Controller;

use FlickrSearch\Http;
use FlickrSearch\View;

abstract class App
{
    protected $request;
    protected $response;
    protected $view;

    /**
     * Constructor of class
     *
     * @param Http\Request $request
     */
    public function __construct(Http\Request $request)
    {
        $this->request = $request;
        $this->response = new Http\Response();
    }

    /**
     * @return Http\Request
     */
    public function get_request()
    {
        return $this->request;
    }

    /**
     * @return Http\Response
     */
    public function get_response()
    {
        return $this->response;
    }

    /**
     * Display page
     *
     * @param View|null $view
     * @return string
     */
    public function show(View $view = null)
    {
        if (!headers_sent()) {
            foreach ($this->get_response()->headers as $header) {
                header($header);
            }
        }

        $render_result = '';
        if (defined('VIEW_INITIALIZED') && $view) {
            $render_result = $view->apply_template(true);
        }
        return $render_result;
    }
}