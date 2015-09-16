<?php
error_reporting(-1);
define('DS', DIRECTORY_SEPARATOR);
define('APP', realpath(__DIR__ . DS . '..'));

spl_autoload_register(function ($className) {
    $names = explode('_', $className, 2);
    if (count($names) > 1 && file_exists(APP . DS . strtolower($names[0]))) {
        include APP . DS . strtolower($names[0]) . DS . strtolower($names[1]) . '.php';
    } else {
        include APP . DS . strtolower($names[0]) . '.php';
    }
});

App::Instance()->run(new Request(), new Response());