<?php
    include 'db.php';
    include 'functions.php';


    isset($_POST['realty_type']) ? $realty_type = $_POST['realty_type'] : $realty_type = "";

    if ($realty_type != "") {
        $add_realty_type = mysqli_query($db, "INSERT INTO realty_type (name) VALUES ('$realty_type')");
        if ($add_realty_type) {
            redirect("realty_types.php?msg=realty_type_added");
        } else {
            redirect("realty_types.php?realty_type_not_added");
        }
    }

?>