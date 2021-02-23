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

            if ($id == $id_temp) {
                    $selected = "selected";
                } else {
                    $selected = "";
                }
           
            echo "<option value='$id_temp' $selected>$name_temp</option>";
        }
    }


?>