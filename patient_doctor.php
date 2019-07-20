<?php

session_start();

include "includes/inc.database.php";

$patientID = $_SESSION['patientID'];

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="The clinic of satisfaction">
    <meta name="author" content="The UENR Team">
    <title>Patient Doctor</title>

    <!-- Favicon -->
    <link href="./assets/img/brand/favicon.png" rel="icon" type="image/png">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Icons -->
    <link href="./assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Argon CSS -->
    <link type="text/css" href="./assets/css/argon.css?v=1.0.0" rel="stylesheet">

    <!--  Perfect Scroll  -->
    <script src="assets/js/perfect-scrollbar.js"></script>
    <link type="text/css" href="assets/css/perfect-scrollbar.css" rel="stylesheet">

    <style>
        .invisible {
            display: none !important;
        }

        .visible {
            display: block !important;
        }

        .change, .wrong, .waiting {
            display: none;
        }

        .modal-content hr:last-child, .modal-content hr:only-child {
            display: none !important;
            opacity: 0;
        }

        #drug_list tr th, #drug_list tr td, #lab_list tr th, #lab_list tr td {
            padding-bottom: 0.3rem !important;
            padding-top: 0.5rem !important;
        }

        .ripple-container {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
            border-radius: inherit;
        }

        .notification {
            top: -13px !important;
            position: absolute;
            right: 12px !important;
            min-width: 20px !important;
            box-shadow: 0 0 3px 3px rgba(50, 50, 93, .2), 0 0 2px 2px rgba(0, 0, 0, .1);
            background: linear-gradient(87deg, #f7fafc 0, #f7f8fc 100%) !important;
            color: #172b4d !important;
            border-radius: .375rem !important;
            padding: 0.25rem;
        }
    </style>

</head>

<body>

<input type="hidden" value="<?php echo $patientID ?>" id="patientID">

<!--  Past Records  -->
<div class="modal fade" id="patientRecords_modal" tabindex="-1" role="dialog" aria-labelledby="patientRecords_modal"
     aria-hidden="true">
    <div class="modal-dialog modal-" role="document">
        <div class="modal-content" style="max-height: 510px!important;">
            <div class="pt-2 pb-1 shadow">
                <h3 class="text-center pt-1">Patient's Records</h3>
            </div>
            <div id="patientRecords" style="max-height: 470px!important; position:relative;">
            </div>
        </div>
    </div>
</div>

<!--  lab report today  -->
<div class="modal fade" id="labRecordsToday_modal" tabindex="-1" role="dialog" aria-labelledby="labRecordsToday_modal"
     aria-hidden="true">
    <div class="modal-dialog modal-" role="document">
        <div class="modal-content" style="max-height: 510px!important;">
            <div class="pt-2 pb-1 shadow">
                <h3 class="text-center pt-1">Today's report</h3>
            </div>
            <div id="labRecordsToday" style="max-height: 470px!important; position:relative;">
            </div>
        </div>
    </div>
</div>

<!--  lab reports  -->
<div class="modal fade" id="labRecords_modal" tabindex="-1" role="dialog" aria-labelledby="labReport_modal"
     aria-hidden="true">
    <div class="modal-dialog modal-" role="document">
        <div class="modal-content" style="max-height: 510px!important;">
            <div class="pt-2 pb-1 shadow">
                <h3 class="text-center pt-1">Patient's Lab Reports</h3>
            </div>
            <div id="labRecords" style="max-height: 470px!important; position:relative;">
            </div>
        </div>
    </div>
</div>

<!--   authentication modal   -->
<div class="modal fade" id="authentication" tabindex="-1" role="dialog" aria-labelledby="authentication" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-" role="document">
        <div class="modal-content bg-secondary ml-auto mr-auto" style="max-width: 130px!important;" id="checking">
            <div class="modal-body" style="padding: 1.2rem 0.8rem">
                <div class="text-center">
                    <i class="fa fa-spinner fa-4x fa-pulse fa-fw text-warning" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="modal-content bg-secondary ml-auto mr-auto invisible" style="max-width: 130px!important;" id="success">
            <div class="modal-body" style="padding: 1.2rem 0.8rem">
                <div class="text-center">
                    <i class="ni ni-like-2 ni-4x text-success" aria-hidden="true"></i>

                </div>
            </div>
        </div>
        <div class="modal-content bg-secondary ml-auto mr-auto invisible" style="max-width: 130px!important;" id="wrong">
            <div class="modal-body" style="padding: 1.2rem 0.8rem">
                <div class="text-center">
                    <i class="fa fa-close fa-4x text-danger font-weight-light" aria-hidden="true"></i>

                </div>
            </div>
        </div>
    </div>
</div>

<!--  making a lab request modal -->
<div class="modal fade" id="labRequest_modal" tabindex="-1" role="dialog" aria-labelledby="labRequest_modal" aria-hidden="true">
    <div class="modal-dialog modal-" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">Lab Request</h6>
                                <h3 class="mb-0">Making a lab request</h3>
                            </div>
                        </div>
                    </div>
                    <form method="post" id="requestForm">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Main content -->
<div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="h4 mb-0 text-white text-capitalize d-none d-lg-inline-block" href="main.html">Patient
                | <?php echo "<span class='text-capitalize'>". $_SESSION['surname'] . " " . $_SESSION['firstName'] . " " . $_SESSION['otherName'] ."</span>"  ?> Dashboard</a>

            <!-- User -->
            <ul class="navbar-nav align-items-center d-none d-md-flex">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="./assets/img/theme/team-4-800x800.jpg">
                </span>
                            <div class="media-body ml-2 d-none d-lg-block">
                                <span class="mb-0 text-sm  font-weight-bold text-capitalize"><?php echo $_SESSION['staffName'] ?></span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                        <div class=" dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome!</h6>
                        </div>
                        <a href="./examples/profile.html" class="dropdown-item">
                            <i class="ni ni-single-02"></i>
                            <span>My profile</span>
                        </a>
                        <a href="./examples/profile.html" class="dropdown-item">
                            <i class="ni ni-settings-gear-65"></i>
                            <span>Settings</span>
                        </a>
                        <a href="./examples/profile.html" class="dropdown-item">
                            <i class="ni ni-calendar-grid-58"></i>
                            <span>Activity</span>
                        </a>
                        <a href="./examples/profile.html" class="dropdown-item">
                            <i class="ni ni-support-16"></i>
                            <span>Support</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#!" class="dropdown-item">
                            <i class="ni ni-user-run"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>


    <!-- Header -->
    <div class="header bg-gradient-primary pb-6 pt-5 pt-md-8">
    </div>

    <!--<canvas id="chart-patient" class="chart-canvas"></canvas>-->
    <!-- Page content -->
    <div class="container-fluid mt--7">
        <div class="row">

            <div class="col-xl-4 mb-5 mb-xl-0">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="card shadow bg-secondary">
                            <div class="card-header" style="padding-bottom: 0.5rem!important; padding-top: 0.5rem!important;">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="text-uppercase text-muted ls-1 mb-1">Clinical Info</h6>
                                        <h3 class="mb-0">Nurse's observations</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body"
                                 style="padding-top: 0.5rem!important; padding-bottom: 0.5rem!important;">
                                <!-- Chart -->
                                <div class="table-responsive">
                                    <table class="table table-flush">
                                        <tbody id="lastClinical">

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card shadow bg-secondary">
                            <div class="card-header bg-white" style="padding-bottom: 0.5rem!important; padding-top: 0.5rem!important;">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="text-uppercase text-muted ls-1 mb-1">Treatments</h6>
                                        <h3 class="mb-0">Doctor's Observation</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body py-1" style="min-height: 120px!important;">
                                <div>
                                    <div class="mb-1">
                                        <textarea type="text" class="form-control form-control-alternative" id="observation"
                                                  required name="Observation" style="height: 125px"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-secondary">
                                <button class="btn btn-success btn-block btn-sm" id="add"><i class="fa fa-check"></i> Insert Observation & Drugs
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-4 mb-5 mb-xl-0">
                <div class="row">
                    <div class="col-xl-12 col-md-6 mb-3">
                        <div class="card shadow bg-secondary">
                            <div class="card-header bg-white" style="padding-bottom: 0.5rem!important; padding-top: 0.5rem!important;">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="text-uppercase text-muted ls-1 mb-1">Treatments</h6>
                                        <h3 class="mb-0">Drugs Selections</h3>
                                    </div>
                                </div>
                            </div>
                            <form id="selecting_drug_form">
                                <div class="card-body py-1" style="min-height: 100px!important;">
                                    <div class="form-row">
                                        <div class="col-lg-12 mb-2">
                                            <div class="form-group mb-1">
                                                <select class="form-control form-control-alternative insert" name="drug"
                                                        id="drug" onchange="myFunction()" style="padding-top: 0.15rem; padding-bottom: 0.15rem; height: 35px">
                                                    <?php

                                                    $sql = "SELECT * FROM drugs";
                                                    $query = mysqli_query($con, $sql);
                                                    if ($result = mysqli_num_rows($query)) {
                                                        ?>
                                                        <option value="" selected> Please select drug</option>
                                                        <?php
                                                        while ($row = mysqli_fetch_assoc($query)) {
                                                            ?>

                                                            <option id="drug_name" data-id="<?php echo $row['drugID'] ?>"
                                                                    data-times="<?php echo $row['dosageTimes'] ?>"
                                                                    data-quantity="<?php echo $row['dosageQuantity'] ?>"
                                                                    value="" data-name="<?php echo $row['drugName'] ?>"
                                                                    class="text-capitalize"
                                                                    data-many="<?php echo $row['quantity'] ?>"> <?php echo $row['drugName'] ?> </option>

                                                            <?php
                                                        }
                                                    } else {
                                                        ?>

                                                        <option value="" selected disabled> No drugs available</option>

                                                        <?php
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group mb-1">
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control form-control-alternative"
                                                               placeholder="Dosage" value="" id="dosage_quantity" style="height: 35px">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <input type="number" class="form-control form-control-alternative"
                                                               placeholder="Dosage" value="" id="dosage_times" style="height: 35px">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                        <input type="hidden" id="drugID" value="">
                                        <input type="hidden" id="drug_quantity" value="">
                                    </div>
                                </div>
                                <div class="card-footer bg-secondary py-2">
                                    <button class="btn btn-success btn-block btn-sm" type="submit"><i class="fa fa-check"></i> Select </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-xl-12 col-md-6 mb-3">
                        <div class="card shadow bg-secondary">
                            <div class="card-header bg-white"
                                 style="padding-bottom: 0.5rem!important; padding-top: 0.5rem!important;">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="text-uppercase text-muted ls-1 mb-1">Prescriptions</h6>
                                        <h3 class="mb-0">Selected Drugs</h3>
                                    </div>
                                </div>
                            </div>
                            <!-- Chart -->
                            <div class="table-responsive" id="table_has_content">
                                <table class="table table-flush">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Drug</th>
                                        <th>Dosage</th>
                                        <th>Clear</th>
                                    </tr>
                                    </thead>
                                    <tbody id="drug_list">

                                    </tbody>
                                </table>
                            </div>

                            <div class="py-2 invisible" id="table_has_no_content">
                                <h4 class="text-capitalize text-center">No data available. <span class="font-weight-bold">select a drug.</span></h4>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

            <div class="col-xl-4 mb-5">
                <div class="row">

                    <div class=" col-xl-12 col-md-4 mb-3">
                        <div class="card shadow bg-secondary">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="text-uppercase text-muted ls-1 mb-1">Patient Info</h6>
                                        <h2 class="mb-0">Patient's clinical Info</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" style="padding: 1rem 0.5rem!important;">
                                <div class="col text-center">
                                    <a href="#!" class="btn btn-sm btn-primary btn-block" data-toggle="modal"
                                       data-target="#patientRecords_modal">See all clinical <span class="notification" id="patientRecordsBadge" onclick="patientRecords();">
                                        </span></a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class=" col-xl-12 col-md-4 mb-3">
                        <div class="card shadow bg-secondary">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="text-uppercase text-muted ls-1 mb-1">Laboratory</h6>
                                        <h2 class="mb-0">Patient's Lab Reports</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" style="padding: 1rem 1.9rem!important;">
                                <div class="row text-center">
                                    <a href="#!" class="btn btn-sm btn-default mb-1 col" data-target="#labRecordsToday_modal" data-toggle="modal" onclick="labRecordsToday();">Today's Report <span class="notification" id="labRecordsTodayBadge"></span></a>

                                    <a href="#!" class="btn btn-sm btn-primary mb-1 col" data-target="#labRecords_modal" data-toggle="modal" onclick="labRecords();">See Reports <span class="notification" id="labRecordsBadge">
                                        </span></a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class=" col-xl-12 col-md-4">
                        <div class="card shadow bg-secondary">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="text-uppercase text-muted ls-1 mb-1">Laboratory</h6>
                                        <h2 class="mb-0">Request Lab Report</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" style="padding: 1rem 1.9rem!important;">
                                <div class="row text-center">
                                    <a href="#!" class="btn btn-sm btn-primary col mb-1" data-toggle="modal"
                                       data-target="#labRequest_modal">Request</a>

                                    <a href="#!" class="btn btn-sm btn-default mb-1 col" data-target="#labReport_modal" data-toggle="modal">Urine Test </a>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>
</div>
<!-- Argon Scripts -->
<!-- Core -->
<script src="./assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="./assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- Optional JS -->
<script src="./assets/vendor/chart.js/dist/Chart.min.js"></script>
<script src="./assets/vendor/chart.js/dist/Chart.extension.js"></script>
<script src="./assets/js/charts.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<script src="assets/js/notifications.js"></script>
<!-- Argon JS -->
<script src="./assets/js/argon.js?v=1.0.0"></script>

<script>
    $(document).ready(function () {
        checking_drug();
    });
</script>

<script>
    new PerfectScrollbar('html')
</script>

<script>

    function myFunction() {
        var drugID = $('#drug').find(':selected').data('id');
        var dosage_times = $('#drug').find(':selected').data('times');
        var dosage_quantity = $('#drug').find(':selected').data('quantity');
        var drugName = $('#drug').find(':selected').data('name');
        var drug_quantity = $('#drug').find(':selected').data('many');


        $('#drugID').val(drugID);
        $('#dosage_quantity').val(dosage_quantity);
        $('#dosage_times').val(dosage_times);
        $('#drug_name').val(drugName);
        $('#drug_quantity').val(drug_quantity);


    }

    $('#selecting_drug_form').on('submit', function (e) {

        e.preventDefault();

        var table = document.getElementById("drug_list");
        var drugName = $('#drug').find(':selected').data('name');

        if ($('#dosage_times').val() == '' || drugName == '') {

            alert("Please select a drug first!");

        } else {

            $('#table_has_no_content').addClass('invisible');
            $('#table_has_content').removeClass('invisible');

            var newRow = table.insertRow(table.length);
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);


            cell1.innerHTML = "<tr>" + "<th>" + $('#drug_name').val() + "</th>" + " <input type='hidden' value='" + $('#drug_name').val() + "' class='drugName'>" + " <input type='hidden' value='" + $('#drugID').val() + "' class='drugID'>" + "</tr>";

            cell2.innerHTML = "<tr>" + "<td>" + $('#dosage_quantity').val() + " x " + $('#dosage_times').val() + "</td>" + " <input type='hidden' value='" + $('#dosage_quantity').val() + "' class='dosage_quantity'>" + " <input type='hidden' value='" + $('#dosage_times').val() + "' class='dosage_times'>" + " <input type='hidden' value='" + $('#drug_quantity').val() + "' class='drug_quantity'>" + "</tr>";

            cell3.innerHTML = "<tr><td> <button class='btn btn-danger btn-sm delete' rel='tooltip' title='' data-placement='bottom' data-original-title='Delete Item'><i class='fa fa-trash'></i></button></td></tr>";


        }

    });


    $(document).on("click", ".delete", function () {
        $(this).parents("tr").remove();

        checking_drug();
    });

    $(document).on('click', '#select_item', function () {

        if ($('#lab_items').find(':selected').data('value') == '') {
            alert("Please select a drug first!");
        } else {

            var table = document.getElementById("lab_list");
            var newRow = table.insertRow(table.length);
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);


            cell1.innerHTML = "<tr>" + "<th>" + $('#lab_items').val() + "</th>" + " <input type='hidden' value='" + $('#lab_items').val() + "' class='lab_item'>" + "</tr>";

            cell2.innerHTML = "<tr><td> <button class='btn btn-danger btn-sm delete-item' rel='tooltip' title='' data-placement='bottom' data-original-title='Delete Item'><i class='fa fa-trash'></i></button></td></tr>";


        }

    });

    $(document).on("click", ".delete-item", function () {
        $(this).parents("tr").remove();
    });
</script>

<script>
    $(document).on('click', '#add', function () {

        if ($('#observation').val() == '' || $('#drug_list').html() == '') {

            alert('Your observation or drug list seems to be empty')

        } else {
            $('#modal-auth').modal('show');

            var observation = $('#observation').val();
            var drugName = [];
            var dosage_quantity = [];
            var dosage_times = [];
            var drug_quantity = [];
            var drugID = [];
            var patientID = $('#patientID').val();

            $('.drugName').each(function () {
                drugName.push($(this).val())
            });

            $('.dosage_quantity').each(function () {
                dosage_quantity.push($(this).val())
            });

            $('.dosage_times').each(function () {
                dosage_times.push($(this).val())
            });

            $('.drugID').each(function () {
                drugID.push($(this).val())
            });

            $('.drug_quantity').each(function () {
                drug_quantity.push($(this).val())
            });

            $.ajax({

                url: "includes/inc.processes.php",
                method: "POST",
                data: {

                    "treatment": "treatment",
                    "patientID": patientID,
                    "observation": observation,
                    "drugName": drugName,
                    "dosage_times": dosage_times,
                    "drug_quantity": drug_quantity,
                    "dosage_quantity": dosage_quantity,
                    "drugID": drugID

                },

                success: function (data) {
                    if (data == "SUCCESS") {

                        $('#checking').addClass('invisible');
                        $('#wrong').addClass('invisible');
                        $('#success').removeClass('invisible');

                        $('#drug_list').html('');
                        $('#observation').val('');
                        setTimeout('$("#modal-auth").modal("hide")', 1000);

                    } else if (data == 'WAITING') {

                        $('#checking').addClass('invisible');
                        $('#success').addClass('invisible');
                        $('#wrong').removeClass('invisible');

                        setTimeout("$('#modal-auth').modal('hide')", 2000);
                    } else {

                        $('#checking').addClass('invisible');
                        $('#success').addClass('invisible');
                        $('#wrong').removeClass('invisible');

                        setTimeout("$('#modal-auth').modal('hide')", 1000);

                    }
                }
            });


        }

    });

    $('#requestForm').on('submit', function (e) {
        e.preventDefault();

        var requestItem = [];
        var patientID = $('#patientID').val();

        $('.requestItem').each(function () {
            if ($(this).is(":checked")) {

                requestItem.push($(this).val());

            }
        });

        /*requestItem = requestItem.toString();*/

        if (requestItem[0] === undefined){
            notification.emptyRequest('top', 'right');
        } else {

            $('#labRequest_modal').modal('hide');

            $('#authentication').modal('show');

            $.ajax({

                url: "includes/inc.processes.php",
                method: "POST",
                data: {
                    "labRequest": "labRequest",
                    "requestItem": requestItem,
                    "patientID": patientID

                },

                success: function (data) {
                    if (data == "SUCCESS") {

                        $('#checking').addClass('invisible');
                        $('#wrong').addClass('invisible');
                        $('#success').removeClass('invisible');

                        requestBody();

                        notification.labRequestSuccess('top', 'right');

                        setTimeout('$("#authentication").modal("hide")', 1500);


                    }else if (data == 'WAITING') {

                        $('#checking').addClass('invisible');
                        $('#success').addClass('invisible');
                        $('#wrong').removeClass('invisible');
                        setTimeout("$('#authentication').modal('hide')", 1000);

                    }else {

                        $('#checking').addClass('invisible');
                        $('#success').addClass('invisible');
                        $('#wrong').removeClass('invisible');
                        setTimeout("$('#authentication').modal('hide')", 1000);

                    }
                }

            })
        }
    });

</script>

<script>

    $(document).ready(function () {

        lastClinical();
        lastDrugs();
        patientRecords();
        labRecords();
        patientRecordsBadge();
        labRecordsBadge();
        labRecordsTodayBadge();
        requestBody();

    });

    setInterval(function () {
        patientRecordsBadge();
        labRecordsBadge();
        labRecordsTodayBadge();
    }, 1000);

    function lastClinical() {
        var patientID  = $('#patientID').val();

        $.ajax({

            url: "includes/inc.loads.php",
            method: "POST",
            data: {
                "lastClinical": "lastClinical",
                "patientID": patientID
            },

            success: function (data) {

                $('#lastClinical').html(data);

            }

        })

    }


    function lastDrugs() {
        var patientID  = $('#patientID').val();

        $.ajax({

            url: "includes/inc.loads.php",
            method: "POST",
            data: {
                "lastDrugs": "lastDrugs",
                "patientID": patientID
            },

            success: function (data) {

                $('#lastDrugs').html(data);

            }
        })
    }


    function patientRecords() {

        var patientID = $('#patientID').val();

        $.ajax({
            url: "includes/inc.loads.php",
            method: "POST",
            data: {
                "patientRecords": "patientRecords",
                "patientID": patientID
            },

            success: function (data) {
                $('#patientRecords').html(data);
            }
        })
    }

    function labRecords() {
        var patientID = $('#patientID').val();

        $.ajax({
            url: "includes/inc.loads.php",
            method: "POST",
            data: {
                "labRecords": "labRecords",
                "patientID": patientID
            },

            success: function (data) {
                $('#labRecords').html(data);
            }
        })
    }

    function labRecordsToday() {
        var patientID = $('#patientID').val();

        $.ajax({
            url: "includes/inc.loads.php",
            method: "POST",
            data: {
                "labRecordsToday": "labRecordsToday",
                "patientID": patientID
            },

            success: function (data) {
                $('#labRecordsToday').html(data);
            }
        })
    }

    function requestBody() {
        var patientID = $('#patientID').val();

        $.ajax({
            url: "includes/inc.loads.php",
            method: "POST",
            data: {
                "requestBody": "requestBody",
                "patientID": patientID
            },

            success: function (data) {
                $('#requestForm').html(data);
            }
        })
    }


    /*  Badges */
    function patientRecordsBadge() {

        var patientID  = $('#patientID').val();

        $.ajax({

            url: "includes/inc.badge.php",
            method: "POST",
            data: {
                "patientRecords": "patientRecords",
                "patientID": patientID
            },

            success: function (data) {

                $('#patientRecordsBadge').html(data);
            }

        })
    }

    function labRecordsBadge() {

        var patientID  = $('#patientID').val();

        $.ajax({

            url: "includes/inc.badge.php",
            method: "POST",
            data: {
                "labRecords": "labRecords",
                "patientID": patientID
            },

            success: function (data) {

                $('#labRecordsBadge').html(data);
            }

        })
    }

    function labRecordsTodayBadge() {

        var patientID  = $('#patientID').val();

        $.ajax({

            url: "includes/inc.badge.php",
            method: "POST",
            data: {
                "labRecordsToday": "labRecordsToday",
                "patientID": patientID
            },

            success: function (data) {

                $('#labRecordsTodayBadge').html(data);
            }

        })
    }


</script>

<script>
    function checking_drug() {

        var table = document.getElementById("drug_list");

        if (table.rows.length < 1) {
            $('#table_has_no_content').removeClass('invisible');
            $('#table_has_content').addClass('invisible');

        }else {

            $('#table_has_no_content').addClass('invisible');
            $('#table_has_content').removeClass('invisible');
        }

    }
</script>

</body>
</html>