<?php

    include 'db.php';

    // $search_arr = [];
    // $search_arr[] = "1 = 1";

    // if (isset($_GET['realty_type']) && $_GET['realty_type'] != ""){
    //     $realty_type = strtolower($_GET['realty_type']);
    //     $where_arr[] = "(contacts.first_name) LIKE '%$first_name%'";
    // }  
    // if (isset($_GET['last_name']) && $_GET['last_name'] != ""){
    //     $last_name = strtolower($_GET['last_name']);
    //     $where_arr[] = "lower(contacts.last_name) LIKE '%$last_name%'";
    // }
    // if (isset($_GET['phone1']) && $_GET['phone1'] != ""){
    //     $phone1 = strtolower($_GET['phone1']);
    //     $where_arr[] = "lower(contacts.phone1) LIKE '%$phone1%'";
    // }  
    // if (isset($_GET['phone2']) && $_GET['phone2'] != ""){
    //     $phone2 = strtolower($_GET['phone2']);
    //     $where_arr[] = "lower(contacts.phone2) LIKE '%$phone2%'";
    // }
    // if (isset($_GET['address']) && $_GET['address'] != ""){
    //     $address = strtolower($_GET['address']);
    //     $where_arr[] = "lower(contacts.address) LIKE '%$address%'";
    // }
    // if (isset($_GET['email']) && $_GET['email'] != ""){
    //     $email = strtolower($_GET['email']);
    //     $where_arr[] = "lower(contacts.email) LIKE '%$email%'";
    // }

    // $where_str = implode(" AND ", $where_arr);
    // $sql = "SELECT contacts.*, cities.name as city_name FROM contacts LEFT JOIN cities on cities.id = contacts.city_id WHERE $where_str ORDER BY contacts.first_name ASC";

    // $res = mysqli_query($dbconn, $sql);
    // $cnt = mysqli_num_rows($res);


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

    <!-- SEARCH -->
    <form action="./index.php" method="GET">
        <input type="text" name="realty_type" placeholder="Enter first name"> 
        <input type="text" name="ad_type" placeholder="Enter last name"> 
        <input type="text" name="city" placeholder="Enter phone 1"> 
        <input type="text" name="min_size" placeholder="Enter phone 2">
        <input type="text" name="max_size" placeholder="Enter phone 2"> 
        <input type="text" name="construction_year" placeholder="Enter address"> 
        <input type="text" name="status" placeholder="Enter email">
        <button>Search</button>
    </form>

    <br>
    <br>
    
    <!-- TABLE DATA -->
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
    <a href="new_realty.php">Add a New Realty</a>

    <br>
    <br>
    <a href="realty_types.php">Realty Types</a>

    <br>
    <br>
    <a href="cities.php">Cities</a>
</body>
</html>