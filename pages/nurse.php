<?php

session_start();

if (!isset($_SESSION['staffID'])){

    header("Location: index.php?sessionOut");

} else {

    include "includes/inc.database.php";

    date_default_timezone_set("Africa/Accra");
    $date_now = date("Y-m-d");

    ?>


    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="The clinic of satisfaction">
        <meta name="author" content="The UENR Team">
        <title>Nurse</title>

        <!-- Favicon -->
        <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

        <!-- Icons -->
        <link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="../assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">

        <!-- Argon CSS -->
        <link type="text/css" href="../assets/css/argon.css?v=1.0.0" rel="stylesheet">

        <style>
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
        </style>

    </head>

    <body>

    <!-- Patient login modal -->
    <div class="modal fade" id="patient_login" tabindex="-1" role="dialog" aria-labelledby="patient_login"
         aria-hidden="true">
        <div class="modal-dialog modal- modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-body px-lg-5 pt-4 pb-2">
                            <form role="form" method="post" id="patient_in_form">
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="PatientID" type="text" id="patientID">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary my-4 btn-sm btn-block">Sign in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  finished lab report -->
    <div class="modal fade" id="modal-finish" tabindex="-1" role="dialog" aria-labelledby="modal-finish"
         aria-hidden="true">
        <div class="modal-dialog modal- modal- modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title-finish">Today's Lab Reports</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <?php
                        $sql = "SELECT * FROM lab_report WHERE date = '$date_now'";
                        $query = mysqli_query($con, $sql);

                        if ($results = mysqli_num_rows($query)) {
                            ?>
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">PatientID</th>
                                <th scope="col">Patient Name</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                <tr>
                                    <th scope="row" class="text-capitalize">
                                        <?php echo $row['patientID'] ?>
                                    </th>
                                    <td class="text-capitalize font-weight-bold">
                                        <?php echo $row['patient_name'] ?>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary btn-block patient-in"
                                           id="<?php echo $row['patientID'] ?>"> Log In </a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                            <?php
                        } else {
                            ?>
                            <h3 class="text-center"> No data available </h3>
                            <?php
                        }
                        ?>
                    </table>
                </div>

                <div class="modal-footer py-2" style="border-top: 1px solid #e9ecef">
                    <button type="button" class="btn btn-primary mr-auto btn-sm" data-dismiss="modal">Close</button>
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
                <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="main.html">Dashboard |
                    Nurse </a>

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
                                    <span class="mb-0 text-sm font-weight-bold text-capitalize"><?php echo $_SESSION['staffName'] ?></span>
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
                    <div class="card shadow">
                        <div class="card-header bg-transparent">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-uppercase text-muted ls-1 mb-1">2018 Patient Records</h6>
                                    <h2 class="mb-0">Patient Visits</h2>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Chart -->
                            <div class="chart">
                                <canvas id="chart-patient" class="chart-canvas"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 container">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="card shadow">
                                <div class="card-header bg-transparent">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="text-uppercase text-muted ls-1 mb-1">Patient Profile</h6>
                                            <h2 class="mb-0">Insert Patient Clinical Info</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="padding: 1rem 1.5rem!important;">
                                    <div class="col text-center">
                                        <a href="#!" class="btn btn-sm btn-block btn-primary" data-toggle="modal"
                                           data-target="#patient_login">Login Patient</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="card shadow">
                                <div class="card-header bg-transparent">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="text-uppercase text-muted ls-1 mb-1">Laboratory</h6>
                                            <h2 class="mb-0">Patients' Lab Reports</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="padding: 1rem 1.5rem!important;">
                                    <div class="col text-center">
                                        <a href="#!" class="btn btn-sm btn-block btn-primary" data-toggle="modal"
                                           data-target="#modal-finish">See all Reports <span class="notification"><?php
                                                $sql = "SELECT * FROM lab_report WHERE date = '$date_now'";
                                                $query = mysqli_query($con, $sql);
                                                $results = mysqli_num_rows($query);

                                                if ($results > 0) {
                                                    echo $results;
                                                } else {
                                                    echo "0";
                                                }
                                                ?></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="card shadow">
                                <div class="card-header bg-transparent">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="text-uppercase text-muted ls-1 mb-1">Statistics</h6>
                                            <h2 class="mb-0">Treated Diseases/Sickness</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="padding: 1rem 1.5rem!important;">
                                    <div class="col text-center">
                                        <a href="#!" class="btn btn-sm btn-block btn-primary">See statistics</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $fulUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    ?>

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

        $('#patient_in_form').on('submit', function (e) {

            e.preventDefault();

            if ($('#patientID').val() == '') {
                alert('Please enter patientID')
            } else {

                $('#authentication').modal('show');

                var patientID = $('#patientID').val();

                $.ajax({

                    url: "includes/inc.processes.php",
                    method: "POST",
                    data: {
                        "nurse": "nurse",
                        "patientID": patientID
                    },

                    success: function (data) {

                        if (data == "SUCCESS") {

                            $('#modal-form').modal('hide');
                            $('#checking').addClass('invisible');
                            $('#wrong').addClass('invisible');
                            $('#success').removeClass('invisible');
                            setTimeout("window.location = 'patient_nurse.php'", 1500);

                        } else {
                            $('#checking').addClass('invisible');
                            $('#success').addClass('invisible');
                            $('#wrong').removeClass('invisible');
                            setTimeout("$('#authentication').modal('hide')", 1000);
                        }

                    }


                });

            }

        });

    </script>

    </body>
    </html>

    <?php
}