<?php
include 'db.php';

isset($_GET['id']) && is_numeric($_GET['id']) ? $id = $_GET['id'] : exit("Incorrect ID");

$realty_type = mysqli_fetch_assoc(mysqli_query($db, "SELECT * from realty_type WHERE id = $id"));

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit a Realty Type</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
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
                <form method="POST" action="edit_realty_type_back.php" class="form-inline">
                    <div class="form-group">
                        <div class="form-group mb-2">
                            <input type="hidden" name="id" value=<?= $id ?>>
                            <label for="realty_type">Edit the Realty Type:</label>
                        </div>
                        <div class="form-group mx-sm-3">
                            <input type="text" name="realty_type" value="<?= $realty_type['name'] ?>" class="form-control">
                        </div>
                    </div>
                    <button class="btn btn-primary">Update</button>
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