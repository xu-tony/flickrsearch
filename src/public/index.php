<?php
error_reporting(-1);
require realpath('..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Autoload.php');

MyApp\App::Instance()->run(new MyApp\Http\Request(), new MyApp\Http\Response());