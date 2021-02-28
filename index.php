<?php

include 'db.php';
include 'functions.php';

$search_arr = ["realties.ad_type_id = ad_type.id", "realties.realty_type_id = realty_type.id"];

include 'filters.php';

// track the page number
(isset($_GET['pageno'])) ? $pageno = $_GET['pageno'] : $pageno = 1;

// define how many records to show per page and adjust offset
$num_of_realties_per_page = 8;
$offset = ($pageno - 1) * $num_of_realties_per_page;

// first check how many records and how many pages there will be
$total_records = "SELECT COUNT(*)
                        FROM realties 
                        JOIN cities on realties.city_id = cities.id 
                        JOIN ad_type on ad_type.id = realties.ad_type_id
                        JOIN realty_type on realties.realty_type_id = realty_type.id
                        JOIN status on realties.status = status.id
                        WHERE $where_str
                        ";
$total_rows = mysqli_fetch_array(mysqli_query($db, $total_records))[0];

// ceil rounds up the value to the nearest int
$total_pages = ceil($total_rows / $num_of_realties_per_page);

// use offset to show new records on every page
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
            WHERE $where_str
            LIMIT $offset, $num_of_realties_per_page
            ";

$res = mysqli_query($db, $query);
// var_dump($_GET);
// exit;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Med Real Estate</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container-fluid p-0">
        <div id="header-div">
            <h1 class="main-title">Club Med Real Estate</h1>
        </div>
        <div class='blue-div d-flex align-items-center justify-content-end px-5'>
            <div class="btn-group">
                <div class="link-div text-left px-2"><a class="btn btn-custom" href="new_realty.php">Add a New Realty</a></div>
                <div class="link-div text-left px-2"><a class="btn btn-custom" href="realty_types.php">Realty Types Register</a></div>
                <div class="link-div text-left px-2"><a class="btn btn-custom" href="cities.php">Cities Register</a></div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-3" id="search-bar">

                <!-- SEARCH -->
                <form action="./index.php" method="GET" id="search_form">
                    <div class="form-group">
                        <label for="realty_type">Realty Type:</label>
                        <select name="realty_type" class="form-control" id="realty_type_id">
                            <option value="">-- choose a realty type --</option>
                            <?php
                            selectMenu("realty_type", $realty_type_id);
                            ?>
                        </select>
                    </div>

                    <div class="form-group">

                        <label for="ad_type">Action:</label>
                        <select name="ad_type" class="form-control" id="ad_type_id">
                            <option value="">-- choose an action --</option>
                            <?php
                            selectMenu("ad_type", $ad_type_id);
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="city">City:</label>
                        <select name="city" class="form-control" id="city_id">
                            <option value="">-- choose a city --</option>
                            <?php
                            selectMenu("cities", $city_id);
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="min-price">Price Range (euro):</label>
                        <div class="form-row">
                            <div class="col">
                                <input type="number" name="min_price" class="form-control" id="min_price_id" value=<?= $min_price ?>>
                            </div>
                            to
                            <div class="col">
                                <input type="number" name="max_price" class="form-control" id="max_price_id" value=<?= $max_price ?>>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="min_size">Realty Size (m2):</label>
                        <div class="form-row">
                            <div class="col">
                                <input type="number" name="min_size" class="form-control" id="min_size_id" value=<?= $min_size ?>>
                            </div>
                            to
                            <div class="col">
                                <input type="number" name="max_size" class="form-control" id="max_size_id" value=<?= $max_size ?>>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="construction_year_min">Year of Construction:</label>

                        <div class="form-row">
                            <div class="col">
                                <input type="number" name="year_min" class="form-control" id="year_min_id" value=<?= $year_min ?>>
                            </div> to
                            <div class="col">
                                <input type="number" name="year_max" class="form-control" id="year_max_id" value=<?= $year_max ?>>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status">Availability</label>
                        <select name="status" class="form-control" id="status_id">
                            <option value="">-- choose a status --</option>
                            <?php
                            selectMenu("status", $status);
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date_of_sale">Date of Sale:</label>
                        <div class="form-row">
                            <div class="col-12">since</div>
                            <div class="col">
                                <input type="date" name="date_of_sale_min" placeholder="from" class="form-control" value=<?= $date_of_sale_min ?> id="date_min">
                            </div>
                            <div class="col-12">until</div>
                            <div class="col">
                                <input type="date" name="date_of_sale_max" placeholder="to" class="form-control" value=<?= $date_of_sale_max ?> id="date_max">
                            </div>
                        </div>
                    </div>

                    <button id="search_btn" class="btn btn-block btn-primary my-5">Search <i class="fas fa-search"></i></button>
                </form>
            </div>
            <div class="col-9 px-0">

                <?php

                if (
                    $realty_type_id == "" && $ad_type_id == "" && $city_id == "" && $min_price == "" && $max_price == "" && $min_size == ""
                    && $max_size == "" && $year_min == "" && $year_max == "" && $status == "" && $date_of_sale_min == ""
                    && $date_of_sale_max == ""
                ) {
                    $display = "none";
                } else {
                    $display = "block";
                }

                ?>
                <div id="criteria-div" class="px-5" style="display: <?= $display ?>;">
                    <ul id="criteria-list">
                        <li><button class="btn btn-primary" id="clear_all">Clear All <i class="fas fa-times fa-lg"></i></button></li>
                    </ul>
                </div>
                <!-- TABLE DATA -->
                <div class="table-responsive px-5">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Realty Type</th>
                                <th>Action</th>
                                <th>City</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Construction Year</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Date of Sale</th>
                                <th>Details</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($res)) {

                                $id = $row['id'];

                                $show_realty = "<a href=\"realty.php?id=$id\"><i class='fas fa-info-circle fa-lg'></i></a>";
                                $edit_realty = "<a href=\"edit_realty.php?id=$id\"><i class='fas fa-edit fa-lg'></i></a>";
                                $delete_realty = "<a onclick=\"showModal($id)\"><i class='fa fa-times fa-lg'></i></a>";

                                echo "<tr>";
                                echo "<td>" . $row["realty_type"] . "</td>";
                                echo "<td>" . $row["ad_type"] . "</td>";
                                echo "<td>" . $row["city"] . "</td>";
                                echo "<td>" . $row["size"] . "</td>";
                                echo "<td>" . $row["price"] . "</td>";
                                echo "<td>" . $row["year_of_construction"] . "</td>";
                                echo "<td>" . $row["description"] . "</td>";
                                echo "<td>" . $row["status"] . "</td>";
                                echo "<td>" . $row["date_of_sale"] . "</td>";
                                echo "<td>$show_realty</td>";
                                echo "<td>$edit_realty</td>";
                                echo "<td>$delete_realty</td>";
                                echo "</tr>";

                                // DELETION MODAL

                                echo "<div id=\"modal_del$id\" class=\"modal\">";
                                echo "<div class=\"modal-dialog modal-sm modal-dialog-centered\" role=\"document\">";
                                echo "<div class=\"modal-content\">";
                                echo "<div class=\"modal-header\">";
                                echo "<h1 class=\"modal-title\">Delete</h1>";
                                echo "<button type='button' class='close' onclick=\"closeModal($id);\">";
                                echo "<span aria-hidden'true'><i class='fa fa-times'></i></span>";
                                echo "</button>";
                                echo "</div>";
                                echo "<div class=\"modal-body\">";
                                echo "<p>Are you sure you want to delete this realty?</p>";
                                echo "</div>";
                                echo "<div class=\"modal-body\">";
                                echo "<button type=\"button\" class=\"btn btn-modal btn-secondary btn-lg\" onclick=\"closeModal($id);\">Cancel</button>";
                                echo "<a type=\"button\" class=\"btn btn-modal btn-danger-cust btn-lg\" href=\"delete_realty.php?id=$id\">Delete</a>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                            }

                            ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php
                echo "<p class='px-5'>Number of results: " . $total_rows . "</p>";
                ?>

                <!-- PAGINATION -->
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php if ($pageno <= 1) {
                                                echo 'disabled';
                                            } ?>">
                        <a href="<?php if ($pageno <= 1) {
                                        echo "#";
                                    } else {
                                        echo "?pageno=" . ($pageno - 1) . "&realty_type=$realty_type_id&ad_type=$ad_type_id&city=$city_id&min_price=$min_price&max_price=$max_price&min_size=$min_size&max_size=$max_size&year_min=$year_min&year_max=$year_max&status=$status&date_of_sale_min=$date_of_sale_min&date_of_sale_max=$date_of_sale_max";
                                    } ?>" class="page-link">Prev</a>
                    </li>

                    <?php
                    $i = 0;

                    while ($i < $total_pages) {
                        $i++;
                        ($pageno == strval($i)) ? $active = "active" : $active = "";
                        echo "<li class=\"page-item $active\" ><a class=\"page-link\" href=\"?pageno=$i&realty_type=$realty_type_id&ad_type=$ad_type_id&city=$city_id&min_price=$min_price&max_price=$max_price&min_size=$min_size&max_size=$max_size&year_min=$year_min&year_max=$year_max&status=$status&date_of_sale_min=$date_of_sale_min&date_of_sale_max=$date_of_sale_max\">$i</a></li>";
                    }
                    ?>

                    <li class="page-item <?php if ($pageno >= $total_pages) {
                                                echo 'disabled';
                                            } ?>">
                        <a href="<?php if ($pageno >= $total_pages) {
                                        echo "#";
                                    } else {
                                        echo "?pageno=" . ($pageno + 1) . "&realty_type=$realty_type_id&ad_type=$ad_type_id&city=$city_id&min_price=$min_price&max_price=$max_price&min_size=$min_size&max_size=$max_size&year_min=$year_min&year_max=$year_max&status=$status&date_of_sale_min=$date_of_sale_min&date_of_sale_max=$date_of_sale_max";
                                    } ?>" class="page-link">Next</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="app.js" type="text/javascript"></script>

</body>

</html>