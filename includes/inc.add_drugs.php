<?php
/**
 * Created by PhpStorm.
 * User: tonni
 * Date: 03/02/2019
 * Time: 20:04
 */

include "inc.database.php";

if (isset($_POST['drugName'])){

    $drugName = mysqli_real_escape_string($con, $_POST['drugName']);
    $dosage_times = mysqli_real_escape_string($con, $_POST['dosage_times']);
    $dosage_quantity = mysqli_real_escape_string($con, $_POST['dosage_quantity']);
    $drug_quantity = mysqli_real_escape_string($con, $_POST['drug_quantity']);

    date_default_timezone_set('Africa/Accra');
    $datetime = date('Y-m-d H-i-s');

    $sql = "INSERT INTO drugs (drugName, dosageTimes, dosageQuantity, quantity, datetime) VALUES ('$drugName', '$dosage_times', '$dosage_quantity', '$drug_quantity', '$datetime')";
    $query = mysqli_query($con, $sql);

    if ($query){

        echo "SUCCESS";

    }

}

