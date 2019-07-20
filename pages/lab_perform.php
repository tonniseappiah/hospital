<?php

session_start();

include "includes/inc.database.php";

if (!isset($_GET['reference'])){

    header("Location: lab_tech.php");

} else {

    $requestID = $_GET['reference'];

    $sql = "SELECT * FROM lab_request WHERE requestID = '$requestID'";
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($query);

    $patientID = $row['patientID'];
    $patientName = $row['patientName'];
    $requestStaffID = $row['staffID'];
    $requestStaffName = $row['staffName'];
    $requestDate = $row['date'];
    $requestTime = $row['time'];


    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="The clinic of satisfaction">
        <meta name="author" content="The UENR Team">
        <title>Performing Lab</title>

        <!-- Favicon -->
        <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

        <!-- Icons -->
        <link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <link href="../assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">

        <!-- Argon CSS -->
        <link type="text/css" href="../assets/css/argon.css?v=1.0.0" rel="stylesheet">


        <style>
            .table tbody th, .table tbody td {
                padding-bottom: 0.5rem;
                padding-top: 0.5rem;
            }

            .invisible {
                display: none !important;
            }

            .visible {
                display: block !important;
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

            .request {
                max-height: 360px !important;
            }
        </style>

    </head>

    <body>

    <!-- Lab Request -->
    <div class="modal fade" id="labRequest_modal" tabindex="-1" role="dialog" aria-labelledby="labRequest_modal"
         aria-hidden="true">
        <div class="modal-dialog modal- modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title-request">Lab Requests</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="labRequest"></table>
                </div>
                <div class="modal-footer py-2" style="border-top: 1px solid #e9ecef">
                    <button type="button" class="btn btn-primary mr-auto btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Lab Request urine -->
    <div class="modal fade" id="urine_request" tabindex="-1" role="dialog" aria-labelledby="urine_request"
         aria-hidden="true">
        <div class="modal-dialog modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title-request">Urine Requests</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <?php
                        $sql = "SELECT * FROM urine_request";
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
                                        <a href="#" class="btn btn-sm btn-primary btn-block"
                                           id="<?php echo $row['patientID'] ?>"> Log In </a>
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
                        ?>
                    </table>
                </div>
                <div class="modal-footer py-2" style="border-top: 1px solid #e9ecef">
                    <button type="button" class="btn btn-primary mr-auto btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" value="<?php echo $patientID   ?>" id="patientID">
    <input type="hidden" value="<?php echo $patientName   ?>" id="patientName">
    <input type="hidden" value="<?php echo $requestStaffID  ?>" id="requestStaffID">
    <input type="hidden" value="<?php echo $requestStaffName   ?>" id="requestStaffName">
    <input type="hidden" value="<?php echo $requestDate   ?>" id="requestDate">
    <input type="hidden" value="<?php echo $requestTime   ?>" id="requestTime">
    <!--  authentication modal  -->
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

    <!-- Lab Performed -->
    <div class="modal fade" id="modal-finish" tabindex="-1" role="dialog" aria-labelledby="modal-finish"
         aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal- modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title-finish">Finished Lab Reports</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Project</th>
                            <th scope="col">Budget</th>
                            <th scope="col">Status</th>
                            <th scope="col">Users</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="mb-0 text-sm">Argon Design System</span>
                                    </div>
                                </div>
                            </th>
                            <td>
                                $2,500 USD
                            </td>
                            <td>
                            <span class="badge badge-dot mr-4">
                              <i class="bg-warning"></i> pending
                            </span>
                            </td>
                            <td>
                                <div class="avatar-group">
                                    <a href="#" class="avatar avatar-sm" data-toggle="tooltip"
                                       data-original-title="Ryan Tompson">
                                        <img alt="Image placeholder" src="../assets/img/theme/team-1-800x800.jpg"
                                             class="rounded-circle">
                                    </a>
                                    <a href="#" class="avatar avatar-sm" data-toggle="tooltip"
                                       data-original-title="Romina Hadid">
                                        <img alt="Image placeholder" src="../assets/img/theme/team-2-800x800.jpg"
                                             class="rounded-circle">
                                    </a>
                                    <a href="#" class="avatar avatar-sm" data-toggle="tooltip"
                                       data-original-title="Alexander Smith">
                                        <img alt="Image placeholder" src="../assets/img/theme/team-3-800x800.jpg"
                                             class="rounded-circle">
                                    </a>
                                    <a href="#" class="avatar avatar-sm" data-toggle="tooltip"
                                       data-original-title="Jessica Doe">
                                        <img alt="Image placeholder" src="../assets/img/theme/team-4-800x800.jpg"
                                             class="rounded-circle">
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="mb-0 text-sm">Argon Design System</span>
                                    </div>
                                </div>
                            </th>
                            <td>
                                $2,500 USD
                            </td>
                            <td>
                            <span class="badge badge-dot mr-4">
                              <i class="bg-warning"></i> pending
                            </span>
                            </td>
                            <td>
                                <div class="avatar-group">
                                    <a href="#" class="avatar avatar-sm" data-toggle="tooltip"
                                       data-original-title="Ryan Tompson">
                                        <img alt="Image placeholder" src="../assets/img/theme/team-1-800x800.jpg"
                                             class="rounded-circle">
                                    </a>
                                    <a href="#" class="avatar avatar-sm" data-toggle="tooltip"
                                       data-original-title="Romina Hadid">
                                        <img alt="Image placeholder" src="../assets/img/theme/team-2-800x800.jpg"
                                             class="rounded-circle">
                                    </a>
                                    <a href="#" class="avatar avatar-sm" data-toggle="tooltip"
                                       data-original-title="Alexander Smith">
                                        <img alt="Image placeholder" src="../assets/img/theme/team-3-800x800.jpg"
                                             class="rounded-circle">
                                    </a>
                                    <a href="#" class="avatar avatar-sm" data-toggle="tooltip"
                                       data-original-title="Jessica Doe">
                                        <img alt="Image placeholder" src="../assets/img/theme/team-4-800x800.jpg"
                                             class="rounded-circle">
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="mb-0 text-sm">Argon Design System</span>
                                    </div>
                                </div>
                            </th>
                            <td>
                                $2,500 USD
                            </td>
                            <td>
                            <span class="badge badge-dot mr-4">
                              <i class="bg-warning"></i> pending
                            </span>
                            </td>
                            <td>
                                <div class="avatar-group">
                                    <a href="#" class="avatar avatar-sm" data-toggle="tooltip"
                                       data-original-title="Ryan Tompson">
                                        <img alt="Image placeholder" src="../assets/img/theme/team-1-800x800.jpg"
                                             class="rounded-circle">
                                    </a>
                                    <a href="#" class="avatar avatar-sm" data-toggle="tooltip"
                                       data-original-title="Romina Hadid">
                                        <img alt="Image placeholder" src="../assets/img/theme/team-2-800x800.jpg"
                                             class="rounded-circle">
                                    </a>
                                    <a href="#" class="avatar avatar-sm" data-toggle="tooltip"
                                       data-original-title="Alexander Smith">
                                        <img alt="Image placeholder" src="../assets/img/theme/team-3-800x800.jpg"
                                             class="rounded-circle">
                                    </a>
                                    <a href="#" class="avatar avatar-sm" data-toggle="tooltip"
                                       data-original-title="Jessica Doe">
                                        <img alt="Image placeholder" src="../assets/img/theme/team-4-800x800.jpg"
                                             class="rounded-circle">
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="mb-0 text-sm">Argon Design System</span>
                                    </div>
                                </div>
                            </th>
                            <td>
                                $2,500 USD
                            </td>
                            <td>
                            <span class="badge badge-dot mr-4">
                              <i class="bg-warning"></i> pending
                            </span>
                            </td>
                            <td>
                                <div class="avatar-group">
                                    <a href="#" class="avatar avatar-sm" data-toggle="tooltip"
                                       data-original-title="Ryan Tompson">
                                        <img alt="Image placeholder" src="../assets/img/theme/team-1-800x800.jpg"
                                             class="rounded-circle">
                                    </a>
                                    <a href="#" class="avatar avatar-sm" data-toggle="tooltip"
                                       data-original-title="Romina Hadid">
                                        <img alt="Image placeholder" src="../assets/img/theme/team-2-800x800.jpg"
                                             class="rounded-circle">
                                    </a>
                                    <a href="#" class="avatar avatar-sm" data-toggle="tooltip"
                                       data-original-title="Alexander Smith">
                                        <img alt="Image placeholder" src="../assets/img/theme/team-3-800x800.jpg"
                                             class="rounded-circle">
                                    </a>
                                    <a href="#" class="avatar avatar-sm" data-toggle="tooltip"
                                       data-original-title="Jessica Doe">
                                        <img alt="Image placeholder" src="../assets/img/theme/team-4-800x800.jpg"
                                             class="rounded-circle">
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="mb-0 text-sm">Argon Design System</span>
                                    </div>
                                </div>
                            </th>
                            <td>
                                $2,500 USD
                            </td>
                            <td>
                            <span class="badge badge-dot mr-4">
                              <i class="bg-warning"></i> pending
                            </span>
                            </td>
                            <td>
                                <div class="avatar-group">
                                    <a href="#" class="avatar avatar-sm" data-toggle="tooltip"
                                       data-original-title="Ryan Tompson">
                                        <img alt="Image placeholder" src="../assets/img/theme/team-1-800x800.jpg"
                                             class="rounded-circle">
                                    </a>
                                    <a href="#" class="avatar avatar-sm" data-toggle="tooltip"
                                       data-original-title="Romina Hadid">
                                        <img alt="Image placeholder" src="../assets/img/theme/team-2-800x800.jpg"
                                             class="rounded-circle">
                                    </a>
                                    <a href="#" class="avatar avatar-sm" data-toggle="tooltip"
                                       data-original-title="Alexander Smith">
                                        <img alt="Image placeholder" src="../assets/img/theme/team-3-800x800.jpg"
                                             class="rounded-circle">
                                    </a>
                                    <a href="#" class="avatar avatar-sm" data-toggle="tooltip"
                                       data-original-title="Jessica Doe">
                                        <img alt="Image placeholder" src="../assets/img/theme/team-4-800x800.jpg"
                                             class="rounded-circle">
                                    </a>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #e9ecef">
                    <button type="button" class="btn btn-primary mr-auto" data-dismiss="modal">Close</button>
                    <nav aria-label="...">
                        <ul class="pagination justify-content-end mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">
                                    <i class="fas fa-angle-left"></i>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    <i class="fas fa-angle-right"></i>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
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


    <!-- Main content -->
    <div class="main-content">
        <!-- Top navbar -->
        <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
            <div class="container-fluid">
                <!-- Brand -->
                <a class="h4 mb-0 text-white text-capitalize d-none d-lg-inline-block " href="main.html">Patient | <?php echo $patientName ?> Dashboard</a>

                <!-- User -->
                <ul class="navbar-nav align-items-center d-none d-md-flex">
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="../assets/img/theme/team-4-800x800.jpg">
                </span>
                                <div class="media-body ml-2 d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold">Jessica Jones</span>
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


        <!-- Page content -->
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col-xl-8 mb-5 mb-xl-0">

                    <form id="labPerformForm" method="post">
                        <div class="card shadow mb-2">
                            <div class="card-header bg-transparent">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="text-uppercase text-muted ls-1 mb-1">
                                            Lab Items
                                        </h6>
                                        <h2 class="mb-0">Requested Lab Items</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Chart -->
                                <div class="request">
                                    <div class="row">
                                        <?php
                                        $sql = "SELECT * FROM lab_request_items WHERE requestID = '$requestID'";
                                        $query = mysqli_query($con, $sql);

                                        while ($row = mysqli_fetch_assoc($query)){
                                            ?>
                                            <div class="col-md-6 mb-2">
                                                <h4 style="float: left; margin-top: 2px; margin-bottom: 0.4rem" class="text-capitalize"><?php echo $row['requestedItem']  ?></h4>
                                                <input type="hidden" value="<?php echo $row['requestedItem']  ?>" class="labItem">
                                                <input type="text"
                                                       class="form-control py-1 form-control-alternative labItemValue"
                                                       style="max-width: 60%; float: right; height: 30px;" value="" required>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow">
                            <div class="card-body text-right">
                                <button type="submit" class="btn btn-sm btn-info w-25"> Submit</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-xl-4 container">
                    <div class="row">

                        <div class="col-md-12 mb-3">
                            <div class="card shadow">
                                <div class="card-header bg-transparent">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="text-uppercase text-muted ls-1 mb-1">Finished</h6>
                                            <h2 class="mb-0">Lab Records</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="padding: 1rem 1.9rem!important;">
                                    <a href="#!" class="btn btn-sm mb-1 btn-block btn-primary" data-toggle="modal" data-target="#labRecords_modal" onclick="labRecords()"> View All Records <span class="notification" id="labRecordsBadge"></span></a>

                                </div>
                            </div>
                        </div>


                        <div class="col-md-12 mb-3">
                            <div class="card shadow">
                                <div class="card-header bg-transparent">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="text-uppercase text-muted ls-1 mb-1">Pending Request</h6>
                                            <h2 class="mb-0">Requested Lab Reports</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="padding: 1rem 1.9rem!important;">
                                    <div class="row text-center">
                                        <a href="#!" class="btn btn-sm btn-primary col mb-1" data-toggle="modal"
                                           data-target="#labRequest_modal" onclick="labRequest()">View Pending request
                                            <span class="notification" id="labRequestBadge"></span></a>

                                        <a href="#!" class="btn btn-sm btn-default col mb-1" data-toggle="modal" data-target="#urine_request">View Urine request
                                            <span class="notification" id="urineRequestBadge"></span></a>
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
    <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Optional JS -->
    <script src="../assets/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="../assets/vendor/chart.js/dist/Chart.extension.js"></script>
    <script src="../assets/js/charts.js"></script>
    <!--  Notifications Plugin    -->
    <script src="../assets/js/plugins/bootstrap-notify.js"></script>
    <script src="../assets/js/notifications.js"></script>

    <!-- Argon JS -->
    <script src="../assets/js/argon.js?v=1.0.0"></script>

    <script>
        $('#labPerformForm').on('submit', function (e) {
            e.preventDefault();

            $('#authentication').modal('show');

            var patientID = $('#patientID').val();
            var patientName = $('#patientName').val();
            var requestStaffName = $('#requestStaffName').val();
            var requestStaffID = $('#requestStaffID').val();
            var requestDate = $('#requestDate').val();
            var requestTime = $('#requestTime').val();

            var labItem = [];
            var labItemValue = [];

            $('.labItem').each(function () {
                labItem.push($(this).val());
            });

            $('.labItemValue').each(function () {
                labItemValue.push($(this).val());
            });

            $.ajax({

                url: "includes/inc.processes.php",
                method: "POST",
                data: {
                    "labPerform": "labPerform",
                    "labItem": labItem,
                    "labItemValue": labItemValue,
                    "patientID": patientID,
                    "patientName": patientName,
                    "requestStaffID": requestStaffID,
                    "requestDate": requestDate,
                    "requestTime": requestTime,
                    "requestStaffName": requestStaffName
                },

                success: function (data) {
                    if (data == "SUCCESS") {

                        $('#checking').addClass('invisible');
                        $('#wrong').addClass('invisible');
                        $('#success').removeClass('invisible');

                        notification.labPerformSuccess('top', 'right');

                        setTimeout('$("#authentication").modal("hide")', 1500);
                        setInterval(function () {
                            window.location = "lab_tech.php";
                        }, 1000);

                    } else {

                        $('#checking').addClass('invisible');
                        $('#success').addClass('invisible');
                        $('#wrong').removeClass('invisible');
                        setTimeout("$('#authentication').modal('hide')", 1000);

                    }
                }

            })
        })
    </script>

    <script>

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

        function labRequest() {

            $.ajax({

                url: "includes/inc.loads.php",
                method: "POST",
                data: {
                    "labRequest": "labRequest"
                },

                success: function (data) {

                    $('#labRequest').html(data);

                }

            })

        }

        /* badges */

        $(document).ready(function () {

            labRecordsBadge();
            labRecordsTodayBadge();
            patientRecordsBadge();
            labRequestBadge();
            urineRequestBadge();

        });

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

        function urineRequestBadge() {

            $.ajax({

                url: "includes/inc.badge.php",
                method: "POST",
                data: {
                    "urineRequest": "urineRequest"
                },

                success: function (data) {

                    $('#urineRequestBadge').html(data);
                }

            })
        }

        function labRequestBadge() {

            $.ajax({

                url: "includes/inc.badge.php",
                method: "POST",
                data: {
                    "labRequest": "labRequest"
                },

                success: function (data) {

                    $('#labRequestBadge').html(data);
                }

            })
        }
    </script>

    </body>
    </html>

    <?php
}