<?php

class Request
{
    public $method;
    public $get;
    public $post;
    public $serverName;
    public $requestUri;
    public $params = array();
    public $controller = 'index';
    public $action = 'index';

    /**
     * Constructor of Request
     */
    public function __construct()
    {
        if (!empty($_GET)) {
            $this->get = $_GET;
        }
        if (!empty($_POST)) {
            $this->post = $_POST;
        }
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->serverName = $_SERVER['SERVER_NAME'];
        $this->requestUri = array_shift(explode('?', $_SERVER['REQUEST_URI'], 2));
        parse_str($_SERVER['QUERY_STRING'], $this->params);
        list($this->controller, $this->action) = $this->route($this->requestUri);
    }

    /**
     * Modification of properties of Request object is disallowed
     *
     * @param $name
     * @param $value
     * @throws Exception
     */
    public function __set($name, $value){
        throw new Exception('Properties is read only!');
    }

    /**
     * Generate the name of controller and action
     *
     * @param $requestUri
     * @return array - array(0 => 'Controller_Name', 1 => 'actionName')
     */
    public function route($requestUri)
    {
        $controllerName = 'Controller_Index';
        $actionName = 'actionIndex';
        $requestUri = strtolower($requestUri);
        if (!empty($requestUri) && $requestUri !== '/') {
            $urlParts = explode('/', $requestUri);
            switch (count($urlParts)) {
                case 2:
                    $controllerName = 'Controller_' . ucfirst($urlParts[0]);
                    $actionName = 'action' . $urlParts[1];
                    break;

                case 1:
                    $actionName = 'action' . $urlParts[0];
                    break;
            }
        }
        $result = array($controllerName, $actionName);
        return $result;
    }
}