<?php

class Controller_Error extends Controller_App
{
    public function action_error404()
    {
        $this->template = 'error';
        $this->response->header = "HTTP/1.0 404 Not Found";
        $this->show(array('error'=>'error404'));
    }

    public function action_error500()
    {
        $this->template = 'error';
        $this->response->header = "HTTP/1.1 500 Internal Server Error";
        $this->show(array('error'=>'error500'));
    }
}