<?php
namespace MyApp\Http;

class Response
{
    public $header = 'HTTP/1.1 200 OK';
    public $body;

    /**
     * Execute a PHP template file and return the result as a string.
     *
     * @param $template
     * @param array $vars
     * @param bool|true $include_globals
     * @return string
     */
    public function apply_template($template = 'index', $vars = array(), $include_globals = true)
    {
//        header($this->header);

        extract($vars);

        if ($include_globals) extract($GLOBALS, EXTR_SKIP);

        ob_start();

        require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $template . '.php';

        $applied_template = ob_get_contents();
        ob_end_clean();

        return $applied_template;
    }
}