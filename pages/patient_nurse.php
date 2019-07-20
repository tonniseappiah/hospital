<?php

session_start();

if (!isset($_SESSION['patientID'])){

    header("Location: nurse.php?patientSessionOut");

} else {

    $patientID = $_SESSION['patientID'];

    include "includes/inc.database.php";

    date_default_timezone_set("Africa/Accra");
    $date_now = date("Y-m-d");

    $patientName = $_SESSION['surname'] . " " . $_SESSION['firstName'] . " " . $_SESSION['otherName'];
    ?>


    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="The clinic of satisfaction">
        <meta name="author" content="The UENR Team">
        <title>Patient Nurse</title>

        <!-- Favicon -->
        <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

        <!-- Icons -->
        <link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="../assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">

        <!-- Argon CSS -->
        <link type="text/css" href="../assets/css/argon.css?v=1.0.0" rel="stylesheet">

        <!-- Custom CSS -->
        <link type="text/css" href="../assets/css/custom.css" rel="stylesheet">

        <!--  Perfect Scroll  -->
        <script src="../assets/js/perfect-scrollbar.js"></script>
        <link type="text/css" href="../assets/css/perfect-scrollbar.css" rel="stylesheet">

        <style>
            .invisible {
                display: none !important;
            }

            .visible {
                display: block !important;
            }

            .modal-content hr:last-child, .modal-content hr:only-child {
                display: none !important;
                opacity: 0;
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
    <input type="hidden" value="<?php echo $patientName ?>" id="patientName">

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

    <!--  lab Records  -->
    <div class="modal fade" id="labRecords_modal" tabindex="-1" role="dialog" aria-labelledby="labRecords_modal"
         aria-hidden="true">
        <div class="modal-dialog modal-" role="document">
            <div class="modal-content" style="max-height: 510px!important;">
                <div class="pt-2 pb-1 shadow">
                    <h3 class="text-center pt-1">Lab Reports</h3>
                </div>
                <div id="labRecords" style="max-height: 470px!important; position:relative;">
                </div>
            </div>
        </div>
    </div>

    <!--   authentication modal   -->
    <div class="modal fade" id="authentication" tabindex="-1" role="dialog" aria-labelledby="authentication"
         aria-hidden="true">
        <div class="modal-dialog modal-danger modal-" role="document">
            <div class="modal-content bg-secondary ml-auto mr-auto" style="max-width: 130px!important;" id="checking">
                <div class="modal-body" style="padding: 1.2rem 0.8rem">
                    <div class="text-center">
                        <i class="fa fa-spinner fa-4x fa-pulse fa-fw text-warning" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="modal-content bg-secondary ml-auto mr-auto invisible" style="max-width: 130px!important;"
                 id="success">
                <div class="modal-body" style="padding: 1.2rem 0.8rem">
                    <div class="text-center">
                        <i class="ni ni-like-2 ni-4x text-success" aria-hidden="true"></i>

                    </div>
                </div>
            </div>
            <div class="modal-content bg-secondary ml-auto mr-auto invisible" style="max-width: 130px!important;"
                 id="wrong">
                <div class="modal-body" style="padding: 1.2rem 0.8rem">
                    <div class="text-center">
                        <i class="fa fa-close fa-4x text-danger font-weight-light" aria-hidden="true"></i>

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
                <a class="h4 mb-0 text-white text-capitalize d-none d-lg-inline-block" href="main.html"> Patient
                    | <?php echo "<span class='text-capitalize'>" . $_SESSION['surname'] . " " . $_SESSION['firstName'] . " " . $_SESSION['otherName'] . "</span>" ?>
                    Dashboard </a>

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

        <!-- Page content -->
        <div class="container-fluid mt--7">

            <div class="row">

                <div class="col-xl-4 mb-5 mb-xl-0">
                    <div class="card shadow bg-secondary">
                        <div class="card-header bg-white">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-uppercase text-muted ls-1 mb-1">Treatments</h6>
                                    <h2 class="mb-0">Patient's Today's Records</h2>
                                </div>
                            </div>
                        </div>
                        <form method="post" id="clinical_form">
                            <div class="card-body" style="padding-top: 0.5rem!important;">
                                <!-- Chart -->
                                <div class="" style="max-height: 300px!important;">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group" style="margin-bottom: 0.5rem!important;">
                                                <label class="form-control-label"
                                                       style="margin-bottom: 0.1rem!important;">Temperature</label>
                                                <input type="number" class="form-control form-control-alternative"
                                                       placeholder="Temperature" value="" id="temperature" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" style="margin-bottom: 0.5rem!important;">
                                                <label class="form-control-label"
                                                       style="margin-bottom: 0.1rem!important;">Pressure</label>
                                                <input type="number" class="form-control form-control-alternative"
                                                       placeholder="Pressure" value="" id="pressure" required>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" style="margin-bottom: 0.5rem!important;">
                                                <label class="form-control-label"
                                                       style="margin-bottom: 0.1rem!important;">Weight</label>
                                                <input type="number" class="form-control form-control-alternative"
                                                       placeholder="Weight" value="" id="weight" required>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" style="margin-bottom: 0.5rem!important;">
                                                <label class="form-control-label"
                                                       style="margin-bottom: 0.1rem!important;">Pulse</label>
                                                <input type="number" class="form-control form-control-alternative"
                                                       placeholder="Pulse" value="" id="pulse" required>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-secondary">
                                <button class="btn btn-success btn-block btn-sm" type="submit"><i
                                            class="fa fa-check"></i> Place Information
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-xl-4 mb-5 mb-xl-0">
                    <div class="row">
                        <div class="col-xl-12 col-md-6 mb-3">
                            <div class="card shadow bg-secondary">
                                <div class="card-header bg-white"
                                     style="padding-bottom: 0.5rem!important; padding-top: 0.5rem!important;">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="text-uppercase text-muted ls-1 mb-1">Previous Checkup</h6>
                                            <h2 class="mb-0">Nurse's observations</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body"
                                     style="padding-top: 0.5rem!important; padding-bottom: 0.5rem!important;">
                                    <!-- Chart -->
                                    <div class="table-responsive" id="lastClinical">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12 col-md-6">
                            <div class="card shadow bg-secondary">
                                <div class="card-header bg-white"
                                     style="padding-bottom: 0.5rem!important; padding-top: 0.5rem!important;">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="text-uppercase text-muted ls-1 mb-1">Previous Treatments</h6>
                                            <h2 class="mb-0">Doctor's Prescriptions</h2>
                                        </div>
                                    </div>
                                </div>
                                <!-- Chart -->
                                <div class="table-responsive" id="lastDrugs">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="row">

                        <div class=" col-xl-12 col-md-4 mb-3">
                            <div class="card shadow bg-secondary">
                                <div class="card-header bg-white">
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
                                           data-target="#patientRecords_modal" onclick="patientRecords();">See all
                                            clinical <span class="notification" id="patientRecordsBadge"> </span></a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class=" col-xl-12 col-md-4 mb-3">
                            <div class="card shadow bg-secondary">
                                <div class="card-header bg-white">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="text-uppercase text-muted ls-1 mb-1">Laboratory</h6>
                                            <h2 class="mb-0">Patient's Lab Reports</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="padding: 1rem 0.5rem!important;">
                                    <div class="col text-center">
                                        <a href="#!" class="btn btn-sm btn-primary btn-block" data-toggle="modal"
                                           data-target="#labRecords_modal" onclick="labRecords();">See Reports <span
                                                    class="notification" id="labRecordsBadge"> </span></a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class=" col-xl-12 col-md-4 mb-3">
                            <div class="card shadow bg-secondary">
                                <div class="card-header bg-white">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="text-uppercase text-muted ls-1 mb-1">Doctor</h6>
                                            <h2 class="mb-0">Log into the Doctor's Page</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="padding: 1rem 0.5rem!important;">
                                    <div class="col text-center">
                                        <a href="patient_doctor.php" class="btn btn-sm btn-block btn-primary">Get In</a>
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

    <!-- Argon JS -->
    <script src="../assets/js/argon.js?v=1.0.0"></script>

    <script>
        new PerfectScrollbar('#patientRecords');
        new PerfectScrollbar('#labRecords');
    </script>

    <script>

        $(document).ready(function () {

            lastClinical();
            lastDrugs();
            patientRecords();
            labRecords();
            patientRecordsBadge();
            labRecordsBadge();

        });

        setInterval(function () {
            patientRecordsBadge();
            labRecordsBadge();
        }, 1000);

        $('#clinical_form').on('submit', function (e) {

            e.preventDefault();

            var patientID = $('#patientID').val();
            var temperature = $('#temperature').val();
            var pressure = $('#pressure').val();
            var weight = $('#weight').val();
            var pulse = $('#pulse').val();
            var patientName = $('#patientName').val();

            if (temperature == '' || pressure == '' || weight == '' || pulse == '') {

                alert('Please fill all fields');

            } else {

                $("#authentication").modal("show");

                $.ajax({

                    url: "includes/inc.processes.php",
                    method: "POST",
                    data: {

                        "clinical": "clinical",
                        "temperature": temperature,
                        "pressure": pressure,
                        "weight": weight,
                        "pulse": pulse,
                        "patientName": patientName,
                        "patientID": patientID

                    },

                    success: function (data) {

                        if (data == "SUCCESS") {

                            $('#checking').addClass('invisible');
                            $('#wrong').addClass('invisible');
                            $('#success').removeClass('invisible');

                            setTimeout('$("#authentication").modal("hide")', 1000);
                            $('#temperature').val('');
                            $('#pressure').val('');
                            $('#weight').val('');
                            $('#pulse').val('');

                            lastClinical();
                            patientRecords();

                        } else if (data == 'WAITING') {

                            $('#checking').addClass('invisible');
                            $('#success').addClass('invisible');
                            $('#wrong').removeClass('invisible');
                            setTimeout("$('#authentication').modal('hide')", 2000);
                        } else {

                            $('#checking').addClass('invisible');
                            $('#success').addClass('invisible');
                            $('#wrong').removeClass('invisible');
                            setTimeout("$('#authentication').modal('hide')", 2000);

                        }
                    }

                })

            }

        });


        function lastClinical() {
            var patientID = $('#patientID').val();

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
            var patientID = $('#patientID').val();

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


        /*  Badges */
        function patientRecordsBadge() {

            var patientID = $('#patientID').val();

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

            var patientID = $('#patientID').val();

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

    </script>

    </body>
    </html>

    <?php
}