<?php
namespace MyApp\Controller;

use \MyApp\Http;

abstract class App
{
    protected $request;
    protected $response;
    protected $template = 'index';

    /**
     * Constructor of class
     *
     * @param Http\Request $request
     * @param Http\Response $response
     */
    public function __construct(Http\Request $request, Http\Response $response)
    {
        $this->request = $request;
        $this->response = $response;
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
     * @return string
     */
    public function get_template()
    {
        return $this->template;
    }

    /**
     * Display pages
     *
     * @param array $vars
     */
    public function show($vars = array())
    {
        echo $this->response->apply_template($this->template, $vars, true);
    }
}