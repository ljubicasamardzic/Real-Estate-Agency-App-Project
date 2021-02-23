<?php

    include 'db.php';

    include 'functions.php';

    isset($_POST['id']) && is_numeric($_POST['id']) ? $id = $_POST['id'] : exit('ID not available.');
    isset($_POST['city']) ? $city = $_POST['city'] : exit('City not available.');

    $update_query = mysqli_query($db, "UPDATE cities SET name = '$city' WHERE id = $id");

    if ($update_query) {
        redirect("cities.php?msg=city_updated");
    } else {
        redirect("cities.php?msg=city_not_updated");
    }

?>