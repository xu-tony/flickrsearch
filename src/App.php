<?php
namespace FlickrSearch;

use \FlickrSearch\Http;
use \FlickrSearch\Controller;

final class App
{
    /**
     * Singleton method to get the instance
     *
     * @return App
     */
    public static function Instance()
    {
        static $instance = null;
        if ($instance === null) {
            $instance = new App();
        }
        return $instance;
    }

    /**
     * Disallow create a new instance
     */
    private function __construct(){}

    /**
     * Start the routing
     *
     * @param Http\Request $request
     * @param Http\Response $response
     * @return Controller\App
     */
    public function run(Http\Request $request, Http\Response $response) {
        if (method_exists($request->controller, $request->action)) {
            $controllerName = $request->controller;
            $actionName = $request->action;
            $controller = new $controllerName($request, $response);
            $controller->$actionName();
        } else {
            $controller = new Controller\Error($request, $response);
            $controller->action_error404();
        }
        return $controller;
    }
}