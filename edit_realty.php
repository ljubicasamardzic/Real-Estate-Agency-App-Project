<?php
include 'db.php';
include 'functions.php';

$id = validate($_GET, 'id', true, true, "", "index.php?not_successfully_edited");

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

$realty = mysqli_fetch_assoc($res);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">

</head>

<body>

    <div class="container-fluid px-0">
        <div id="header-div">
            <h1 class="main-title">Club Med Real Estate</h1>
        </div>
        <div class='blue-div d-flex align-items-center justify-content-between px-5'>
            <h1>Edit a Realty</h1>

            <div class="btn-group">
                <div class="link-div text-left px-2"><a class="btn btn-custom" href="new_realty.php">Add a New Realty</a></div>
                <div class="link-div text-left px-2"><a class="btn btn-custom" href="realty_types.php">Realty Types Register</a></div>
                <div class="link-div text-left px-2"><a class="btn btn-custom" href="cities.php">Cities Register</a></div>
            </div>
        </div>
        <div class="row px-5">
            <div class="col-4 mt-5">
                <form action="./edit_realty_back.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <label for="realty_type">Realty Type:</label>
                        <select name="realty_type" class="form-control">
                            <option value="">-- choose a realty type --</option>
                            <?php
                            $realty_type_id = $realty['realty_type_id'];

                            selectMenu("realty_type", $realty_type_id);
                            ?>
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="ad_type">Ad Type:</label>
                        <select name="ad_type" class="form-control">
                            <option value="">-- choose the type of ad --</option>
                            <?php
                            $ad_type_id = $realty['ad_type_id'];

                            selectMenu("ad_type", $ad_type_id);
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="city_id">City:</label>
                        <select name="city_id" class="form-control">
                            <option value="">-- choose a city --</option>
                            <?php
                            $city_id = $realty['city_id'];

                            selectMenu("cities", $city_id);
                            ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="size">Realty Size (m2):</label>
                        <input type="number" name="size" placeholder="Enter the size" class="form-control" value="<?= $realty['size'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="price">Realty Price (in euros):</label>
                        <input type="number" name="price" class="form-control" placeholder="Enter the price" value="<?= $realty['price'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="year_of_construction">Year of Construction:</label>
                        <input type="number" name="year_of_construction" class="form-control" placeholder="Enter the year of construction" value="<?= $realty['year_of_construction'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" class="form-control" id="" cols="30" rows="5"><?= $realty['description'] ?></textarea>
                    </div>
            </div>

            <div class="offset-1 col-5 mt-4">

                <div class="form-group">
                    <label for="status">Status:</label>
                    <select name="status" onchange="addSaleDate(this)" class="form-control">
                        <?php
                        $status = $realty['status'];

                        selectMenu("status", $status);
                        ?>
                    </select>
                </div>

                <?php
                    $date = $realty['date_of_sale'];

                    $status == 2 ? $display = "block" : $display = "none";

                    echo "<div id=\"date_of_sale\" class='form-group' style=\"display: $display;\">";
                    echo "<label for=\"date_of_sale\">Date of Sale: </label>";
                    echo "<input type=\"date\" name=\"date_of_sale\" class=\"form-control\" value=$date>";
                    echo "</div>";
                ?>

                <?php
                    $res2 = mysqli_query($db, "SELECT * FROM photos WHERE realty_id = $id");

                    echo "<input type=\"hidden\" name=\"del_photos\" id=\"hidden_img\">";
                    echo "<p>Select Images to Delete:</p>";

                    echo "<div class='container-fluid'>";
                    echo "<div class='row'>";
                    // List out all the photos
                    while ($photo = mysqli_fetch_assoc($res2)) {
                        $photo_name = $photo['name'];
                        $photo_id = $photo['id'];
                        echo "<div class=\"img-wrapper mr-3 mb-5\" style='display: block'>";
                        echo "<img src=$photo_name height=150 width=200 id=$photo_id>";
                        echo "<a>";
                        echo "<div>";
                        echo "<i onClick=\"removePhotos($photo_id)\" class=\"fas fa-times fa-lg\"></i>";
                        echo "</div>";
                        echo "</a>";
                        echo "</div>";
                    }
                    echo "</div>";
                    echo "</div>";

                ?>
                
                <div class="form-group mb-5" style="display: block;">
                    <label for="photos">Select Images to Add:</label>
                    <input type="file" name="photos[]" multiple class="form-control-file">
                </div>

                <button class="btn btn-primary btn-block mb-5">Update</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script src="app.js"></script>
</body>

</html>