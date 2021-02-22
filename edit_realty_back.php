<?php
    include 'db.php';
    include 'functions.php';

    isset($_POST['id']) && is_numeric($_POST['id']) ? $id = $_POST['id'] : exit('ID not available.');
    isset($_POST['realty_type']) && is_numeric($_POST['realty_type']) ? $realty_type = $_POST['realty_type'] : $realty_type = "";
    isset($_POST['ad_type']) && is_numeric($_POST['ad_type']) ? $ad_type = $_POST['ad_type'] : $ad_type = "";
    isset($_POST['city_id']) && is_numeric($_POST['city_id']) ? $city_id = $_POST['city_id'] : $city_id = "";
    isset($_POST['size']) && is_numeric($_POST['size']) ? $size = $_POST['size'] : $size = "";
    isset($_POST['price']) && is_numeric($_POST['price']) ? $price = $_POST['price'] : $price = "";
    isset($_POST['year_of_construction']) && is_numeric($_POST['year_of_construction']) ? $year_of_construction = $_POST['year_of_construction'] : $year_of_construction = "";
    isset($_POST['description']) ? $description = $_POST['description'] : $description = "";
    isset($_POST['status']) && is_numeric($_POST['status']) ? $status = $_POST['status'] : $status = "";
    isset($_POST['date_of_sale']) ? $date_of_sale = $_POST['date_of_sale'] : $date_of_sale = "";

    $status == 0 ? $date_of_sale = null : $date_of_sale = $_POST['date_of_sale'];

    if ($date_of_sale != null) {
        $update_query = "UPDATE realties SET
        realty_type_id = $realty_type,
        ad_type_id = $ad_type, 
        city_id = $city_id,
        size = $size,
        price = $price,
        year_of_construction = $year_of_construction,
        description = '$description',
        status = $status,
        date_of_sale = '$date_of_sale'
        WHERE id = $id
        ";
    } else {
        $update_query = "UPDATE realties SET
        realty_type_id = $realty_type,
        ad_type_id = $ad_type, 
        city_id = $city_id,
        size = $size,
        price = $price,
        year_of_construction = $year_of_construction,
        description = '$description',
        status = $status,
        date_of_sale = NULL        
        WHERE id = $id
        ";
    }

    mysqli_query($db, "BEGIN");

    $res_update = mysqli_query($db, $update_query);

    if ($res_update) {

        $photos_arr = $_FILES['photos']['name'];
        
        if ($photos_arr[0] != "") {
            
            // temporary path
            $temp_path_arr = $_FILES['photos']['tmp_name'];

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
                    mysqli_query($db, "ROLLBACK");
                    exit("No valid file type. Try again.");
                }
                
            }

            foreach ($new_photos as $photo) {

                $update_query_img = "INSERT INTO `photos`(`realty_id`, `name`)  VALUES ($id, '$photo')";
                $photo_update = mysqli_query($db, $update_query_img);
                // add a check of if it went well or not
                if ($photo_update) {
                    continue;
                } else {
                    mysqli_query($db, "ROLLBACK");
                    redirect("index.php?msg=photo_not_updated");
                }
            } 

            mysqli_query($db, "COMMIT"); 
            redirect("index.php?msg=realty_updated");
        
        } else {
            mysqli_query($db, "COMMIT"); 
            redirect("index.php?msg=realty_updated");
        }
        
    } else {
        mysqli_query($db, "ROLLBACK"); 
        redirect("index.php?msg=realty_not_updated");
    }  

?>