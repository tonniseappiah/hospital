<?php
/**
 * Created by PhpStorm.
 * User: tonni
 * Date: 05/06/2019
 * Time: 22:37
 */

session_start();

include "inc.database.php";

if (isset($_POST['lastClinical'])){

    $patientID = mysqli_real_escape_string($con, $_POST['patientID']);

    $sql = "SELECT * FROM clinical WHERE patientID = '$patientID' ORDER BY clinicalID DESC LIMIT 1";
    $query = mysqli_query($con, $sql);

    if ($result = mysqli_num_rows($query)){
        ?>
        <table class="table table-flush">
            <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($query)){
                ?>
                <tr>
                    <th class="font-weight-bold py-2">Temperature</th>
                    <td style='padding-top: 0.5rem!important; padding-bottom: 0.5rem!important;'><?php echo $row['temperature'] ?> C</td>
                </tr>
                <tr>
                    <th class="font-weight-bold py-2">Weight</th>
                    <td style='padding-top: 0.5rem!important; padding-bottom: 0.5rem!important;'><?php echo $row['weight'] ?> Kg</td>
                </tr>
                <tr>
                    <th class="font-weight-bold py-2">Pressure</th>
                    <td style='padding-top: 0.5rem!important; padding-bottom: 0.5rem!important;'> <?php echo $row['pressure'] ?></td>
                </tr>
                <tr>
                    <th class="font-weight-bold py-2">Pulse</th>
                    <td style='padding-top: 0.5rem!important; padding-bottom: 0.5rem!important;'> <?php echo $row['pulse'] ?></td>
                </tr>

                <?php
            }
            ?>
            </tbody>
        </table>

        <?php
    }else {

        echo " <h4 class='text-center'> Patient don't have a previous clinical information. </h4> ";

    }

} elseif (isset($_POST['lastDrugs'])){

    $patientID = mysqli_real_escape_string($con, $_POST['patientID']);

    $sql = "SELECT * FROM prescription WHERE patientID = '$patientID' ORDER BY prescriptionID DESC LIMIT 1";
    $query = mysqli_query($con, $sql);


    if ($result = mysqli_num_rows($query)){


        $row = mysqli_fetch_assoc($query);

        $prescriptionID = $row['prescriptionID'];

        $sqlA = "SELECT * FROM prescription_items WHERE patientID = '$patientID' && prescriptionID = '$prescriptionID'";
        $queryA = mysqli_query($con, $sqlA);

        if ($resultA = mysqli_num_rows($queryA)){
            ?>
            <table class="table table-flush">
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
            </table>
            <?php
        }

    }else {
        ?>
        <h4 class='text-center' style='padding-top: 5px!important; padding-bottom: 5px!important;'> Patient don't have a previous drug information. </h4>
        <?php
    }

} elseif (isset($_POST['patientRecords'])){

    $patientID = mysqli_real_escape_string($con, $_POST['patientID']);

    $sql = "SELECT * FROM visited_dates_patient WHERE patientID = '$patientID'";
    $query = mysqli_query($con, $sql);

    if ($result = mysqli_num_rows($query)){
        ?>
        <div class="table-responsive pt-1">
            <table class="table table-flush">
                <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($query)){

                    $date_data = $row['date'];
                    $date = date("l, jS F, Y", strtotime($date_data));
                    $time_data = $row['time'];
                    $time = date("h:i A", strtotime($time_data));

                    ?>
                    <tr>
                        <td class="font-weight-bold py-2"> <?php echo $date ?></td>
                        <td class="py-2"> <?php echo $time ?></td>
                        <td class="py-2">
                            <a href="#!" class="btn btn-sm btn-info w-100"> view </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>

        <?php
    } else {

        echo "<h4 class='font-weight-bold text-center text-capitalize pt-1'> no data available at the moment</h4>";

    }

} elseif (isset($_POST['labRecords'])){

    $patientID = mysqli_real_escape_string($con, $_POST['patientID']);

    $sql = "SELECT * FROM lab_report WHERE patientID = '$patientID'";
    $query = mysqli_query($con, $sql);

    if ($result = mysqli_num_rows($query)){
        ?>
        <div class="table-responsive pt-1">
            <table class="table table-flush">
                <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($query)){

                    $dateData = $row['date'];
                    $date = date("l, jS F, Y | H:i A", strtotime($dateData));

                    $timeData = $row['time'];
                    $time = date("h:i A", strtotime($timeData));

                    ?>
                    <tr>
                        <td class="font-weight-bold py-2"> <?php echo $date ?></td>
                        <td class="font-weight-bold py-2"> <?php echo $time ?></td>
                        <td class="py-2">
                            <a href="#!" class="btn btn-sm btn-info w-100"> view </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>

        <?php
    } else {

        echo "<h4 class='font-weight-bold text-center text-capitalize pt-1'> no data available at the moment</h4>";

    }

} elseif (isset($_POST['labRecordsToday'])){

    date_default_timezone_set("Africa/Accra");
    $dateCheck = date("Y-m-d");

    $patientID = mysqli_real_escape_string($con, $_POST['patientID']);

    $sql = "SELECT * FROM lab_report WHERE patientID = '$patientID' && date = '$dateCheck'";
    $query = mysqli_query($con, $sql);

    if ($result = mysqli_num_rows($query)){
        ?>
        <div class="table-responsive pt-1">
            <table class="table table-flush">
                <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($query)){

                    $timeData = $row['time'];
                    $time = date("h:i A", strtotime($timeData));

                    ?>
                    <tr>
                        <td class="font-weight-bold py-2"> <?php echo $time ?></td>
                        <td class="py-2">
                            <a href="#!" class="btn btn-sm btn-info w-100"> view </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>

        <?php
    } else {

        echo "<h4 class='font-weight-bold text-center text-capitalize pt-1'> no data available at the moment</h4>";

    }

} elseif (isset($_POST['requestBody'])){

    $patientID = mysqli_real_escape_string($con, $_POST['patientID']);

    $sql = "SELECT * FROM lab_request WHERE patientID = '$patientID'";
    $query = mysqli_query($con, $sql);

    if ($result = mysqli_num_rows($query)){
        ?>

        <div class="card-body py-2">
            <h3 class='text-center'> Patient is awaiting lab report </h3>
        </div>

        <?php
    } else {
        ?>

        <div class="card-body py-2">
            <div class="form-row mb-1">
                <?php
                $sql = "SELECT * FROM lab_items";
                $query = mysqli_query($con, $sql);

                if ($result = mysqli_num_rows($query)){

                    while ($row = mysqli_fetch_assoc($query)){
                        ?>
                        <div class="col-md-6">
                            <div class="custom-control custom-checkbox mb-2">
                                <input class="custom-control-input requestItem" id="<?php echo $row['itemName']  ?>" type="checkbox" value="<?php echo $row['itemName']  ?>">
                                <label class="custom-control-label text-capitalize" for="<?php echo $row['itemName']  ?>">
                                    <span><?php echo $row['itemName']  ?></span>
                                </label>
                            </div>
                        </div>
                        <?php
                    }

                }
                ?>
            </div>
        </div>
        <div class="card-footer px-5 py-0">
            <button type="submit" class="btn btn-primary my-2 btn-sm btn-block">Make Request</button>
        </div>

        <?php
    }

} elseif (isset($_POST['labRequest'])){

    $sql = "SELECT * FROM lab_request";
    $query = mysqli_query($con, $sql);

    if ($result = mysqli_num_rows($query)) {
        ?>
        <thead class="thead-light">
        <tr>
            <th scope="col">Patient Name</th>
            <th scope="col">Requested By</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($query)) {
            ?>
            <tr>
                <td class="text-capitalize font-weight-bold">
                    <?php echo $row['patientName'] ?>
                </td>
                <td class="text-capitalize font-weight-bold">
                    <?php echo $row['staffName'] ?>
                </td>
                <td>
                    <a href="lab_perform.php?reference=<?php echo $row['requestID'] ?>" class="btn btn-sm btn-info btn-block"
                       id="<?php echo $row['patientID'] ?>" onclick="loading();"> Log In </a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
        <?php
    }else {
        ?>
        <h3 class="text-center">No data available at the moment</h3>
        <?php
    }

} elseif (isset($_POST['labRecordsTodayNoPatient'])){

    date_default_timezone_set("Africa/Accra");
    $dateCheck = date("Y-m-d");

    $sql = "SELECT * FROM lab_report WHERE date = '$dateCheck'";
    $query = mysqli_query($con, $sql);

    if ($result = mysqli_num_rows($query)){
        ?>
        <div class="table-responsive pt-1">
            <table class="table table-flush">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Patient Name</th>
                    <th scope="col">Time</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($query)){

                    $timeData = $row['time'];
                    $time = date("h:i A", strtotime($timeData));
                    $reference = $row['reportID'];

                    ?>
                    <tr>
                        <td class="text-capitalize font-weight-bold">
                            <?php echo $row['patientName'] ?>
                        </td>
                        <td class="font-weight-bold py-2"> <?php echo $time ?></td>
                        <td class="py-2">
                            <a href="view.php?reference=<?php echo $reference ?>" class="btn btn-sm btn-info w-100"> view </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>

        <?php
    } else {

        echo "<h4 class='font-weight-bold text-center text-capitalize pt-1'> no data available at the moment</h4>";

    }

}

