<?php

class Request
{
    public $method;
    public $get;
    public $post;
    public $server_name;
    public $request_uri;
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
        $this->server_name = $_SERVER['SERVER_NAME'];
        $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
        $this->request_uri = array_shift($uri_parts);
        parse_str($_SERVER['QUERY_STRING'], $this->params);
        list($this->controller, $this->action) = $this->route($this->request_uri);
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
     * @param $request_uri
     * @return array - array(0 => 'Controller_Name', 1 => 'actionName')
     */
    public function route($request_uri)
    {
        $controller_name = 'Controller_Index';
        $action_name = 'action_index';
        $request_uri = strtolower($request_uri);
        if (!empty($request_uri) && $request_uri !== '/') {
            $request_uri = substr($request_uri, 1);

            $url_parts = explode('/', $request_uri);
            switch (count($url_parts)) {
                case 2:
                    $controller_name = 'Controller_' . ucfirst($url_parts[0]);
                    $action_name = 'action_' . lcfirst($url_parts[1]);
                    break;

                case 1:
                    $action_name = 'action_' . lcfirst($url_parts[0]);
                    break;
            }
        }
        $result = array($controller_name, $action_name);
        return $result;
    }
}