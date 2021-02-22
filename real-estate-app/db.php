<?php

    $db = mysqli_connect("localhost", "root", "", "real-estate-db");

    if (mysqli_connect_errno()) {
        echo '<p>Error: Could not connect to database.<br/>
        Please try again later.</p>';
        exit;
    }

?>