<?php

    include 'db.php';
    include 'functions.php';

    if ($_SERVER['REQUEST_METHOD'] == "GET") {

        isset($_GET['id']) && is_numeric($_GET['id']) ? $id = $_GET['id'] : exit("ID error");

        $del_realty_type = mysqli_query($db, "DELETE FROM realty_type WHERE id = $id");

        if ($del_realty_type) {
            redirect("realty_types.php?msg=realty_type_deleted");
        } else {
            redirect("realty_types.php?msg=realty_type_not_deleted");
        }
    } else {
        redirect("realty_types.php?msg=wrong_request_type");
    }
?>