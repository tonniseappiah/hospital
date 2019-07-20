<?php
/**
 * Created by PhpStorm.
 * User: tonni
 * Date: 29/12/2018
 * Time: 18:40
 */

session_start();

/* connecting to the database file*/
include "inc.database.php";

if (isset($_SESSION['inserted_patient'])){

    $inserted_patient = $_SESSION['inserted_patient'];
    ?>



    <?php

    if (isset($_SESSION['inserted_patient'])){

        $sqlC = "SELECT patient, patientID, firstName, surname, otherName FROM patients WHERE No = '$inserted_patient'";
        $queryC = mysqli_query($con, $sqlC);
        $rowC = mysqli_fetch_assoc($queryC);

        ?>

        <div class='py-2 text-center'>
            <i class='ni ni-single-02 ni-3x'></i>
            <h4 class='heading mt-2'>Patient Information</h4>
            <hr class="w-50 my-1" style="color: #ffffff!important;">
            <table class="text-left mx-auto w-75">
                <tr>
                    <th>Patient Type</th>
                    <td class='font-weight-bold text-capitalize text-right'><?php echo $rowC['patient'] ?></td>
                </tr>
                <tr>
                    <th>PatientID</th>
                    <td class="text-right font-weight-bold"><?php echo $rowC['patientID'] ?></td>
                </tr>
                <tr>
                    <th>Patient Name</th>
                    <td class='font-weight-bold text-capitalize text-right'><?php echo $rowC['surname'] . " " . $rowC['firstName'] . " " . $rowC['otherName'] ?></td>
                </tr>
            </table>
        </div>
        <?php

    }else {

        echo "<h2 class='mt-5 text-center text-white'> There is no newly inserted patient </h2>";

    }

}else {

    echo "<h2 class='mt-5 text-center text-white'> There is no newly inserted patient </h2>";

}