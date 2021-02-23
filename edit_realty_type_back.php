<?php

    include 'db.php';

    include 'functions.php';

    isset($_POST['id']) && is_numeric($_POST['id']) ? $id = $_POST['id'] : exit('ID not available.');
    isset($_POST['realty_type']) ? $realty_type = $_POST['realty_type'] : exit('Realty_type not available.');

    $update_query = mysqli_query($db, "UPDATE realty_type SET name = '$realty_type' WHERE id = $id");

    if ($update_query) {
        redirect("realty_types.php?msg=realty_type_updated");
    } else {
        redirect("realty_types.php?msg=realty_type_not_updated");
    }

?>