<?php

class Controller_Index extends Controller_App
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