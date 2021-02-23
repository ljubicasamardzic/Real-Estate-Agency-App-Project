<?php

    include 'db.php';

    $res = mysqli_query($db, "SELECT * from cities group by name ASC");

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
    <form action="./new_city.php" method="POST">
        <h3>Add a New City</h3>
        <label for="city">Enter City Name:</label>
        <input type="text" name="city">

        <button>Add</button>
    <form>
</body>
</html>