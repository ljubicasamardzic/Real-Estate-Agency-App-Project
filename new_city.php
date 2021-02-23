<?php
    include 'db.php';
    include 'functions.php';

    isset($_POST['city']) ? $city = $_POST['city'] : $city = "";

    if ($city != "") {
        $add_city = mysqli_query($db, "INSERT INTO cities (name) VALUES ('$city')");
        if ($add_city) {
            redirect("cities.php?msg=city_added");
        } else {
            redirect("cities.php?city_not_added");
        }
    }

?>