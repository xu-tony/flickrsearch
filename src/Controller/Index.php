<?php
namespace MyApp\Controller;

class Index extends App
{
    /**
     * this is the default controller default action
     */
    public function action_index()
    {
        $data = array();
        $this->show($data);
    }
}