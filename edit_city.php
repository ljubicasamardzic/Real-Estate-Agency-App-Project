<?php
    include 'db.php';

    isset($_GET['id']) && is_numeric($_GET['id']) ? $id = $_GET['id'] : exit("Incorrect ID"); 

    $city = mysqli_fetch_assoc(mysqli_query($db, "SELECT * from cities WHERE id = $id"));


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit a City</title>
</head>
<body>
    <form method="POST" action="edit_city_back.php">
    <input type="hidden" name="id" value=<?=$id?>>
        <label for="city">Edit the City Name:</label>
        <input type="text" name="city" value="<?=$city['name']?>">
        <button>Update</button>
    </form>
</body>
</html>