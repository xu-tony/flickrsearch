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
     * Display pages
     *
     * @param array $vars
     */
    public function show($vars = array())
    {
        echo $this->response->apply_template($this->template, $vars, true);
    }
}