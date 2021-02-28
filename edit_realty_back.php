<?php
    include 'db.php';
    include 'functions.php';

    $values = [];

    $id = validate($_POST, 'id', true, true, "", "index.php?msg=no_id");

    $values['realty_type_id'] = validate($_POST, 'realty_type', true, true, "", "index.php?edit_err1");
    $values['ad_type_id'] = validate($_POST, 'ad_type', true, true, "", "index.php?edit_err2");
    $values['city_id'] = validate($_POST, 'city_id', true, true, "", "index.php?edit_err3");
    $values['size'] = validate($_POST, 'size', true, true, "", "index.php?edit_err4");
    $values['price'] = validate($_POST, 'price', true, true, "", "index.php?edit_err5");
    $values['year_of_construction'] = validate($_POST, 'year_of_construction', true, true, "", "index.php?edit_err6");
    $values['description'] = validate($_POST, 'description', false, false, "", "index.php?edit_err7");
    $values['status'] = validate($_POST, 'status', true, true, "", "index.php?edit_err8");
    
    if ($values['status'] == 1) {
        $date_of_sale = null;
     } else {
        $date_of_sale = validate($_POST, 'date_of_sale', false, false, "", "index.php?edit_err9");
     }

    mysqli_query($db, "BEGIN");

    // CASE 1: PHOTOS ARE DELETED AND NEW ADDED 
    if (($_POST['del_photos']) != "" && $_FILES['photos']['name'][0] != "") {
        
        // DEAL WITH DELETED PHOTOS
        if (!deletePhotos('del_photos')) {       
            mysqli_query($db, "ROLLBACK");
            redirect("index.php?msg=err_edit_1");
        }

        // DEAL WITH NEWLY ADDED PHOTOS
        if (checkPhotoType('photos')) {
            $new_photos = checkPhotoType('photos');
        } else {
            mysqli_query($db, "ROLLBACK");
            redirect("index.php?msg=wrong_file_format_1");
        }
    
        foreach ($new_photos as $photo) {
            $photo_update = insert("photos", ['realty_id' => $id, 'name' => $photo]);
            if (!$photo_update) {
                mysqli_query($db, "ROLLBACK");
                redirect("index.php?msg=photo_not_updated1");
            }
        }
        
        // UPDATE OTHER PARAMETERS
        $res_update = update('realties', $values, $id, $date_of_sale);

        if ($res_update) { 
            mysqli_query($db, "COMMIT"); 
            redirect("index.php?msg=realty_updated");
        } else {
            mysqli_query($db, "ROLLBACK");
            redirect("index.php?msg=realty_not_updated");
        }

        // CASE 2: SOME PHOTOS ARE DELETED, BUT NO NEW ADDED 
    } else if (($_POST['del_photos']) != "" && $_FILES['photos']['name'][0] == "") {

        if (!deletePhotos('del_photos')) {       
            mysqli_query($db, "ROLLBACK");
            redirect("index.php?msg=err_edit_1");
        } 

         // UPDATE OTHER PARAMETERS
         $res_update = update('realties', $values, $id, $date_of_sale);

        if ($res_update) { 
            mysqli_query($db, "COMMIT"); 
            redirect("index.php?msg=realty_updated");
        } else {
            mysqli_query($db, "ROLLBACK");
            redirect("index.php?msg=realty_not_updated");
        }
        // CASE 3: NEW PHOTOS ARE ADDED, OLD ONES ARE NOT DELETED
    } else if (($_POST['del_photos']) == "" && $_FILES['photos']['name'][0] != "") {

             // DEAL WITH NEWLY ADDED PHOTOS
             if (checkPhotoType('photos')) {
                $new_photos = checkPhotoType('photos');
            } else {
                mysqli_query($db, "ROLLBACK");
                redirect("index.php?msg=wrong_file_2");
            }
        
            foreach ($new_photos as $photo) {
                $photo_update = insert("photos", ['realty_id' => $id, 'name' => $photo]);
                if (!$photo_update) {
                    mysqli_query($db, "ROLLBACK");
                    redirect("index.php?msg=photo_not_updated2");
                }
            }

            // UPDATE OTHER PARAMETERS
            $res_update = update('realties', $values, $id, $date_of_sale);
    
            if ($res_update) { 
                mysqli_query($db, "COMMIT"); 
                redirect("index.php?msg=realty_updated");
            } else {
                mysqli_query($db, "ROLLBACK");
                redirect("index.php?msg=realty_not_updated");
            }
        // CASE 4: NO PHOTOS ARE ADDED OR DELETED
    } else if (($_POST['del_photos']) == "" && $_FILES['photos']['name'][0] == "") {

        $res_update = update('realties', $values, $id, $date_of_sale);

        if ($res_update) { 
            mysqli_query($db, "COMMIT"); 
            redirect("index.php?msg=realty_updated");
        } else {
            mysqli_query($db, "ROLLBACK");
            redirect("index.php?msg=realty_not_updated");
        }


    }

?>