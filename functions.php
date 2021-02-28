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

    function selectMenu($table, $id = null) {
        global $db;
        
        $res = mysqli_query($db, "SELECT * FROM $table ORDER BY name");

        while($row = mysqli_fetch_assoc($res)) {
            $id_temp = $row['id'];
            $name_temp = $row['name'];

            $id == $id_temp ? $selected = "selected" : $selected = "";
           
            echo "<option value='$id_temp' $selected>$name_temp</option>";
        }
    }

    function validate($arr, $key, $numeric = true, $required = false, $default ="", $url = "") {
        // CASE 1: numeric + required
        if ($numeric && $required) {
            if (($arr[$key]) != "" && is_numeric($arr[$key])) {
                return $arr[$key];
            } else {
                redirect($url);
            }
        // CASE 2: not numeric but required
        } else if (!($numeric) && $required) {
            if (($arr[$key]) != "") {
                return $arr[$key];
            } else {
                redirect($url);
            }
        // CASE 3: not required
        } else if (!$required) {
            if ($arr[$key] != "") {
                return $arr[$key]; 
            } else {
                return $default;
            }
        }
    }

    function checkPhotoType($arr) {
        // photos
        $photos_arr = $_FILES[$arr]['name'];

        // temp path
        $temp_path_arr = $_FILES[$arr]['tmp_name'];

        $new_photos = [];
        $allowedTypes = ['jpg', 'jpeg', 'png'];

        foreach ($photos_arr as $key=>$photo_name) {
            $temp_arr = explode(".", $photo_name);
            $ext = $temp_arr[count($temp_arr)-1];
    
            // checking that the file extension is valid 
            if (in_array($ext, $allowedTypes)) {
                // new permanent path
            $new_file_name = "./images/".uniqid().".".$ext;
    
            copy($temp_path_arr[$key], $new_file_name);
    
            // adding it to an array
            $new_photos[] = $new_file_name;
            } else {
               return false;
            }
        }
        return $new_photos;
    }
    
    function insert($table, $values) {
        global $db;
        $cols = [];
        $vals = [];
        foreach($values as $key => $val) {
            $cols[] = "`".$key."`";
            $vals[] = "'".$val."'";
        }

        $query = "INSERT INTO $table ( ". implode(", ", $cols) . ") VALUES (". implode(", ", $vals) . ")";
        return mysqli_query($db, $query);
    }

    function update($table, $values, $id, $date_of_sale) {
        global $db;
        $arr = [];
        foreach($values as $key => $val) {
            $arr[] = "`$key` = '$val'";
        }
        // when we go from unavailable to available, the date needs to be reset to NULL
        // it is manually added because when the $date_of_sale varible of value null is added to the query
        // it turns into '' and messes up the code, leaving 0000-00-00 as the date 
        $date_of_sale == null ? $arr[] = "date_of_sale = NULL" : $arr[] = "date_of_sale = '$date_of_sale'";
        
        $update_query = "UPDATE $table SET ". implode(", ", $arr)." WHERE id = $id";
        return mysqli_query($db, $update_query);
    }

    function deletePhotos($arr) {
        global $db;
        $del_photos = json_decode(($_POST[$arr]));
        foreach($del_photos as $photo_id) {
            $delete_res = mysqli_query($db, "DELETE FROM photos WHERE id = $photo_id");
            if (!$delete_res) {
                return false;
            }
        }
        return true;
    }

   

    


?>