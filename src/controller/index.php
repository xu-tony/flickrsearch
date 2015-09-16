<?php

class Controller_Index extends Controller_App
{
    public function actionIndex()
    {
        $data = array();
        $data['name'] = 'Test';
        $this->show($data);
    }
}