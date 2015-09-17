<?php
namespace FlickrSearch\Controller;

use FlickrSearch\View;

class Index extends App
{
    /**
     * this is the default controller default action
     */
    public function action_index()
    {
        return $this->show(new View('index'));
    }
}