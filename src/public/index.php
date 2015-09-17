<?php
error_reporting(-1);
require realpath('..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Autoload.php');

FlickrSearch\View::Initialize(realpath(__DIR__ . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR . 'views');
$response = FlickrSearch\App::Instance()->run(new FlickrSearch\Http\Request())->get_response();
if (!$response->is_header_sent()) {
    $response->send_headers();
}
echo $response->get_body();