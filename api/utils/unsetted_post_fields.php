<?php
    // Variables
    static $MESSAGE_FIELDS_UNSET = "The required fields weren't set correctly.";
    static $MESSAGE_USER_NOT_LOGGED_IN = "The user is not logged in.";

    /** Checks if a given set of POST fields are set or not */
    function getUnsettedPostFields(...$fields){
        // TODO sanitize strings for sql injection
        $unsettedFields = [];
        foreach($fields as $field){
            if(!isset($_POST[$field])){
                array_push($unsettedFields, $field);
            }
        }
        return $unsettedFields;
    }
?>