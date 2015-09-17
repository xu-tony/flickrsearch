<?php
namespace FlickrSearch\Library;

class Curl {
    protected $curl_obj;

    /**
     * general curl initialize, which can extend more curl functions
     */
    function __construct() {
        // initialise cURL object/options
        $this->curl_obj = curl_init();
    }

    function __destruct() {
        // free cURL resources/session
        curl_close($this->curl_obj);
    }

    /**
     * @param $request_url
     * @return mixed|string
     * basic curl get action, adding the required curl params
     */
    public function get($request_url) {
        // The below sets the HTTP operation type

        curl_setopt($this->curl_obj, CURLOPT_HTTPGET, 1);

        // call the function below to construct the URL for sending the transaction
        curl_setopt($this->curl_obj, CURLOPT_URL, $request_url);

        // tells cURL to return the result if successful, of FALSE if the operation failed
        curl_setopt($this->curl_obj, CURLOPT_RETURNTRANSFER, TRUE);

        // set time out
        curl_setopt($this->curl_obj, CURLOPT_CONNECTTIMEOUT , 10);
        curl_setopt($this->curl_obj, CURLOPT_TIMEOUT, 10); //timeout in seconds

        // send the transaction
        $response = curl_exec($this->curl_obj);


        // assigns the cURL error to response if something went wrong so the caller can echo the error
        if (curl_error($this->curl_obj)){
            $response = "cURL Error: " . curl_errno($this->curl_obj) . " - " . curl_error($this->curl_obj);
        }

        // respond with the transaction result, or a cURL error message if it failed
        return $response;
    }

}
