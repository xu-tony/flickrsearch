<?php

class Controller_Error extends Controller_App
{
    public function actionError404()
    {
        $this->template = 'error404';
        $this->response->header = "HTTP/1.0 404 Not Found";
        $this->show('error404');
    }

    public function actionError500()
    {
        $this->template = 'error500';
        $this->response->header = "HTTP/1.1 500 Internal Server Error";
        $this->show('error500');
    }
}