<?php

include 'db.php';
include 'functions.php';

$id = validate($_GET, 'id', true, true, "", "index.php?msg=incorrect_id");

$query = "SELECT realties.*,
                cities.name as city, 
                ad_type.name as ad_type, 
                realty_type.name as realty_type,
                status.name as status 
                FROM realties
                JOIN cities on realties.city_id = cities.id
                JOIN ad_type on ad_type.id = realties.ad_type_id 
                JOIN realty_type on realties.realty_type_id = realty_type.id
                JOIN status on realties.status = status.id 
                WHERE realties.id = $id";

$res = mysqli_query($db, $query);

$realty = mysqli_fetch_assoc($res);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realty</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container-fluid px-0">
        <div id="header-div">
            <h1 class="main-title">Club Med Real Estate</h1>
        </div>
        <div class='blue-div d-flex align-items-center justify-content-between px-5'>
            <h1>Realty Information</h1>
            <div class="btn-group">
                <div class="link-div text-left px-2"><a class="btn btn-custom" href="new_realty.php">Add a New Realty</a></div>
                <div class="link-div text-left px-2"><a class="btn btn-custom" href="realty_types.php">Realty Types Register</a></div>
                <div class="link-div text-left px-2"><a class="btn btn-custom" href="cities.php">Cities Register</a></div>
            </div>
        </div>
        <div class="row">
        <div class="col-6 px-5">
            <?php
                if ($realty['date_of_sale'] == "") {
                    $realty['date_of_sale'] = "N/A";
                }
            ?>
            <div>
                <h2 class="mt-5">Basic Information</h2>
                <table class="table mt-3">
                    <tbody>
                        <tr>
                            <td>Realty Type</td>
                            <th><?= $realty['realty_type'] ?></th>
                        </tr>
                        <tr>
                            <td>Action</td>
                            <th><?= $realty['ad_type'] ?></th>
                        </tr>
                        <tr>
                            <td>City</td>
                            <th><?= $realty['city'] ?></th>
                        </tr>
                        <tr>
                            <td>Size</td>
                            <th><?= $realty['size'] ?></th>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <th><?= $realty['price'] ?></th>
                        </tr>
                        <tr>
                            <td>Construction Year</td>
                            <th><?= $realty['year_of_construction'] ?></th>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <th><?= $realty['description'] ?></th>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <th><?= $realty['status'] ?></th>
                        </tr>
                        <tr>
                            <td>Date of Sale</td>
                            <th><?= $realty['date_of_sale'] ?></th>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

        <div class="col-6 mt-5" id="gallery" data-toggle="modal" data-target="#galleryModal">
            <!-- Another query to get all the photos using the id we now have -->
            <?php
            $query2 = "SELECT name FROM photos WHERE realty_id = $id";
            $res2 = mysqli_query($db, $query2);

            $num = 0;
            // List out all the photos
            while ($photo = mysqli_fetch_assoc($res2)) {
                $num++;
                $photo_name = $photo['name'];
                echo "<td><img src=$photo_name height=150 width=250 class='mr-3 mb-3' data-target='#carouselItem' data-slide-to=$num></td>";
            }
            ?>
        </div>
        </div>
    </div>

<!-- MODAL -->
<div class="modal fade" id="galleryModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        
      <div id="carouselItem" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">

            <?php
                // List out all the photos
                while ($photo = mysqli_fetch_assoc($res2)) {
                    $photo_name = $photo['name'];
                    echo "<div class='carousel-item active'><img class='d-block w-100' src=$photo_name></div>";
                }
            ?>

          </div>
          <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>

</html>