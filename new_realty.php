<?php
include 'db.php';
include 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a New Realty</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container-fluid add-div p-0">
        <div id="header-div">
            <h1 class="main-title">Club Med Real Estate</h1>
        </div>
        <div class='blue-div d-flex align-items-center justify-content-between px-5'>
            <h1>Add a New Realty</h1>
            <div class="btn-group">
                <div class="link-div text-left px-2"><a class="btn btn-custom" href="new_realty.php">Add a New Realty</a></div>
                <div class="link-div text-left px-2"><a class="btn btn-custom" href="realty_types.php">Realty Types Register</a></div>
                <div class="link-div text-left px-2"><a class="btn btn-custom" href="cities.php">Cities Register</a></div>
            </div>
        </div>
        <div class="row padding-div px-5">
            <div class="col-4 mt-5">
                <form action="./new_realty_back.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="realty_type">Realty Type:</label>
                        <select name="realty_type" class="form-control" required>
                            <option value="">-- choose a realty type --</option>
                            <?php
                            selectMenu("realty_type");
                            ?>
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="ad_type">Ad Type:</label>
                        <select name="ad_type" id="" required class="form-control">
                            <option value="">-- choose the type of ad --</option>
                            <?php
                            selectMenu("ad_type");
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="city_id">City:</label>
                        <select name="city_id" required class="form-control">
                            <option value="">-- choose a city --</option>
                            <?php
                            selectMenu("cities");
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="size">Realty Size:</label>
                        <input type="number" name="size" placeholder="Enter the size" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="price">Realty Price:</label>
                        <input type="number" name="price" placeholder="Enter the price" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="year_of_construction">Year of Construction:</label>
                        <input type="number" name="year_of_construction" class="form-control" placeholder="Enter the year of construction" required>
                    </div>


            </div>
            <div class="offset-1 col-4 mt-5">
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" cols="30" rows="5" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="status">Status:</label>
                    <!-- let the user enter sale date if the property is sold, 
        otherwise the user is prevented from meddling with the date -->
                    <select id="status" name="status" onchange="addSaleDate(this)" required class="form-control">
                        <option value="">-- choose the realty status --</option>
                            <?php
                            selectMenu("status");
                            ?>
                    </select>
                </div>

                <div id="date_of_sale" style="display: none">
                    <div class="form-group">
                        <label for="date_of_sale">Date of Sale:</label>
                        <input type="date" id="date_input" name="date_of_sale" class="form-control">
                    </div>
                </div>

                <div class="form-group my-5">
                    <label for="photo">Select Images to Add:</label>
                    <input type="file" name="photos[]" multiple required class="form-control-file">
                </div>
                <button class="btn btn-primary btn-block my-5">Add</button>

            </div>
            </form>


        </div>


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

        <script src="app.js"></script>
</body>

</html>