<?php

final class App
{
    public $config;

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
     * @param array $config
     * @param Request $request
     * @param Response $response
     */
    public function run(array $config, Request $request, Response $response) {
        $this->config = $config;

        if (method_exists($request->controller, $request->action)) {
            $controllerName = $request->controller;
            $actionName = $request->action;
            $controller = new $controllerName($request, $response);
            $controller->$actionName();
        } else {
            $controller = new Controller_Error($request, $response);
            $controller->actionError404();
        }
    }
}