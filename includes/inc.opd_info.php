<?php
/**
 * Created by PhpStorm.
 * User: tonni
 * Date: 03/01/2019
 * Time: 12:32
 */

session_start();

include "inc.database.php";

/*$staffID = $_SESSION['staffID'];
$staffName = $_SESSION['staffName'];*/

if (isset($_POST['residence'])){

    $residence = mysqli_real_escape_string($con, $_POST['residence']);
    $item_type = mysqli_real_escape_string($con, $_POST['item_type']);

    date_default_timezone_set("Africa/Accra");
    $datetime = date("Y-m-d H-i-s");

    $sqlA = "INSERT INTO opd_items (item_name, item_type, datetime) VALUES ('$residence', '$item_type', '$datetime')";
    $queryA = mysqli_query($con, $sqlA);

    if ($queryA){
        echo "SUCCESS";

    }


}elseif (isset($_POST['programme'])){

    $programme = mysqli_real_escape_string($con, $_POST['programme']);
    $item_type = mysqli_real_escape_string($con, $_POST['item_type']);

    date_default_timezone_set("Africa/Accra");
    $datetime = date("Y-m-d H-i-s");

    $sqlA = "INSERT INTO opd_items (item_name, item_type, datetime) VALUES ('$programme', '$item_type', '$datetime')";
    $queryA = mysqli_query($con, $sqlA);

    if ($queryA){
        echo "SUCCESS";

    }


}elseif (isset($_POST['school'])){

    $school = mysqli_real_escape_string($con, $_POST['school']);
    $item_type = mysqli_real_escape_string($con, $_POST['item_type']);

    date_default_timezone_set("Africa/Accra");
    $datetime = date("Y-m-d H-i-s");

    $sqlA = "INSERT INTO opd_items (item_name, item_type, datetime) VALUES ('$school', '$item_type', '$datetime')";
    $queryA = mysqli_query($con, $sqlA);

    if ($queryA){
        echo "SUCCESS";

    }


}