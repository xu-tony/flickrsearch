<?php
namespace FlickrSearch\Controller;

use FlickrSearch\Http;
use FlickrSearch\View;

abstract class App
{
    protected $request;
    protected $response;
    protected $view;
    public $default_template = 'index';

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
     * Build response body by combining data with templates
     *
     * @param View|null $view
     * @return string
     */
    public function show(View $view = null)
    {
        $body = '';
        if (defined('VIEW_INITIALIZED') && $view) {
            if ($view->get_template() === '') {
                $view->set_template($this->default_template);
            }
            $body = $view->apply_template(true);
            $this->get_response()->set_body($body);
        }
        return $body;
    }
}