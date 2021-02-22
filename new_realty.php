<?php 
    include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a New Realty</title>
    <!-- <link rel="stylesheet" href="./all.css"> -->
    <link rel="stylesheet" href="./styles.css">
 
</head>
<body>

    <br>
    <br>

    <form action="./new_realty_back.php" method="POST" enctype="multipart/form-data">
        <label for="realty_type">Realty Type:</label>
        <select name="realty_type" required>
            <option value="">-- choose a realty type --</option>
            <?php 
                $realty_types = mysqli_query($db, "SELECT * FROM realty_type ORDER BY name");
                // currenty chosen realty 
                $realty_type_id = $realty['realty_type_id'];
                while($realty_type = mysqli_fetch_assoc($realty_types)) {
                    $realty_type_id_temp = $realty_type['id'];
                    $realty_type_name_temp = $realty_type['name'];

                    echo "<option value='$realty_type_id_temp'>$realty_type_name_temp</option>";
                }
            ?>
            </option>
        </select>

        <br>
        <br>

        <label for="ad_type">Ad Type:</label>
        <select name="ad_type" id="" required>
            <option value="">-- choose the type of ad --</option>
            <?php
                $ad_types = mysqli_query($db, "SELECT * FROM ad_type ORDER BY name");
                // the id of the currently chosen ad type
                $ad_type_id = $realty['ad_type_id'];
                while ($ad_type = mysqli_fetch_assoc($ad_types)) {
                    $ad_type_id_temp = $ad_type['id'];
                    $ad_type_name_temp = $ad_type['name'];
    
                    echo "<option value='$ad_type_id_temp'>$ad_type_name_temp</option>";
                }
            ?>
        </select>

        <br>
        <br>

        <label for="city_id">City:</label>
        <select name="city_id" required>
            <option value="">-- choose a city --</option>
            <?php 
                $cities = mysqli_query($db, "SELECT * from cities ORDER BY name"); 
                // currenty chosen city 
                $city_id = $realty['city_id'];
                while ($city = mysqli_fetch_assoc($cities)) {
                    $id_temp = $city['id'];
                    $name_temp = $city['name'];
        
                    echo "<option value='$id_temp'>$name_temp</option>";
                }
            ?>
        </select>

        <br>
        <br>

        <label for="size">Realty Size:</label>
        <input type="number" name="size" placeholder="Enter the size" required> 

        <br>
        <br>

        <label for="price">Realty Price:</label>
        <input type="number" name="price" placeholder="Enter the price" required> 

        <br>
        <br>

        <label for="year_of_construction">Year of Construction:</label>
        <input type="number" name="year_of_construction" placeholder="Enter the year of construction" required> 
        
        <br>
        <br>

        <label for="description">Description:</label>
        <br>
        <textarea name="description" cols="30" rows="10"></textarea>
        <br>
        <br>

        <label for="status">Status:</label>
        <!-- mechanism to let the user enter sale date if the property is sold, 
        otherwise the user is prevented from meddling with the date -->
        <select id="status" name="status" onchange="addSaleDate(this)">
            <option value="">-- choose the realty status --</option>
            <option value=0>Available</option>
            <option value=1>Not available</option>         
        </select>
        
        <div id="date_of_sale" style="display: none">
        <br>
        
        <label for="date_of_sale">Date of Sale:</label>
        <input type="date" id="date_input" name="date_of_sale">
        </div>

        <br>
        <br>
        
        <label for="photo">Select Images to Add:</label>
        <input type="file" name="photos[]" multiple required>        

        <br>
        <br>

        <button>Add</button>
    </form>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js"></script>
    <script src="app.js"></script>
</body>
</html>