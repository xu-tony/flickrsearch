<?php
/**
 * Created by IntelliJ IDEA.
 * User: tony
 * Date: 9/14/15
 * Time: 5:18 PM
 */

class Library_Curl {
    protected $curl_obj;

    function __construct() {
        // initialise cURL object/options
        $this->curl_obj = curl_init();
    }


    function __destruct() {
        // free cURL resources/session
        curl_close($this->curl_obj);
    }


    public function send_transaction($request_url, $method, $request = null) {
        // The below sets the HTTP operation type
        if ($method == "GET") {
            curl_setopt($this->curl_obj, CURLOPT_HTTPGET, 1);
        }
        else if ($method == "POST") {
            // NOTE: POST operations are currently not supported in this version
            // [Snippet] howToPost - start
            curl_setopt($this->curl_obj, CURLOPT_POST, 1);
            // [Snippet] howToPost - end
            curl_setopt($this->curl_obj, CURLOPT_POSTFIELDS, $request);
            // [Snippet] howToSetHeaders - start
            curl_setopt($this->curl_obj, CURLOPT_HTTPHEADER, array("Content-Length: " . strlen($request)));
            curl_setopt($this->curl_obj, CURLOPT_HTTPHEADER, array("Content-Type: Application/json;charset=UTF-8"));
            // [Snippet] howToSetHeaders - end
        }


        // [Snippet] howToSetURL - start
        // call the function below to construct the URL for sending the transaction
        curl_setopt($this->curl_obj, CURLOPT_URL, $request_url);
        // [Snippet] howToSetURL - end

        // tells cURL to return the result if successful, of FALSE if the operation failed
        curl_setopt($this->curl_obj, CURLOPT_RETURNTRANSFER, TRUE);

        // set time out
        curl_setopt($this->curl_obj, CURLOPT_CONNECTTIMEOUT , 10);
        curl_setopt($this->curl_obj, CURLOPT_TIMEOUT, 10); //timeout in seconds

        // [Snippet] executeSendTransaction - start
        // send the transaction
        $response = curl_exec($this->curl_obj);
        // [Snippet] executeSendTransaction - end


        // assigns the cURL error to response if something went wrong so the caller can echo the error
        if (curl_error($this->curl_obj)){
            $response = "cURL Error: " . curl_errno($this->curl_obj) . " - " . curl_error($this->curl_obj);
        }

        // respond with the transaction result, or a cURL error message if it failed
        return $response;
    }

}
