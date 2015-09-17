<?php
error_reporting(-1);
require realpath('..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Autoload.php');

FlickrSearch\App::Instance()->run(new FlickrSearch\Http\Request(), new FlickrSearch\Http\Response());