<?php
error_reporting(-1);
require realpath('..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Autoload.php');

FlickrSearch\View::Initialize(realpath(__DIR__ . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR . 'views');
FlickrSearch\App::Instance()->run(new FlickrSearch\Http\Request());