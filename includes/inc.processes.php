<?php
/**
 * Created by PhpStorm.
 * User: tonni
 * Date: 05/01/2019
 * Time: 23:02
 */

session_start();

include "inc.database.php";

/*$staffID = $_SESSION['staffID'];
$staffName = $_SESSION['staffName'];*/

if (isset($_POST['login'])){

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $sql = "SELECT * FROM staffs WHERE email = '$email'";
    $query = mysqli_query($con, $sql);
    $result = mysqli_num_rows($query);

    if ($result < 1){

        echo "INVALID_EMAIL";

    } else {

        $fetch = mysqli_fetch_assoc($query);

        if ($fetch['password'] != $password){

            echo "INVALID_PASSWORD";

        }else {

            echo $fetch['role'];

            $_SESSION['staffName'] = $fetch['staffName'];
            $_SESSION['staffID'] = $fetch['staffID'];
            $_SESSION['role'] = $fetch['role'];

        }

    }

} elseif (isset($_POST['clinical'])){

    $staffID = $_SESSION['staffID'];
    $staffName = $_SESSION['staffName'];

    $temperature = mysqli_real_escape_string($con, $_POST['temperature']);
    $pressure = mysqli_real_escape_string($con, $_POST['pressure']);
    $weight = mysqli_real_escape_string($con, $_POST['weight']);
    $pulse = mysqli_real_escape_string($con, $_POST['pulse']);
    $patientName = mysqli_real_escape_string($con, $_POST['patientName']);
    $patientID = mysqli_real_escape_string($con, $_POST['patientID']);

    date_default_timezone_set("Africa/Accra");
    $date = date("Y-m-d");
    $time = date("H:i:s");

    $datetime = date("Y-m-d H-i-s");

    $sql = "SELECT * FROM visited_dates_patient WHERE patientID = '$patientID' && date = '$date'";
    $query = mysqli_query($con, $sql);

    if ($result = mysqli_num_rows($query)){

        echo "ALREADY_INSERTED";

    } else {

        $sqlA = "INSERT INTO visited_dates_patient (patientID, date, time) VALUES ('$patientID', '$date', '$time')";
        $queryA = mysqli_query($con, $sqlA);

        if ($queryA){

            $sqlB = "INSERT INTO clinical (patientID, temperature, pressure, pulse, weight, staffID, staffName, date, time) VALUES ('$patientID', '$temperature', '$pressure', '$pulse', '$weight', '$staffID', '$staffName', '$date', '$time')";
            $queryB = mysqli_query($con, $sqlB);

            if ($queryB){

                $sqlC = "INSERT INTO in_treatment (patientID, patientName, date, time) VALUES ('$patientID', '$patientName', '$date', '$time')";
                $queryC = mysqli_query($con, $sqlC);

                if ($queryC){

                    echo "SUCCESS";

                }else {

                    echo "INTO_CLINICAL_FAILED";
                }

            }else {

                echo "INTO_CLINICAL_FAILED";
            }
        } else {

            echo "INSERTION_FAILED";

        }

    }

} elseif (isset($_POST['add_lab_item'])) {

    $item_name = mysqli_real_escape_string($con, $_POST['lab_item_name']);

    $staffID = $_SESSION['staffID'];
    $staffName = $_SESSION['staffName'];

    date_default_timezone_set('Africa/Accra');
    $datetime = date('Y-m-d H-i-s');

    $sql = "SELECT * FROM lab_items WHERE itemName = '$item_name'";
    $query = mysqli_query($con, $sql);

    if ($result = mysqli_num_rows($query)) {

        echo "IN_ALREADY";

    } else {

        $sql = "INSERT INTO lab_items (itemName, staffID, staffName, datetime) VALUES ('$item_name', '$staffID', '$staffName', '$datetime')";
        $query = mysqli_query($con, $sql);

        if ($query) {

            echo "SUCCESS";

        }

    }

} elseif (isset($_POST['check_item'])) {

    $item_name = mysqli_real_escape_string($con, $_POST['name']);

    $sql = "SELECT * FROM lab_items WHERE itemName = '$item_name'";
    $query = mysqli_query($con, $sql);

    if ($result = mysqli_num_rows($query)) {

        echo "EXIST";

    } else {

        echo "SUCCESS";

    }

} elseif (isset($_POST['nurse'])){

    $patientID = mysqli_real_escape_string($con, $_POST['patientID']);

    $sql = "SELECT * FROM patients WHERE patientID = '$patientID'";
    $query = mysqli_query($con, $sql);

    if ($result = mysqli_num_rows($query)){

        $row = mysqli_fetch_assoc($query);

        $_SESSION['patientID'] = $patientID;
        $_SESSION['firstName'] = $row['firstName'];
        $_SESSION['surname'] = $row['surname'];
        $_SESSION['otherName'] = $row['otherName'];
        $_SESSION['age'] = $row['age'];
        $_SESSION['patient'] = $row['patient'];
        $_SESSION['gender'] = $row['gender'];

        echo "SUCCESS";

    }else {

        echo "FAILED";

    }



}elseif (isset($_POST['in_treatment'])){

    $patientID = mysqli_real_escape_string($con, $_POST['patientID']);

    $sql = "SELECT * FROM in_treatment WHERE patientID = '$patientID'";
    $query = mysqli_query($con, $sql);

    if ($result = mysqli_num_rows($query)){

        $row = mysqli_fetch_assoc($query);

        $_SESSION['patientID'] = $patientID;
        $_SESSION['patientName'] = $row['patientName'];

        echo "SUCCESS";

    }else {

        echo "FAILED";

    }

}elseif (isset($_POST['check-in'])){

    $patientID = mysqli_real_escape_string($con, $_POST['patientID']);

    $sql = "SELECT * FROM awaiting_lab WHERE patientID = '$patientID'";
    $query = mysqli_query($con, $sql);

    if ($result = mysqli_num_rows($query)){

        $row = mysqli_fetch_assoc($query);

        $_SESSION['patientID'] = $patientID;
        $_SESSION['patient_name'] = $row['patient_name'];
        $_SESSION['in_lab'] = "in_lab";


        echo "SUCCESS";

    }else {

        echo "FAILED";

    }

} elseif (isset($_POST['labRequest'])) {

    $staffID = $_SESSION['staffID'];
    $staffName = $_SESSION['staffName'];

    $requestItem = $_POST['requestItem'];
    $patientID = mysqli_real_escape_string($con, $_POST['patientID']);

    date_default_timezone_set('Africa/Accra');
    $datetime = date('Y-m-d H-i-s');

    $date = date("Y-m-d");
    $time = date("H:i:s");

    $sql = "SELECT * FROM lab_request WHERE patientID = '$patientID'";
    $query = mysqli_query($con, $sql);
    if ($result = mysqli_num_rows($query)){

        echo "WAITING";

    }else {

        $sqlA = "SELECT patientName FROM in_treatment WHERE patientID = '$patientID'";
        $queryA = mysqli_query($con, $sqlA);
        $rowA = mysqli_fetch_assoc($queryA);

        $patientName = $rowA['patientName'];

        $sqlB = "INSERT INTO lab_request (patientID, patientName, staffID, staffName, date, time) VALUES ('$patientID', '$patientName', '$staffID', '$staffName', '$date', '$time')";
        $queryB = mysqli_query($con, $sqlB);

        if ($queryB) {

            $requestID = $con->insert_id;

            foreach ($_POST['requestItem'] as $item => $value) {

                $requestedItem = mysqli_real_escape_string($con, $requestItem[$item]);

                $sqlC = "INSERT INTO lab_request_items (requestID, patientID, requestedItem, staffID, staffName, datetime) VALUES ('$requestID', '$patientID', '$requestedItem', '$staffID', '$staffName', '$datetime')";
                $queryC = mysqli_query($con, $sqlC);

            }

            if ($queryC){

                $sqlD = "INSERT INTO awaiting_lab (patientID, patientName, datetime) VALUES ('$patientID', '$patientName', '$datetime')";
                $queryD = mysqli_query($con, $sqlD);

                if ($queryD){
                    $sqlE = "DELETE FROM in_treatment WHERE patientID = '$patientID'";
                    $queryE = mysqli_query($con, $sqlE);

                    if ($queryE){
                        echo "SUCCESS";
                    }
                }

            }

        }

    }

} elseif (isset($_POST['labPerform'])){

    $staffID = $_SESSION['staffID'];
    $staffName = $_SESSION['staffName'];

    $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
    $labItemA = $_POST['labItem'];
    $labItemValueA = $_POST['labItemValue'];
    $patientName = mysqli_real_escape_string($con, $_POST['patientName']);
    $requestStaffName = mysqli_real_escape_string($con, $_POST['requestStaffName']);
    $requestStaffID = mysqli_real_escape_string($con, $_POST['requestStaffID']);
    $requestDate = mysqli_real_escape_string($con, $_POST['requestDate']);
    $requestTime = mysqli_real_escape_string($con, $_POST['requestTime']);


    date_default_timezone_set('Africa/Accra');
    $datetime = date('Y-m-d H-i-s');

    $date = date("Y-m-d");
    $time = date("H:i:s");



    $sql = "INSERT INTO lab_report (patientID, patientName, requestedBy, requestedDate, requestedTime, staffID, staffName, date, time) VALUES ('$patientID', '$patientName', '$requestStaffName', '$requestDate', '$requestTime', '$staffID', '$staffName', '$date', '$time')";
    $query = mysqli_query($con, $sql);

    if ($query){

        $reportID = $con->insert_id;

        foreach ($_POST['labItem'] as $item => $value){

            $labItem = mysqli_real_escape_string($con, $labItemA[$item]);
            $labItemValue = mysqli_real_escape_string($con, $labItemValueA[$item]);

            $sqlA = "INSERT INTO lab_report_items (reportID, patientID, requestedItem, value, staffID, staffName, datetime) VALUES ('$reportID', '$patientID', '$labItem', '$labItemValue', '$staffID', '$staffName', '$datetime')";
            $queryA = mysqli_query($con, $sqlA);

        }

        if ($queryA) {

            $sqlC = "DELETE FROM lab_request WHERE patientID = '$patientID'";
            $queryC = mysqli_query($con, $sqlC);

            if ($queryC) {

                $sqlD = "DELETE FROM lab_request_items WHERE patientID = '$patientID'";
                $queryD = mysqli_query($con, $sqlD);

                if ($queryD) {

                    echo "SUCCESS";

                } else {
                    echo "FAILED";
                }

            }

        }

    }


}

/*if (isset($_POST['clinical'])) {


    $temperature = mysqli_real_escape_string($con, $_POST['temperature']);
    $pulse = mysqli_real_escape_string($con, $_POST['pulse']);
    $pressure = mysqli_real_escape_string($con, $_POST['pressure']);
    $weight = mysqli_real_escape_string($con, $_POST['weight']);
    $patientID = mysqli_real_escape_string($con, $_POST['patientID']);

    date_default_timezone_set("Africa/Accra");
    $datetime = date("Y-m-d H-i-s");

    $sql = "INSERT INTO patient_clinical (patientID, temperature, pressure, pulse, weight, staffID, staffName, datetime) VALUES ('$patientID', '$temperature', '$pressure', '$pulse', '$weight', '$staffID', '$staffName', '$datetime')";
    $query = mysqli_query($con, $sql);

    if ($query) {

        $sqlB = "SELECT * FROM in_treatment WHERE patientID = '$patientID'";
        $queryB = mysqli_query($con, $sqlB);

        if ($resultB = mysqli_num_rows($queryB)) {
            echo "WAITING";
        } else {

            $sql = "SELECT * FROM patients WHERE patientID = '$patientID'";
            $query = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($query);

            $patient_name = $row['surname'] . " " . $row['firstName'] . " " . $row['otherName'];
            $age = $row['age'];
            $gender = $row['gender'];

            $sqlA = "INSERT INTO in_treatment (patientID, patient_name, age, gender, datetime) VALUES ('$patientID', '$patient_name', '$age', '$gender', '$datetime')";
            $queryA = mysqli_query($con, $sqlA);

            if ($queryA) {

                echo "SUCCESS";

            }

        }
    }

} elseif (isset($_POST['treatment'])) {

    $patient_name = $_SESSION['patient_name'];
    $observation = mysqli_real_escape_string($con, $_POST['observation']);
    $patientID = mysqli_real_escape_string($con, $_POST['patientID']);
    $drugName = $_POST['drugName'];
    $dosage_quantity = $_POST['dosage_quantity'];
    $dosage_times = $_POST['dosage_times'];
    $drug_quantity = $_POST['drug_quantity'];
    $drugID = $_POST['drugID'];

    date_default_timezone_set("Africa/Accra");
    $datetime = date("Y-m-d H-i-s");

    $sql = "SELECT * FROM patient_treatment WHERE patientID = '$patientID'";
    $query = mysqli_query($con, $sql);
    if ($result = mysqli_num_rows($query)) {

        echo "WAITING";

    } else {

        $sqlC = "INSERT INTO patient_treatment (patientID, staffID, staffName, datetime) VALUES ('$patientID', '$staffID', '$staffName', '$datetime')";
        $queryC = mysqli_query($con, $sqlC);
        if ($queryC) {

            $treatmentID = $con->insert_id;

            $sqlA = "INSERT INTO patient_observations (treatmentID, patientID, observation, staffID, staffName, datetime) VALUES ('$treatmentID', '$patientID', '$observation', '$staffID', '$staffName', '$datetime')";
            $queryA = mysqli_query($con, $sqlA);

            $sqlB = "INSERT INTO patient_drugs (treatmentID, patientID, patient_name, staffID, staffName, datetime) VALUES ('$treatmentID', '$patientID', '$patient_name', '$staffID', '$staffName', '$datetime')";
            $queryB = mysqli_query($con, $sqlB);

            if ($queryA == true && $queryB == true) {

                foreach ($_POST['drugID'] as $item => $value) {

                    $drugIDA = mysqli_real_escape_string($con, $drugID[$item]);
                    $dosage_quantityA = mysqli_real_escape_string($con, $dosage_quantity[$item]);
                    $dosage_timesA = mysqli_real_escape_string($con, $dosage_times[$item]);
                    $drugNameA = mysqli_real_escape_string($con, $drugName[$item]);
                    $drug_quantityA = mysqli_real_escape_string($con, $drug_quantity[$item]);

                    $dosage = $dosage_quantityA . " x " . $dosage_timesA;

                    $sql = "INSERT INTO patient_drugs_items (treatmentID, patientID, drugID, drugName, dosage, drug_quantity, staffID, staffName, datetime) VALUES ('$treatmentID', '$patientID', '$drugIDA', '$drugNameA', '$dosage', '$drug_quantityA', '$staffID', '$staffName', '$datetime')";
                    $query = mysqli_query($con, $sql);

                    if ($query) {


                        echo "SUCCESS";

                    }

                }

            }

        }

    }

} elseif (isset($_POST['patient']) == "student") {

    $firstName = mysqli_real_escape_string($con, $_POST['firstName']);
    $otherName = mysqli_real_escape_string($con, $_POST['otherName']);
    $surname = mysqli_real_escape_string($con, $_POST['surname']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $contact = mysqli_real_escape_string($con, $_POST['contact']);
    $programme = mysqli_real_escape_string($con, $_POST['programme']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $residence = mysqli_real_escape_string($con, $_POST['residence']);
    $patient = mysqli_real_escape_string($con, $_POST['patient']);
    $level = mysqli_real_escape_string($con, $_POST['level']);


    $sqlA = "SELECT * FROM patients WHERE patient = '$patient'";
    $queryA = mysqli_query($con, $sqlA);
    $resultA = mysqli_num_rows($queryA);

    date_default_timezone_set('Africa/Accra');
    $datetime = date('Y-m-d H-i-s');


    $add = $resultA + 1;
    $patientID = $patient . $add;

    if ($patientID == true) {

        $sqlB = "INSERT INTO patients (patientID, patient, firstName, surname, otherName, age, gender, contact, residence, programme, level, datetime) VALUES ('$patientID', '$patient', '$firstName', '$surname', '$otherName', '$age', '$gender', '$contact', '$residence', '$programme', '$level', '$datetime')";
        $queryB = mysqli_query($con, $sqlB);

        if ($queryB) {

            $inserted_patient = $con->insert_id;

            $_SESSION['inserted_patient'] = $inserted_patient;

            echo "SUCCESS";

        }
    }

} elseif (isset($_POST['patient']) == "staff") {

    $firstName = mysqli_real_escape_string($con, $_POST['firstName']);
    $otherName = mysqli_real_escape_string($con, $_POST['otherName']);
    $surname = mysqli_real_escape_string($con, $_POST['surname']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $contact = mysqli_real_escape_string($con, $_POST['contact']);
    $school = mysqli_real_escape_string($con, $_POST['school']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $residence = mysqli_real_escape_string($con, $_POST['residence']);
    $patient = mysqli_real_escape_string($con, $_POST['patient']);


    $sqlA = "SELECT * FROM patients WHERE patient = '$patient'";
    $queryA = mysqli_query($con, $sqlA);
    $resultA = mysqli_num_rows($queryA);

    date_default_timezone_set('Africa/Accra');
    $datetime = date('Y-m-d H-i-s');


    $add = $resultA + 1;
    $patientID = $patient . $add;

    if ($patientID == true) {

        $sqlB = "INSERT INTO patients (patientID, patient, firstName, surname, otherName, age, gender, contact, residence, school, datetime) VALUES ('$patientID','$patient', '$firstName', '$surname', '$otherName', '$age', '$gender', '$contact', '$residence', '$school', '$datetime')";
        $queryB = mysqli_query($con, $sqlB);

        if ($queryB) {

            $inserted_patient = $con->insert_id;

            $_SESSION['inserted_patient'] = $inserted_patient;

            echo "SUCCESS";
        }
    }

} elseif (isset($_POST['patient']) == "foreign") {

    $firstName = mysqli_real_escape_string($con, $_POST['firstName']);
    $otherName = mysqli_real_escape_string($con, $_POST['otherName']);
    $surname = mysqli_real_escape_string($con, $_POST['surname']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $contact = mysqli_real_escape_string($con, $_POST['contact']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $residence = mysqli_real_escape_string($con, $_POST['residence']);
    $patient = mysqli_real_escape_string($con, $_POST['patient']);


    $sqlA = "SELECT * FROM patients WHERE patient = '$patient'";
    $queryA = mysqli_query($con, $sqlA);
    $resultA = mysqli_num_rows($queryA);

    date_default_timezone_set('Africa/Accra');
    $datetime = date('Y-m-d H-i-s');


    $add = $resultA + 1;
    $patientID = $patient . $add;

    if ($patientID == true) {

        $sqlB = "INSERT INTO patients (patientID, patient, firstName, surname, otherName, age, gender, contact, residence, datetime) VALUES ('$patientID', '$patient', '$firstName', '$surname', '$otherName', '$age', '$gender', '$contact', '$residence', '$datetime')";
        $queryB = mysqli_query($con, $sqlB);

        if ($queryB) {

            $inserted_patient = $con->insert_id;

            $_SESSION['inserted_patient'] = $inserted_patient;

            echo "SUCCESS";
        }
    }

} elseif (isset($_POST['add_lab_item'])) {

    $item_name = mysqli_real_escape_string($con, $_POST['lab_item_name']);

    date_default_timezone_set('Africa/Accra');
    $datetime = date('Y-m-d H-i-s');

    $sql = "SELECT * FROM lab_items WHERE item_name = '$item_name'";
    $query = mysqli_query($con, $sql);

    if ($result = mysqli_num_rows($query)) {

        echo "IN_ALREADY";

    } else {

        $sql = "INSERT INTO lab_items (item_name, staffID, staffName, datetime) VALUES ('$item_name', '$staffID', '$staffName', '$datetime')";
        $query = mysqli_query($con, $sql);

        if ($query) {

            echo "SUCCESS";

        }

    }


} elseif (isset($_POST['make_request'])) {

    $item_requested = $_POST['requested_item'];
    $patientID = mysqli_real_escape_string($con, $_POST['patientID']);

    date_default_timezone_set('Africa/Accra');
    $datetime = date('Y-m-d H-i-s');

    $sql = "SELECT * FROM lab_request WHERE patientID = '$patientID'";
    $query = mysqli_query($con, $sql);
    if ($result = mysqli_num_rows($query)){

        echo "WAITING";

    }else {

        $sqlA = "SELECT patient_name FROM in_treatment WHERE patientID = '$patientID'";
        $queryA = mysqli_query($con, $sqlA);
        $rowA = mysqli_fetch_assoc($queryA);

        $patient_name = $rowA['patient_name'];

        $sql = "INSERT INTO lab_request (patientID, patient_name, staffID, staffName, datetime) VALUES ('$patientID', '$patient_name', '$staffID', '$staffName', '$datetime')";
        $query = mysqli_query($con, $sql);

        if ($query) {

            $requestID = $con->insert_id;

            foreach ($_POST['requested_item'] as $item => $value) {

                $requested_item = mysqli_real_escape_string($con, $item_requested[$item]);

                $sql = "INSERT INTO lab_request_items (requestID, patientID, requested_item, staffID, staffName, datetime) VALUES ('$requestID', '$patientID', '$requested_item', '$staffID', '$staffName', '$datetime')";
                $query = mysqli_query($con, $sql);

            }

            if ($query){

                $sqlA = "INSERT INTO awaiting_lab (patientID, patient_name, datetime) VALUES ('$patientID', '$patient_name', '$datetime')";
                $queryA = mysqli_query($con, $sqlA);

                if ($queryA){
                    $sql = "DELETE FROM in_treatment WHERE patientID = '$patientID'";
                    $query = mysqli_query($con, $sql);

                    if ($query){
                        echo "SUCCESS";
                    }
                }

            }

        }

    }

}*/