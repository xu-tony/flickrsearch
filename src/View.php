<?php
namespace FlickrSearch;

class View
{
    public $template;
    public $var = array();

    public function __construct($template = null)
    {
        $this->template = $template;
    }

    /**
     * Execute a PHP template file and return the result as a string.
     *
     * @param $template
     * @param array $vars
     * @param bool|true $include_globals
     * @return string
     */
    public function apply_template($template, $vars = array(), $include_globals = true)
    {
        extract($vars);
        if ($include_globals) {
            extract($GLOBALS, EXTR_SKIP);
        }

        ob_start();
        if ($template) {
            require $template . '.php';
        }
        $applied_template = ob_get_contents();
        ob_end_clean();

        return $applied_template;
    }
}