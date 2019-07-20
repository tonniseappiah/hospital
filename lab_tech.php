<?php

include "includes/inc.database.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="The clinic of satisfaction">
    <meta name="author" content="The UENR Team">
    <title>laboratory</title>

    <!-- Favicon -->
    <link href="./assets/img/brand/favicon.png" rel="icon" type="image/png">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Icons -->
    <link href="./assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Argon CSS -->
    <link type="text/css" href="./assets/css/argon.css?v=1.0.0" rel="stylesheet">


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


    </style>

</head>

<body>

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

<!-- Lab Records Today -->
<div class="modal fade" id="labRecordsToday_modal" tabindex="-1" role="dialog" aria-labelledby="labRecordsToday_modal"
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
                <table class="table align-items-center table-flush" id="labRecordsToday"></table>
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

<!--  add lab items modal  -->
<div class="modal fade" id="add_lab_items" tabindex="-1" role="dialog" aria-labelledby="add_lab_items"
     aria-hidden="true">
    <div class="modal-dialog modal- modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 pt-4 pb-2">
                        <form role="form" id="lab_item_form" method="post">
                            <div class="form-group mb-2">
                                <div class="input-group input-group-alternative" id="item_group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-atom" id="icon"></i></span>
                                    </div>
                                    <input class="form-control text-capitalize" placeholder="Item Name" type="text"
                                           id="lab_item_name">
                                </div>
                                <div class="form-control-feedback text-center mt-1" id="item_feed"></div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-1 btn-sm btn-block">
                                    Insert
                                </button>
                            </div>
                        </form>
                    </div>
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
                                <h6 class="text-uppercase text-muted ls-1 mb-1">
                                    <script>
                                        document.write(new Date().getFullYear())
                                    </script>
                                    Laboratory Records
                                </h6>
                                <h2 class="mb-0">Patient Tested</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="chart">
                            <canvas id="chart-lab" class="chart-canvas"></canvas>
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
                                        <h6 class="text-uppercase text-muted ls-1 mb-1">Request</h6>
                                        <h2 class="mb-0">Requested Lab Reports</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" style="padding: 1rem 1.9rem!important;">
                                <div class="row text-center">
                                    <a href="#!" class="btn btn-sm btn-primary col mb-1" data-toggle="modal"
                                       data-target="#labRequest_modal" onclick="labRequest()">View request
                                        <span class="notification" id="labRequestBadge"></span></a>

                                    <a href="#!" class="btn btn-sm btn-default col mb-1" data-toggle="modal" data-target="#urine_request">View Urine request
                                        <span class="notification" id="urineRequestBadge"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="card shadow">
                            <div class="card-header bg-transparent">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="text-uppercase text-muted ls-1 mb-1">Finished</h6>
                                        <h2 class="mb-0">Finished Lab Reports</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" style="padding: 1rem 1.9rem!important;">
                                <div class="row text-center">
                                    <a href="#!" class="btn btn-sm mb-1 col btn-primary" data-toggle="modal"
                                       data-target="#modal-finish"> See all Reports
                                        <span class="notification" id="labRecordsBadge"></span></a>

                                    <a href="#!" class="btn btn-sm mb-1 col btn-default" data-target="#labRecordsToday_modal" data-toggle="modal" onclick="labRecordsToday()">See Today's Reports
                                        <span class="notification" id="labRecordsTodayBadge"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="card shadow">
                            <div class="card-header bg-transparent">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="text-uppercase text-muted ls-1 mb-1">Lab Items</h6>
                                        <h2 class="mb-0">Add Lab Items</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" style="padding: 1rem 1.5rem!important;">
                                <div class="col text-center">
                                    <a href="#!" class="btn btn-sm btn-block btn-primary" data-target="#add_lab_items"
                                       data-toggle="modal">Add Items</a>
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

    $('#lab_item_name').keyup(function () {

        var name = $('#lab_item_name').val();

        if (name == ''){

            $('#icon').removeClass("text-danger");
            $('#icon').removeClass("text-success");
            $('#lab_item_name').removeClass("text-danger");
            $('#lab_item_name').removeClass("text-success");
            $('#lab_item_name').removeClass("is-invalid");
            $('#item_group').removeClass("has-danger");

            $('#lab_item_name').removeClass("is-valid");
            $('#item_group').removeClass("has-success");

            $('#item_feed').removeClass('d-block text-danger');
            $('#item_feed').addClass('d-none');

        } else {

            $.ajax({
                url: "includes/inc.processes.php",
                method: "POST",
                data: {
                    "check_item": "check_item",
                    "name": name
                },

                success: function (data) {
                    if (data == 'EXIST') {

                        $('#lab_item_name').removeClass("is-valid");
                        $('#item_group').removeClass("has-success");
                        $('#lab_item_name').addClass("is-invalid");
                        $('#item_group').addClass("has-danger");
                        $('#lab_item_name').removeClass("text-success");
                        $('#icon').removeClass("text-success");
                        $('#lab_item_name').addClass("text-danger");
                        $('#icon').addClass("text-danger");

                        $('#item_feed').removeClass('text-success');
                        $('#item_feed').removeClass('d-none');
                        $('#item_feed').addClass('d-block text-danger');
                        $('#item_feed').html('Lab item already inserted.');

                    } else {

                        $('#lab_item_name').removeClass("is-invalid");
                        $('#item_group').removeClass("has-danger");
                        $('#lab_item_name').addClass("is-valid");
                        $('#item_group').addClass("has-success");
                        $('#lab_item_name').removeClass("text-danger");
                        $('#icon').removeClass("text-danger");
                        $('#lab_item_name').addClass("text-success");
                        $('#icon').addClass("text-success");

                        $('#item_feed').removeClass('text-danger');
                        $('#item_feed').removeClass('d-none');
                        $('#item_feed').addClass('d-block text-success');
                        $('#item_feed').html("Good");

                    }

                }
            })
        }
    });


    $('#lab_item_form').on('submit', function (e) {

        e.preventDefault();

        if ($('#lab_item_name').val() == '') {

            alert('Please type in a value')

        } else {

            $('#add_lab_items').modal('hide');
            $('#authentication').modal('show');

            var lab_item_name = $('#lab_item_name').val();

            $.ajax({

                url: "includes/inc.processes.php",
                method: "POST",
                data: {
                    "add_lab_item": "add_lab_item",
                    "lab_item_name": lab_item_name
                },

                success: function (data) {

                    if (data == "SUCCESS"){

                        $('#add_lab_items').modal('hide');
                        $('#checking').addClass('invisible');
                        $('#wrong').addClass('invisible');
                        $('#success').removeClass('invisible');
                        $('#lab_item_name').val('');

                        setTimeout("$('#authentication').modal('hide')", 1000);

                        $('#icon').removeClass("text-danger");
                        $('#icon').removeClass("text-success");
                        $('#lab_item_name').removeClass("text-danger");
                        $('#lab_item_name').removeClass("text-success");
                        $('#lab_item_name').removeClass("is-invalid");
                        $('#item_group').removeClass("has-danger");

                        $('#lab_item_name').removeClass("is-valid");
                        $('#item_group').removeClass("has-success");

                        $('#item_feed').removeClass('d-block text-danger');
                        $('#item_feed').addClass('d-none');


                    } else if (data == 'IN_ALREADY') {

                        $('#checking').addClass('invisible');
                        $('#success').addClass('invisible');
                        $('#wrong').removeClass('invisible');

                        $('#lab_item_name').val('');

                        setTimeout("$('#authentication').modal('hide')", 1000);

                        notification.labItemExist('top', 'right');


                    } else {

                        $('#checking').addClass('invisible');
                        $('#success').addClass('invisible');
                        $('#wrong').removeClass('invisible');
                        setTimeout("$('#authentication').modal('hide')", 1000);

                        notification.labItemFailed('top', 'right');

                    }

                }

            })

        }

    });
</script>

<script>
    function loading() {
        $('#labRequest_modal').modal('hide');
        $('#authentication').modal('show');
    }
</script>

<script>
    /* badges */

    $(document).ready(function () {

        labRecordsBadge();
        labRecordsTodayBadge();
        patientRecordsBadge();
        urineRequestBadge();
        labRequestBadge();
        labRequest();
        labRecordsToday();

        setInterval(function () {
            labRecordsBadge();
            labRecordsTodayBadge();
            patientRecordsBadge();
            urineRequestBadge();
            labRequestBadge();
        }, 1000)

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

        $.ajax({

            url: "includes/inc.badge.php",
            method: "POST",
            data: {
                "labRecordsNoPatient": "labRecordsNoPatient"
            },

            success: function (data) {

                $('#labRecordsBadge').html(data);
            }

        })
    }

    function labRecordsTodayBadge() {

        $.ajax({

            url: "includes/inc.badge.php",
            method: "POST",
            data: {
                "labRecordsTodayNoPatient": "labRecordsTodayNoPatient"
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

<script>
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

    function labRecordsToday() {

        $.ajax({
            url: "includes/inc.loads.php",
            method: "POST",
            data: {
                "labRecordsTodayNoPatient": "labRecordsTodayNoPatient",
            },

            success: function (data) {
                $('#labRecordsToday').html(data);
            }
        })
    }
</script>

</body>
</html>