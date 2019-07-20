<?php
/**
 * Created by PhpStorm.
 * User: tonni
 * Date: 19/06/2019
 * Time: 20:21
 */

include "inc.database.php";

if (isset($_POST['patientRecords'])){

    $patientID = mysqli_real_escape_string($con, $_POST['patientID']);

    $sql = "SELECT * FROM clinical WHERE patientID = '$patientID'";
    $query = mysqli_query($con, $sql);

    if ($results = mysqli_num_rows($query)){
        echo $results;
    }else {
        echo "0";
    }

} elseif (isset($_POST['labRecords'])){

    $patientID = mysqli_real_escape_string($con, $_POST['patientID']);

    $sql = "SELECT * FROM lab_report WHERE patientID = '$patientID'";
    $query = mysqli_query($con, $sql);


    if ($results = mysqli_num_rows($query)){
        echo $results;
    }else {
        echo "0";
    }

} elseif (isset($_POST['labRecordsToday'])){

    date_default_timezone_set("Africa/Accra");
    $dateCheck = date("Y-m-d");

    $patientID = mysqli_real_escape_string($con, $_POST['patientID']);

    $sql = "SELECT * FROM lab_report WHERE patientID = '$patientID' && date = '$dateCheck'";
    $query = mysqli_query($con, $sql);


    if ($results = mysqli_num_rows($query)){
        echo $results;
    }else {
        echo "0";
    }

} elseif (isset($_POST['labRecordsNoPatient'])){

    $sql = "SELECT * FROM lab_report";
    $query = mysqli_query($con, $sql);


    if ($results = mysqli_num_rows($query)){
        echo $results;
    }else {
        echo "0";
    }

} elseif (isset($_POST['labRecordsTodayNoPatient'])){

    date_default_timezone_set("Africa/Accra");
    $dateCheck = date("Y-m-d");

    $sql = "SELECT * FROM lab_report WHERE date = '$dateCheck'";
    $query = mysqli_query($con, $sql);


    if ($results = mysqli_num_rows($query)){
        echo $results;
    }else {
        echo "0";
    }

} elseif (isset($_POST['labRequest'])){

    $sql = "SELECT * FROM lab_request";
    $query = mysqli_query($con, $sql);


    if ($results = mysqli_num_rows($query)){
        echo $results;
    }else {
        echo "0";
    }

} elseif (isset($_POST['urineRequest'])){

    $sql = "SELECT * FROM urine_request";
    $query = mysqli_query($con, $sql);


    if ($results = mysqli_num_rows($query)){
        echo $results;
    }else {
        echo "0";

    }

}