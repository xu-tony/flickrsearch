<?php

class Controller_Index extends Controller_App
{



    public function action_index()
    {

        $data = array();
        //$data['name'] = 'Test';
        $this->show($data);

    }

}