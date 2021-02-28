<?php
    include 'db.php';
    include 'functions.php';

    $values = [];

    $values['realty_type_id'] = validate($_POST, 'realty_type', true, true, "", "index.php?msg=not_added_err1");
    $values['ad_type_id'] = validate($_POST, 'ad_type', true, true, "", "index.php?msg=not_added_err2");
    $values['city_id'] = validate($_POST, 'city_id', true, true, "", "index.php?msg=not_added_err3");
    $values['size'] = validate($_POST, 'size', true, true, "", "index.php?msg=not_added_err4");
    $values['price'] = validate($_POST, 'price', true, true, "", "index.php?msg=not_added_err5");
    $values['year_of_construction'] = validate($_POST, 'year_of_construction', true, true, "", "index.php?msg=not_added_err6");
    $values['description'] = validate($_POST, 'description', false, false, "", "index.php?msg=not_added_err7");
    $values['status'] = validate($_POST, 'status', true, true, "", "index.php?msg=not_added_err8");

    // if the status is available, date of sale is automatically set to null
    // else it takes the relevant value from the post array 

    if ($values['status'] == 1) {
        $date_of_sale = "";
        $date_col = ""; 
    }  else {
        $values['date_of_sale'] = $_POST['date_of_sale'];
    }

mysqli_query($db, "BEGIN");

$res_add = insert("realties", $values);

// do if the realty has been successfully added
if ($res_add) {

    // ADDING PHOTOS

    // check if the file extension is appropriate 
    if (checkPhotoType('photos')) {
        $new_photos = checkPhotoType('photos');
    } else {
        mysqli_query($db, "ROLLBACK");
        redirect("index.php?msg=wrong_file_format_1");
    }
   
    // find the latest realty id
    $new_id = maxId('realties');
  
    // add photos one by one
    foreach ($new_photos as $photo) {
       
        $photo_add = insert("photos", ['realty_id' => $new_id, 'name' => $photo]);

        // rollback in case of error
        if (!$photo_add) {
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