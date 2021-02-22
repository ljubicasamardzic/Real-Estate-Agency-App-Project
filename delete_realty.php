<?php

    include 'db.php';
    include 'functions.php';

    isset($_GET['id']) && is_numeric($_GET['id']) ? $id = $_GET['id'] : exit("ID error");
    
    mysqli_query($db, "BEGIN");

    // delete related photos
    $del_img = mysqli_query($db, "DELETE FROM photos WHERE realty_id = $id");

    if ($del_img) {

        // if photos are deleted, delete the realty
        $del_realty = mysqli_query($db, "DELETE FROM realties WHERE id = $id");

        if ($del_realty) {
            mysqli_query($db, "COMMIT");
            redirect("index.php?msg=realty_deleted");  
        } else {
            mysqli_query($db, "ROLLBACK");
            redirect("index.php?msg=realty_not_deleted");   
        }
    } else {
        mysqli_query($db, "ROLLBACK");
        redirect("index.php?msg=realty_not_deleted");   
    }


?>
