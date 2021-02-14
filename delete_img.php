<?php
    include 'db.php';

    isset($_GET['id']) && is_numeric($_GET['id']) ? $id = $_GET['id'] : exit("Incorrect ID for photo deletion"); 
    isset($_GET['return']) && is_numeric($_GET['return']) ? $return_id = $_GET['return'] : exit("Incorrect previous pageID"); 

    // var_dump($id);
    $old_photo = mysqli_fetch_row(mysqli_query($db, "SELECT name FROM photos where id = $id"))[0];
    unlink($old_photo);

    $delete = mysqli_query($db, "DELETE FROM photos WHERE id=$id");

    if ($delete) {
        header("location: edit_realty.php?id=$return_id");
    }
?>