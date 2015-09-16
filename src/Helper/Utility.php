<?php
/**
 * Created by IntelliJ IDEA.
 * User: tony
 * Date: 9/16/15
 * Time: 11:38 AM
 */

class Helper_Utility {

    public static function sanitizing ($text) {
        $text = filter_var($text, FILTER_SANITIZE_STRING);
        $text = filter_var($text, FILTER_SANITIZE_SPECIAL_CHARS);

        return $text;
    }
}