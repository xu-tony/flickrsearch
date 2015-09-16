<?php
error_reporting(-1);
require realpath('..' . DIRECTORY_SEPARATOR . 'Autoload.php');

App::Instance()->run(new Request(), new Response());