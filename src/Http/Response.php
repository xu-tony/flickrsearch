<?php
namespace FlickrSearch\Http;

class Response
{
    private $headers = array('HTTP/1.1 200 OK');

    /**
     * @param $value
     */
    public function add_header($value) {
        $this->headers[] = $value;
    }

    /**
     * @return array
     */
    public function get_header() {
        return $this->headers;
    }

    /**
     *
     */
    public function clear_header() {
        $this->headers = array();
    }

    /**
     * @return bool
     */
    public function is_header_sent()
    {
        return headers_sent();
    }

    /**
     *
     */
    public function send_headers()
    {
        foreach ($this->get_header() as $header) {
            header($header);
        }

    }
}