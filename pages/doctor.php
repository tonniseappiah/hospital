<?php
session_start();

include "../includes/inc.database.php";

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="The clinic of satisfaction">
    <meta name="author" content="The UENR Team">
    <title>Doctor</title>

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
            display: none!important;
        }

        .visible {
            display: block!important;
        }

        .modal-content hr:last-child, .modal-content hr:only-child {
            display: none!important;
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

<!--   awaiting patient list  -->
<div class="modal fade" id="patient-list" tabindex="-1" role="dialog" aria-labelledby="patient-list" aria-hidden="true">
    <div class="modal-dialog modal- modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title-finish">Awaiting Patient List</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <?php
                    $sql = "SELECT * FROM in_treatment";
                    $query = mysqli_query($con, $sql);

                    if ($results = mysqli_num_rows($query)){
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
                        while ($row = mysqli_fetch_assoc($query)){
                            ?>
                            <tr>
                                <th scope="row" class="text-capitalize">
                                    <?php echo $row['patientID']  ?>
                                </th>
                                <td class="text-capitalize font-weight-bold">
                                    <?php echo $row['patientName']  ?>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary btn-block patient-in" id="<?php echo $row['patientID']  ?>"> Log In </a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                    <?php
                    }else {
                        ?>
                        <h3 class="text-center">  No data available  </h3>
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

<!-- Awaiting lab report -->
<div class="modal fade" id="awaiting_lab" tabindex="-1" role="dialog" aria-labelledby="awaiting_lab" aria-hidden="true">
    <div class="modal-dialog modal- modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title-finish">Patient Awaiting Lab Report</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <?php
                    $sql = "SELECT * FROM awaiting_lab";
                    $query = mysqli_query($con, $sql);

                    if ($results = mysqli_num_rows($query)){
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
                        while ($row = mysqli_fetch_assoc($query)){
                            ?>
                            <tr>
                                <th scope="row" class="text-capitalize">
                                    <?php echo $row['patientID']  ?>
                                </th>
                                <td class="text-capitalize font-weight-bold">
                                    <?php echo $row['patientName']  ?>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-info btn-block check-in" id="<?php echo $row['patientID']  ?>"> Log In </a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                        <?php
                    }else {
                        ?>
                        <h3 class="text-center">  No data available  </h3>
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

<!--   today's lab report  -->
<div class="modal fade" id="modal-today" tabindex="-1" role="dialog" aria-labelledby="modal-today" aria-hidden="true">
    <div class="modal-dialog modal-" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title-today">Lab Report for today</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush mb-0">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">PatientID</th>
                        <th scope="col">Patient Name</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
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
                                <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Ryan Tompson">
                                    <img alt="Image placeholder" src="../assets/img/theme/team-1-800x800.jpg" class="rounded-circle">
                                </a>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer py-2" style="border-top: 1px solid #e9ecef">
                <button type="button" class="btn btn-primary mr-auto btn-sm px-5" data-dismiss="modal">Close</button>
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


<!-- Main content -->
<div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="main.html">Dashboard</a>
            <!-- Form -->
            <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
                <div class="form-group mb-0">
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input class="form-control" placeholder="Search" type="text">
                    </div>
                </div>
            </form>
            <!-- User -->
            <ul class="navbar-nav align-items-center d-none d-md-flex">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

            <div class="col-xl-4">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="card shadow">
                            <div class="card-header bg-transparent">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="text-uppercase text-muted ls-1 mb-1">Patient Queue</h6>
                                        <h2 class="mb-0">Patients awaiting treatment | in lab</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" style="padding: 1rem 1.9rem!important;">
                                <div class="row text-center">
                                    <a href="#!" class="btn btn-sm btn-primary col mb-1" data-toggle="modal" data-target="#patient-list">See treatment list <span class="notification">
                                            <?php
                                            $sql = "SELECT * FROM in_treatment";
                                            $query = mysqli_query($con, $sql);
                                            if ($results = mysqli_num_rows($query)){

                                                echo $results;

                                            } else {

                                                echo "0";

                                            }

                                            ?>
                                        </span></a>
                                    <a href="#!" class="btn btn-sm btn-default col mb-1" data-target="#awaiting_lab" data-toggle="modal">Awaiting Report <span class="notification">1</span></a>
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
                            <div class="card-body" style="padding: 1rem 1.9rem!important;">
                                <div class="text-center row">
                                    <a href="#!" class="btn btn-sm btn-primary col mb-1" data-toggle="modal" data-target="#modal-today">See Today's Reports <span class="notification">1</span></a>
                                    <a href="#!" class="btn btn-sm btn-default col mb-1">See all Reports <span class="notification">1</span></a>
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
    $('.patient-in').on('click', function () {
       $('#patient-list').modal('hide');
       $('#authentication').modal('show');

       var patientID = $(this).attr("id");

       console.log(patientID);

       $.ajax({

           url: "../includes/inc.processes.php",
           method: "POST",
           data: {
               "in_treatment": "in_treatment",
               "patientID": patientID
           },

           success: function (data) {

               if (data == "SUCCESS"){

                   $('#checking').addClass('invisible');
                   $('#wrong').addClass('invisible');
                   $('#success').removeClass('invisible');

                   setTimeout("window.location = 'patient_doctor.php'", 1500);

               } else {

                   $('#checking').addClass('invisible');
                   $('#success').addClass('invisible');
                   $('#wrong').removeClass('invisible');
                   setTimeout("$('#authentication').modal('hide')", 1000);
               }

           }


       });


    });

    $('.check-in').on('click', function () {

        $('#awaiting_lab').modal('hide');
        $('#authentication').modal('show');

        var patientID = $(this).attr("id");

        $.ajax({

            url: "../includes/inc.processes.php",
            method: "POST",
            data: {
                "check-in": "check-in",
                "patientID": patientID
            },

            success: function (data) {

                if (data == "SUCCESS"){

                    $('#modal-form').modal('hide');
                    $('#checking').addClass('invisible');
                    $('#wrong').addClass('invisible');
                    $('#success').removeClass('invisible');

                    setTimeout("window.location = 'patient_doctor.php'", 1500);

                } else {

                    $('#checking').addClass('invisible');
                    $('#success').addClass('invisible');
                    $('#wrong').removeClass('invisible');
                    setTimeout("$('#authentication').modal('hide')", 1000);
                }

            }


        });


    });
</script>

</body>

</html>