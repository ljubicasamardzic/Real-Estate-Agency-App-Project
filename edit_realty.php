<?php
    include 'db.php';
    include 'functions.php';

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
    // var_dump($realty);

    // $id = $realty['id'];

    if ($realty["status"] == "0") {
        $status = "available";
    } else {
        $status = "not available";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <!-- <link rel="stylesheet" href="./all.css"> -->
    <link rel="stylesheet" href="./styles.css">
 
</head>
<body>

    <br>
    <br>

    <form action="./edit_realty_back.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$id?>">
        <label for="realty_type">Realty Type:</label>
        <select name="realty_type">
            <option value="">-- choose a realty type --</option>
            <?php 
                $realty_type_id = $realty['realty_type_id'];

                selectMenu("realty_type", $realty_type_id);
            ?>
            </option>
        </select>

        <br>
        <br>

        <label for="ad_type">Ad Type:</label>
        <select name="ad_type" id="">
            <option value="">-- choose the type of ad --</option>
            <?php
                $ad_type_id = $realty['ad_type_id'];

                selectMenu("ad_type", $ad_type_id);
            ?>
        </select>

        <br>
        <br>

        <label for="city_id">City:</label>
        <select name="city_id" required>
            <option value="">-- choose a city --</option>
            <?php 
                $city_id = $realty['city_id'];
                
                selectMenu("cities", $city_id);
            ?>
        </select>

        <br>
        <br>

        <label for="size">Realty Size:</label>
        <input type="number" name="size" placeholder="Enter the size" value="<?=$realty['size']?>"> 

        <br>
        <br>

        <label for="price">Realty Price:</label>
        <input type="number" name="price" placeholder="Enter the price" value="<?=$realty['price']?>"> 

        <br>
        <br>

        <label for="year_of_construction">Year of Construction:</label>
        <input type="number" name="year_of_construction" placeholder="Enter the year of construction" value="<?=$realty['year_of_construction']?>"> 
        
        <br>
        <br>

        <label for="description">Description:</label>
        <br>
        <textarea name="description" id="" cols="30" rows="10"><?=$realty['description']?></textarea>
        <br>
        <br>

        <label for="status">Status:</label>
        <select name="status" onchange="addSaleDate(this)">
            <?php 
                $status = $realty['status'];

                if ($status == 0) {
                    $selected = "selected";
                } else {
                    $selected = "";
                }
                if ($status == 1) {
                    $selected1 = "selected";
                } else {
                    $selected1 = "";
                }

                echo "<option value=0 $selected>Available</option>";
                echo "<option value=1 $selected1>Not available</option>";         
                
            ?>
        </select>
        <br>
        <br>
        
        <?php
        
            $date = $realty['date_of_sale'];
            $display;
            
            $status == 1 ? $display = "block" : $display = "none";

            echo "<div id=\"date_of_sale\" style=\"display: <?=$display?>;\">";
            echo "<label for=\"date_of_sale\">Date of Sale:</label>";
            echo "<input type=\"date\" name=\"date_of_sale\" value=$date>";
            echo "</div>";

        ?>
        
        <br>
        <br>
        
        <label for="photo">Select Images to Add:</label>
        <input type="file" name="photos[]" multiple>        

        <br>
        <br>
        <?php
            $query2 = "SELECT * FROM photos WHERE realty_id = $id";
            $res2 = mysqli_query($db, $query2);

            echo "<input type=\"hidden\" name=\"del_photos[]\" id=\"hidden_img\">";

            // List out all the photos
            while ($photo = mysqli_fetch_assoc($res2)) {
                $photo_name = $photo['name'];
                $photo_id = $photo['id'];
                
                echo "<div class=\"img-wrapper\">";
                    echo "<img src=$photo_name height=100 width=150>";
                        echo "<a>";
                            echo "<div>";
                                echo "<i onClick=\"removePhotos($photo_id)\" class=\"fas fa-trash\"></i>";
                            echo "</div>";
                        echo "</a>";
                echo "</div>";
            }
        ?>

        <button>Update</button>
    </form>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js"></script>
    <script src="app.js"></script>
</body>
</html>