<?php

abstract class Controller_App
{
    protected $request;
    protected $response;
    protected $template = 'index';

    /**
     * Constructor of class
     *
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @return Request
     */
    public function get_request()
    {
        return $this->request;
    }

    /**
     * @return Response
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