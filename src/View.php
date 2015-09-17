<?php
namespace FlickrSearch;

class View
{
    protected static $view_dir;
    protected $template;
    protected $data = array();

    /**
     * Constructor of class
     *
     * @param null $template
     */
    public function __construct($template = null)
    {
        $this->template = $template;
    }

    /**
     * Singleton method to initialize View Directory
     *
     * @param $view_dir
     */
    public static function Initialize($view_dir)
    {
        self::$view_dir = $view_dir . DIRECTORY_SEPARATOR;
        if (!defined('VIEW_INITIALIZED')) {
            define('VIEW_INITIALIZED' , true);
        }
    }

    /**
     * Set variable in template
     *
     * @param $name
     * @param $value
     */
    public function set_var($name, $value)
    {
        $this->data[strval($name)] = $value;
    }

    /**
     * @return mixed
     */
    public function get_view_dir()
    {
        return self::$view_dir;
    }

    /**
     * @return array
     */
    public function get_data()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function set_data(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute a PHP template file and return the result as a string.
     *
     * @param bool|true $include_globals
     * @return string
     */
    public function apply_template($include_globals = true)
    {
        $applied_template = '';
        if ($this->template) {
            extract($this->data);
            if ($include_globals) {
                extract($GLOBALS, EXTR_SKIP);
            }

            ob_start();
            require self::$view_dir . $this->template . '.php';
            $applied_template = ob_get_contents();
            ob_end_clean();
        }

        return $applied_template;
    }
}