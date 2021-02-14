<?php

    include 'db.php';

    isset($_GET['id']) && is_numeric($_GET['id']) ? $id = $_GET['id'] : exit("ID error");

    $query = "DELETE FROM realties WHERE id = $id";
    $res = mysqli_query($db, $query);

    $query2 = "DELETE FROM photos WHERE realty.id = $id";
    $res2 = mysqli_query($db, $res);

    if ($res && $res2) {
        header("location: index.php?msg=realty_deleted");  
    } else {
        header("location: index.php?msg=realty_not_deleted");   
    }

?>
