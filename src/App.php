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
    private function __construct()
    {
    }

    /**
     * Start the routing
     *
     * @param Http\Request $request
     * @return Controller\App
     */
    public function run(Http\Request $request)
    {
        if (method_exists($request->controller, $request->action)) {
            $controllerName = $request->controller;
            $actionName = $request->action;
            $controller = new $controllerName($request);
            $controller->$actionName();
        } else {
            $controller = new Controller\Error($request);
            $controller->action_error404();
        }
        return $controller;
    }
}