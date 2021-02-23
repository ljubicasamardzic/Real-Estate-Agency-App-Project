<?php

    include 'db.php';
    include 'functions.php';

    isset($_GET['id']) && is_numeric($_GET['id']) ? $id = $_GET['id'] : exit("ID error");

    $delete_city = mysqli_query($db, "DELETE FROM cities WHERE id = $id");

    if ($delete_city) {
        redirect("cities.php?msg=city_deleted");
    } else {
        redirect("cities.php?msg=city_not_deleted");
    }

?>