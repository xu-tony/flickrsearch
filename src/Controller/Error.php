<?php
namespace FlickrSearch\Controller;

use FlickrSearch\View;

class Error extends App
{
    public function action_error404()
    {
        $this->response->clear_header();
        $this->response->add_header("HTTP/1.0 404 Not Found");
        $view = new View('error');
        $view->set_var('error', '404 Page Not Found');
        echo $this->show($view);
    }
}