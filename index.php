<?php

    include 'db.php';

    $query = "SELECT realties.*, 
                cities.name as city,
                ad_type.name as ad_type, 
                realty_type.name as realty_type
                FROM realties 
                JOIN cities on realties.city_id = cities.id 
                JOIN ad_type on ad_type.id = realties.ad_type_id
                JOIN realty_type on realties.realty_type_id = realty_type.id
                WHERE realties.ad_type_id = ad_type.id 
                AND realties.realty_type_id = realty_type.id";
    $res = mysqli_query($db, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Med Real Estate</title>
</head>
<body>

    <table border="1">
        <thead>
            <tr>
                <th>Realty Type</th>
                <th>Action</th>
                <th>City</th>
                <th>Size</th>
                <th>Price</th>
                <th>Construction Year</th>
                <th>Description</th>
                <th>Status</th>
                <th>Date of Sale</th>
                <th>Details</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($row = mysqli_fetch_assoc($res)) {
                    // var_dump($row);
                    // echo "<br>";
                    // echo "<br>";

                    $id = $row['id'];

                    if ($row["status"] == "0") {
                        $status = "available";
                    } else {
                        $status = "not available";
                    }
                    
                    $show_realty = "<a href=\"realty.php?id=$id\">Details</a>";
                    $edit_realty = "<a href=\"edit_realty.php?id=$id\">Edit</a>";
                    $delete_realty = "<a href=\"delete_realty.php?id=$id\">Delete</a>";

                    echo "<tr>";
                    echo "<td>".$row["realty_type"]."</td>";
                    echo "<td>".$row["ad_type"]."</td>";
                    echo "<td>".$row["city"]."</td>";
                    echo "<td>".$row["size"]."</td>";
                    echo "<td>".$row["price"]."</td>";
                    echo "<td>".$row["year_of_construction"]."</td>";
                    echo "<td>".$row["description"]."</td>";
                    echo "<td>".$status."</td>";
                    echo "<td>".$row["date_of_sale"]."</td>";
                    echo "<td>$show_realty</td>";
                    echo "<td>$edit_realty</td>";
                    echo "<td>$delete_realty</td>";
                    echo "</tr>";
                    
                }
                
            ?>
            </tr>
        </tbody>
    </table>
    <!-- To be revised in a later version -->
    <br>
    <br>
    <a href="cities.php">Cities</a>
</body>
</html>