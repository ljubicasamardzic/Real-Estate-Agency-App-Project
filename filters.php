<?php
    // checking which search filters are set and using this for modifying the get request
    if (isset($_GET['realty_type']) && $_GET['realty_type'] != "") {
        $realty_type_id = $_GET['realty_type'];
        $search_arr[] = "realty_type_id = $realty_type_id";
    } else {
        $realty_type_id = "";
    }

    if (isset($_GET['ad_type']) && $_GET['ad_type'] != "") {
        $ad_type_id = $_GET['ad_type'];
        $search_arr[] = "ad_type_id = $ad_type_id";
    } else {
        $ad_type_id = "";
    }

    if (isset($_GET['city']) && $_GET['city'] != "") {
        $city_id = $_GET['city'];
        $search_arr[] = "city_id = $city_id";
    } else {
        $city_id = "";
    }
    if (isset($_GET['min_price']) && $_GET['min_price'] != "" && isset($_GET['max_price']) && $_GET['max_price'] != "") {
        $max_price = $_GET['max_price'];
        $min_price = $_GET['min_price'];
        $search_arr[] = "price BETWEEN $min_price AND $max_price";
    }
    if (isset($_GET['min_price']) && $_GET['min_price'] != "") {
        $min_price = $_GET['min_price'];
        $search_arr[] = "price >= $min_price";
    } else {
        $min_price = "";
    }
    if (isset($_GET['max_price']) && $_GET['max_price'] != "") {
        $max_price = $_GET['max_price'];
        $search_arr[] = "price <= $max_price";
    } else {
        $max_price = "";
    }
    if (isset($_GET['min_size']) && $_GET['min_size'] != "" && isset($_GET['max_size']) && $_GET['max_size'] != "") {
        $min_size = $_GET['min_size'];
        $max_size = $_GET['max_size'];
        $search_arr[] = "size BETWEEN $min_size AND $max_size";
    }
    if (isset($_GET['min_size']) && $_GET['min_size'] != "") {
        $min_size = $_GET['min_size'];
        $search_arr[] = "size >= $min_size";
    } else {
        $min_size = "";
    }
    if (isset($_GET['max_size']) && $_GET['max_size'] != "") {
        $max_size = $_GET['max_size'];
        $search_arr[] = "size <= $max_size";
    } else {
        $max_size = "";
    }
    if (isset($_GET['year_min']) && $_GET['year_min'] != "" && isset($_GET['year_max']) && $_GET['year_max'] != "") {
        $year_min = $_GET['year_min'];
        $year_max = $_GET['year_max'];
        $search_arr[] = "year_of_construction BETWEEN $year_min AND $year_max";
    }
    if (isset($_GET['year_min']) && $_GET['year_min'] != "") {
        $year_min = $_GET['year_min'];
        $search_arr[] = "year_of_construction >= $year_min";
    } else {
        $year_min = "";
    }
    if (isset($_GET['year_max']) && $_GET['year_max'] != "") {
        $year_max = $_GET['year_max'];
        $search_arr[] = "year_of_construction <= $year_max";
    } else {
        $year_max = "";
    }
    if (isset($_GET['status']) && $_GET['status'] != "") {
        $status = $_GET['status'];
        $search_arr[] = "status = $status";
    } else {
        $status = "";
    }
    if (isset($_GET['date_of_sale_min']) && $_GET['date_of_sale_min'] != "" && isset($_GET['date_of_sale_max']) && $_GET['date_of_sale_max'] != "") {
        $date_of_sale_min = $_GET['date_of_sale_min'];
        $date_of_sale_max = $_GET['date_of_sale_max'];
        $search_arr[] = "date_of_sale BETWEEN '$date_of_sale_min' AND '$date_of_sale_max'";
    }
    if (isset($_GET['date_of_sale_min']) && $_GET['date_of_sale_min'] != "") {
        $date_of_sale_min = $_GET['date_of_sale_min'];
        $search_arr[] = "date_of_sale >= '$date_of_sale_min'";
    } else {
        $date_of_sale_min = "";
    }
    if (isset($_GET['date_of_sale_max']) && $_GET['date_of_sale_max'] != "") {
        $date_of_sale_max = $_GET['date_of_sale_max'];
        $search_arr[] = "date_of_sale <= '$date_of_sale_max'";
    } else {
        $date_of_sale_max = "";
    }

    $where_str = implode(" AND ", $search_arr);

?>