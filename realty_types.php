<?php

    include 'db.php';

    $res = mysqli_query($db, "SELECT * from realty_type group by name ASC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realty Types Register</title>
</head>
<body>
    <table border="1">
        <thead>
            <th>Realty Type</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody>
            <?php
            
                while($realty_type = mysqli_fetch_assoc($res)) {

                $id = $realty_type['id'];

                $edit_realty_type = "<a href=\"edit_realty_type.php?id=$id\">Edit</a>";
                $del_realty_type = "<a href=\"del_realty_type.php?id=$id\">Delete</a>";

                echo "<tr>";
                echo "<td>".$realty_type['name']."</td>";
                echo "<td>$edit_realty_type</td>";
                echo "<td>$del_realty_type</td>";
                echo "</tr>";
                
            }
            
            ?>
        </tbody>
    </table>

    <br>
    <form action="./new_realty_type.php" method="POST">
        <h3>Add a Realty Type</h3>
        <label for="realty_type">Enter New Realty Type:</label>
        <input type="text" name="realty_type">

        <button>Add</button>
    </form>
</body>
</html>