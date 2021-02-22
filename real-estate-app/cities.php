<?php

    include 'db.php';

    $query = "SELECT * from cities group by name ASC";
    $res = mysqli_query($db, $query);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cities Register</title>
</head>
<body>
    <table border="1">
        <thead>
            <th>City Name</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody>
            <?php
            
                while($city = mysqli_fetch_assoc($res)) {

                $id = $city['id'];

                $edit_city = "<a href=\"edit_city.php?id=$id\">Edit</a>";
                $delete_city = "<a href=\"delete_city.php?id=$id\">Delete</a>";

                echo "<tr>";
                echo "<td>".$city['name']."</td>";
                echo "<td>$edit_city</td>";
                echo "<td>$delete_city</td>";
                echo "</tr>";
                
            }
            
            ?>
        </tbody>
    </table>

    <br>
    <a href="new_city.php">Add a new city</a>
</body>
</html>