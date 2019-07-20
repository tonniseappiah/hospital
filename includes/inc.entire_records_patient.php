<?php
/**
 * Created by PhpStorm.
 * User: tonni
 * Date: 23/04/2019
 * Time: 09:24
 */

include "inc.database.php";

$patientID = $_POST['patientID'];

$sql = "SELECT * FROM visited_dates_patient WHERE patientID = '$patientID'";
$query = mysqli_query($con, $sql);

if ($results = mysqli_num_rows($query)){
    while ($row = mysqli_fetch_assoc($query)){
        ?>

        <div>
            <?php
            $datetime_data = $row['datetime'];
            $datetime_convert = strtotime($datetime_data);
            $date = date("Y-m-d, $datetime_convert");
            $date_full = date("l, jS F, Y | H:i A")



            ?>

            <div class="session-head text-left">
                <h3 style="font-size: 14px">
                    <span>Date of Visit: <?php echo $date_full  ?></span>
                </h3>
            </div>

            <div class="row">



                <?php

                $sql = "SELECT * FROM clinical WHERE patientID = '$patientID' && date = '$date'";
                $query = mysqli_query($con, $sql);

                if ($results = mysqli_num_rows($query)) {

                    while ($row = mysqli_fetch_assoc($query)) {

                    }

                    ?>

                    <div class="col-md-6 mb-3">
                        <div class="card shadow bg-secondary">
                            <div class="card-header bg-white"
                                 style="padding-bottom: 0.5rem!important; padding-top: 0.5rem!important;">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="text-uppercase text-muted ls-1 mb-1">Nurse's
                                            Observations</h6>
                                        <h5 class="mb-0 text-capitalize">Staff Name: <?php echo $row['staffName'];    ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body"
                                 style="padding-top: 0.5rem!important; padding-bottom: 0.5rem!important;">
                                <!-- Chart -->
                                <div class="table-responsive">
                                    <table class="table table-flush">
                                        <tbody id="">
                                        <tr>
                                            <th style='padding-top: 0.5rem!important; padding-bottom: 0.5rem!important;'>Temperature</th>
                                            <td style='padding-top: 0.5rem!important; padding-bottom: 0.5rem!important;'><?php echo $row['temperature'] ?> C</td>
                                        </tr>
                                        <tr>
                                            <th style='padding-top: 0.5rem!important; padding-bottom: 0.5rem!important;'>Weight</th>
                                            <td style='padding-top: 0.5rem!important; padding-bottom: 0.5rem!important;'><?php echo $row['weight'] ?> Kg</td>
                                        </tr>
                                        <tr>
                                            <th style='padding-top: 0.5rem!important; padding-bottom: 0.5rem!important;'>Pressure</th>
                                            <td style='padding-top: 0.5rem!important; padding-bottom: 0.5rem!important;'> <?php echo $row['pressure'] ?></td>
                                        </tr>
                                        <tr>
                                            <th style='padding-top: 0.5rem!important; padding-bottom: 0.5rem!important;'>Pulse</th>
                                            <td style='padding-top: 0.5rem!important; padding-bottom: 0.5rem!important;'> <?php echo $row['pulse'] ?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                    <?php
                }

                $sqlA = "SELECT * FROM treatment WHERE patientID = '$patientID' && datetime = '$date'";
                $queryA = mysqli_query($con, $sqlA);

                if ($resultsA = mysqli_num_rows($queryA)){

                    while ($rowA = mysqli_fetch_assoc($queryA)){
                        ?>
                        <div class="col-md-6 mb-3">
                            <div class="card shadow">
                                <div class="card-header bg-white"
                                     style="padding-bottom: 0.5rem!important; padding-top: 0.5rem!important;">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="text-uppercase text-muted ls-1 mb-1">Doctor's
                                                Observations</h6>
                                            <h5 class="mb-0 text-capitalize">Staff Name: <?php echo $rowA['staffName']   ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $treatmentID = $rowA['treatmentID'];
                                ?>
                                <div class="card-body" style="padding-top: 0.5rem!important; padding-bottom: 0.5rem!important;">
                                    <div class="table-responsive">
                                        <table class="table table-flush">
                                            <tbody>
                                            <tr>
                                                <?php
                                                $sqlC = "SELECT * FROM patient_observations WHERE treatmentID = '$treatmentID'";
                                                $queryC = mysqli_query($con, $sqlC);
                                                $rowC = mysqli_fetch_assoc($queryC);
                                                ?>
                                                <td>
                                                    <?php
                                                    echo  $rowC['observation'];
                                                    ?>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        $sqlD = "SELECT * FROM drug_request WHERE treatmentID = '$treatmentID'";
                        $queryD = mysqli_query($con, $sqlD);
                        $rowD = mysqli_fetch_assoc($queryD);

                        ?>
                        <div class="col-md-6 mb-3">
                            <div class="card shadow">
                                <div class="card-header bg-white"
                                     style="padding-bottom: 0.5rem!important; padding-top: 0.5rem!important;">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="text-uppercase text-muted ls-1 mb-1">Patient
                                                Drugs</h6>
                                            <h5 class="mb-0">Staff Name: <?php echo $rowD['staffName']   ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <!-- Chart -->
                                <div class="table-responsive">
                                    <table class="table table-flush" id="last_drug">
                                        <thead>
                                        <tr>
                                            <th>Drug Name</th>
                                            <th>Dosage</th>
                                        </tr>

                                        </thead>
                                        <tbody>
                                        <?php
                                        $sqlE = "SELECT * FROM drugs_request_items WHERE treatmentID = '$treatmentID'";
                                        $queryE = mysqli_query($con, $sqlE);

                                        while ($rowE = mysqli_fetch_assoc($queryE)){
                                            ?>
                                            <tr>
                                                <td class="text-capitalize font-weight-bold"><?php echo $rowE['drugName'] ?></td>
                                                <td class="text-capitalize font-weight-bold"><?php echo $rowE['dosage'] ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <?php
                    }

                }

                ?>


                <div class="col-md-6 mb-3">
                    <div class="card shadow bg-secondary">
                        <div class="card-header bg-white"
                             style="padding-bottom: 0.5rem!important; padding-top: 0.5rem!important;">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-uppercase text-muted ls-1 mb-1">Patient's Lab
                                        Report</h6>
                                    <h5 class="mb-0">Staff Name: Mr. Appiah Tonnise Danquah</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 1rem 0.5rem!important;">
                            <div class="col text-center">
                                <a href="#!" class="btn btn-sm btn-block btn-primary">View</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <hr class="my-0 w-50">
        <?php
    }

} else {

    echo "<h4 class='text-center py-2'> No data available for patient</h4>";

}

?>


