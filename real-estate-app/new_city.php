<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a New City</title>
    <!-- <link rel="stylesheet" href="./all.css"> -->
    <link rel="stylesheet" href="./styles.css">
 
</head>
<body>

    <br>
    <br>

    <form action="./new_city_back.php" method="POST" enctype="multipart/form-data">
        <label for="city">Enter City Name:</label>
        <input type="text" name="city">

        <button>Add</button>
    </form>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js"></script>
    <script src="app.js"></script>
</body>
</html>