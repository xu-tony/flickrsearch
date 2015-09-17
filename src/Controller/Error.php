<?php
namespace FlickrSearch\Controller;

use FlickrSearch\View;

class Error extends App
{
    public function action_error404()
    {
        $this->response->header = "HTTP/1.0 404 Not Found";
        echo $this->show(new View('error'));
    }

    public function action_error500()
    {
        $this->response->header = "HTTP/1.1 500 Internal Server Error";
        echo $this->show(new View('error'));
    }
}