<?php
    include 'db.php';
    include 'functions.php';

    // var_dump($_POST);
    // exit;

    isset($_POST['realty_type']) && is_numeric($_POST['realty_type']) ? $realty_type = $_POST['realty_type'] : $realty_type = "";
    isset($_POST['ad_type']) && is_numeric($_POST['ad_type']) ? $ad_type = $_POST['ad_type'] : $ad_type = "";
    isset($_POST['city_id']) && is_numeric($_POST['city_id']) ? $city_id = $_POST['city_id'] : $city_id = "";
    isset($_POST['size']) && is_numeric($_POST['size']) ? $size = $_POST['size'] : $size = "";
    isset($_POST['price']) && is_numeric($_POST['price']) ? $price = $_POST['price'] : $price = "";
    isset($_POST['year_of_construction']) && is_numeric($_POST['year_of_construction']) ? $year_of_construction = $_POST['year_of_construction'] : $year_of_construction = "";
    isset($_POST['description']) ? $description = $_POST['description'] : $description = "";
    isset($_POST['status']) && is_numeric($_POST['status']) ? $status = $_POST['status'] : $status = "";

    // if the status is available, date of sale is automatically set to null
    // else it takes the relevant value from the post array 

    if ($status == 0) {
        $date_of_sale = "";
        $date_col = ""; 
    }  else {
        $date_of_sale = ",'".$_POST['date_of_sale']."'";
        $date_col = ",date_of_sale"; 
    }
    // var_dump($date_of_sale);
    // exit;

        $add_query = "INSERT INTO realties 
                                    (
                                        realty_type_id,
                                        ad_type_id,   
                                        city_id,
                                        size,
                                        price,
                                        year_of_construction,
                                        description, 
                                        status
                                        $date_col
                                    )
                                    VALUES
                                    (
                                        $realty_type,
                                        $ad_type,
                                        $city_id,
                                        $size,
                                        $price,
                                        $year_of_construction,
                                        '$description',
                                        $status
                                        $date_of_sale
                                    )
        ";
    
    // var_dump($add_query);
    // exit;

mysqli_query($db, "BEGIN");

$res_add = mysqli_query($db, $add_query);

// do if the realty has been successfully added
if ($res_add) {

    // ADDING PHOTOS

    // Names of the chosen photos
    $photos_arr = $_FILES['photos']['name'];

    // Temporary path
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
            exit("You must add at least one photo of type JPG, JPEG or PNG. Please try again.");

            // header("location: index.php");
        }
        
    }

    $new_id = maxId('realties');
    // var_dump($new_id);
    // exit;
    
    // add photos one by one
    foreach ($new_photos as $photo) {
        global $new_id;
        $add_query_img = "INSERT INTO `photos`(`realty_id`, `name`)  VALUES ($new_id, '$photo')";

        // var_dump($add_query_img);
        // exit;
        $photo_add = mysqli_query($db, $add_query_img);
        // add a check of if it went well or not
        if ($photo_add) {
            continue;
        } else {
            mysqli_query($db, "ROLLBACK");
            exit("Error with photo upload");
        }
    }

    mysqli_query($db, "COMMIT");
    redirect("index.php?msg=success_realty_added");

// rollback if the realty was not successfully added 
} else {
    mysqli_query($db, "ROLLBACK");
    redirect("index.php?msg=unsuccessfully_added_realty");
}

?>