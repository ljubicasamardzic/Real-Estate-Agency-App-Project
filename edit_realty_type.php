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
</head>
<body>
    <form method="POST" action="edit_realty_type_back.php">
    <input type="hidden" name="id" value=<?=$id?>>
        <label for="realty_type">Edit the Realty Type:</label>
        <input type="text" name="realty_type" value="<?=$realty_type['name']?>">
        <button>Update</button>
    </form>
</body>
</html>