<?php 
    require 'db.php';

    function maxId($table) {  
        global $db;
        return mysqli_fetch_row(mysqli_query($db, "SELECT COALESCE(MAX(id), 0) FROM $table"))[0];
    }
    
    function redirect($url) {
        header("location: $url");
        exit();
    }


    // function validate($arr, $key, $required = false, $default = "", $url = "") {
    //     isset($arr[$key]) && $arr[$key] != "" ? return $arr[$key] : redirect($url);
?>