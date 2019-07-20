<?php
/**
 * Created by PhpStorm.
 * User: tonni
 * Date: 06/01/2019
 * Time: 08:38
 */

session_start();

include "inc.database.php";

if (isset($_SESSION['patientID'])){

    $patientID = $_SESSION['patientID'];

    $sql = "SELECT * FROM drug_request WHERE patientID = '$patientID' ORDER BY requestID DESC LIMIT 1";
    $query = mysqli_query($con, $sql);


    if ($result = mysqli_num_rows($query)){


        $row = mysqli_fetch_assoc($query);

        $treatmentID = $row['treatmentID'];

        $sqlA = "SELECT * FROM drugs_request_items WHERE patientID = '$patientID' && treatmentID = '$treatmentID' ORDER BY itemID DESC LIMIT 1";
        $queryA = mysqli_query($con, $sqlA);

        if ($resultA = mysqli_num_rows($queryA)){
            ?>
            <thead class="thead-light">
            <tr>
                <th>Drug</th>
                <th>Dosage</th>
            </tr>
            </thead>
            <tbody>

            <?php
            while ($rowA = mysqli_fetch_assoc($queryA)){
                ?>
                <tr>
                    <th style='padding-top: 0.5rem!important; padding-bottom: 0.5rem!important;'><?php echo $rowA['drugName'] ?></th>
                    <td style='padding-top: 0.5rem!important; padding-bottom: 0.5rem!important;'> <?php echo $rowA['dosage']?> </td>
                </tr>

                <?php
            }

            ?>
            </tbody>
            <?php


        }


    }else {
?>
         <h4 class='text-center' style='padding-top: 5px!important; padding-bottom: 5px!important;'> Patient don't have a previous drug information. </h4>
<?php
    }

}
else {

    ?>
    <h4 class='text-center bg-secondary' style='padding-top: 5px!important; padding-bottom: 5px!important; margin-bottom: 0!important;'> Patient don't have a previous drug information. </h4>
    <?php

}

