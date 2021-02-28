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
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">
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

                // List out all the photos
                while ($photo = mysqli_fetch_assoc($res2)) {
                    $photo_name = $photo['name'];
                    echo "<td><img src=$photo_name data-toggle='modal' data-target='#myModal' height=150 width=250 class='mr-3 mb-3'></td>";
                }
                ?>
            </div>
        </div>
    </div>
  


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
     
$('#myModal').on('show.bs.modal', function (event) {
  // Element that triggered the modal
  var liEl = $(event.relatedTarget); 
  
   // Extract info from data-* attributes, and from the element itself.
//   var recipient = liEl.data('whatever');
//   var textContent = liEl.text();
  
  // If necessary, you could initiate an AJAX request here
  //   (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could
  //   use a data binding library or other methods instead.
  var modal = $(this);
  
  // Update the dynamic portions of the modal dialog.
//   modal.find('.modal-title').text('New message to ' + recipient);
//   modal.find('.modal-body img').text(textContent);
});
</script>
</body>

</html>