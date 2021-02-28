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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container-fluid p-0">
        <div id="header-div">
            <h1 class="main-title">Club Med Real Estate</h1>
        </div>
        <div class='blue-div d-flex align-items-center justify-content-between px-5'>
            <h1>City Register</h1>
            <div class="btn-group">
                <div class="link-div text-left px-2"><a class="btn btn-custom" href="new_realty.php">Add a New Realty</a></div>
                <div class="link-div text-left px-2"><a class="btn btn-custom" href="realty_types.php">Realty Types Register</a></div>
                <div class="link-div text-left px-2"><a class="btn btn-custom" href="cities.php">Cities Register</a></div>
            </div>
        </div>

        <div class="row px-4 mt-5">

            <div class="col-6">
                <div class="table-responsive padding-div">

                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <th>No.</th>
                            <th>City Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            while ($city = mysqli_fetch_assoc($res)) {

                                $id = $city['id'];
                                $no++;
                                $edit_city = "<a href=\"edit_city.php?id=$id\"><i class='fas fa-edit fa-lg'></a>";
                                $delete_city = "<a href=\"delete_city.php?id=$id\"><i class='fa fa-times fa-lg'></a>";

                                echo "<tr>";
                                echo "<td>" . $no . "</td>";
                                echo "<td>" . $city['name'] . "</td>";
                                echo "<td>$edit_city</td>";
                                echo "<td>$delete_city</td>";
                                echo "</tr>";
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="offset-1 col-4">
                <form action="./new_city.php" method="POST" class="padding-div form-inline mt-5">
                    <div class="form-group">
                        <label for="city">Add a New City:</label>
                    </div>
                    <div class="form-group mx-sm-3">

                        <input type="text" name="city">
                    </div>

                    <button class="btn btn-primary btn-lg">Add</button>
                    <form>

            </div>


        </div>
        <div>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>

</html>