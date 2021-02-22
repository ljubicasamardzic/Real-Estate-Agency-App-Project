<?php

    include 'db.php';

    isset($_GET['id']) && is_numeric($_GET['id']) ? $id = $_GET['id'] : exit("Incorrect ID"); 
    $query = "SELECT realties.*,
                cities.name as city, 
                ad_type.name as ad_type, 
                realty_type.name as realty_type 
                FROM realties
                JOIN cities on realties.city_id = cities.id
                JOIN ad_type on ad_type.id = realties.ad_type_id 
                JOIN realty_type on realties.realty_type_id = realty_type.id 
                WHERE realties.id = $id 
                AND realties.ad_type_id = ad_type.id 
                AND realties.realty_type_id = realty_type.id";
    
    $res = mysqli_query($db, $query);
    $cnt = mysqli_num_rows($res);

    if ($cnt == 0) {
        exit("No data for ID: ".$id);
    }

    $realty = mysqli_fetch_assoc($res);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realty</title>
</head>
<body>
    <?php
        if ($realty["status"] == "0") {
            $status = "available";
        } else {
            $status = "not available";
        }
        if ($realty['date_of_sale'] == "") {
            $realty['date_of_sale'] = "N/A";
        }
    ?>
    <p>Realty Type: <?=$realty['realty_type']?></p>
    <p>Action: <?=$realty['ad_type']?></p>
    <p>City: <?=$realty['city']?></p>
    <p>Size: <?=$realty['size']?></p>
    <p>Price: <?=$realty['price']?></p>
    <p>Construction Year: <?=$realty['year_of_construction']?></p>
    <p>Description: <?=$realty['description']?></p>
    <p>Status: <?=$status?></p>
    <p>Date of Sale: <?=$realty['date_of_sale']?></p>

    <!-- Another query to get all the photos using the id we now have -->
    <?php
        $query2 = "SELECT name FROM photos WHERE realty_id = $id";
        $res2 = mysqli_query($db, $query2);

        // List out all the photos
        while ($photo = mysqli_fetch_assoc($res2)) {
            $photo_name = $photo['name'];
            echo "<td><img src=$photo_name height=100 width=150></td>";
        }
    ?>
    
</body>
</html>