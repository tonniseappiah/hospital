<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="The clinic of satisfaction">
    <meta name="author" content="The UENR Team">
    <title>Pharmacist</title>

    <!-- Favicon -->
    <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Icons -->
    <link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

    <!-- Argon CSS -->
    <link type="text/css" href="../assets/css/argon.css?v=1.0.0" rel="stylesheet">

    <style>
        .invisible {
            display: none!important;
        }

        .visible {
            display: block!important;
        }

        .change {
            display: none;
        }

        .wrong {
            display: none;
        }
    </style>

</head>

<body>


<!--<button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#modal-form">Form</button>-->
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 pt-4 pb-2">
                        <form role="form">
                            <div class="form-group mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Patient Code" type="text">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-primary my-4 btn-sm btn-block">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--   modal for adding drugs  -->
<div class="modal fade" id="modal-drugs" tabindex="-1" role="dialog" aria-labelledby="modal-drugs" aria-hidden="true">
    <div class="modal-dialog modal- modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">

                <div class="card bg-secondary shadow border-0">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">Adding Drugs</h6>
                                <h2 class="mb-0">Enter drugs information</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-4 pb-2">
                        <form action="">
                            <div class="row">
                                <div class="col-lg-5" style="padding-left: 10px!important; padding-right: 10px!important;">
                                    <div class="form-group">
                                        <label class="form-control-label">Drug</label>
                                        <input type="text" class="form-control form-control-alternative" placeholder="Drug Name" value="" id="drugName">
                                    </div>
                                </div>
                                <div class="col-lg-3" style="padding-left: 10px!important; padding-right: 10px!important;">
                                    <div class="form-group">
                                        <label class="form-control-label">Dosage</label>
                                        <div class="form-row">
                                            <input type="number" class="form-control form-control-alternative col mr-1" placeholder="Dosage" value="" id="dosage_quantity">
                                            <input type="number" class="form-control form-control-alternative col" placeholder="Dosage" value="" id="dosage_times">
                                        </div>

                                    </div>
                                </div>

                                <div class="col-lg-2" style="padding-left: 10px!important; padding-right: 10px!important;">
                                    <div class="form-group">
                                        <label class="form-control-label">Quantity</label>
                                        <input type="number" class="form-control form-control-alternative col" placeholder="Qty" value="" id="drug_quantity">

                                    </div>
                                </div>

                                <div class="col-lg-2" style="padding-left: 10px!important; padding-right: 10px!important;">
                                    <div class="form-group">
                                        <label class="form-control-label">Add</label>
                                        <a href="#!" class="btn btn-block btn-success" id="add_drug"><i class="fa fa-check"></i></a>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!--   authentication modal   -->
<div class="modal fade" id="modal-auth" tabindex="-1" role="dialog" aria-labelledby="modal-auth" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-" role="document">
        <div class="modal-content bg-gradient-warning ml-auto mr-auto disappear" style="max-width: 150px!important;">
            <div class="modal-body">
                <div class="text-center">
                    <i class="fa fa-spinner fa-5x fa-pulse fa-fw" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <div class="modal-content bg-gradient-success ml-auto mr-auto change" style="max-width: 150px!important;">
            <div class="modal-body">
                <div class="text-center">
                    <i class="ni ni-like-2 ni-5x" aria-hidden="true"></i>

                </div>
            </div>
        </div>
        <div class="modal-content bg-gradient-warning ml-auto mr-auto wrong" style="max-width: 150px!important;">
            <div class="modal-body">
                <div class="text-center">
                    <i class="ni ni-fat-remove ni-5x" aria-hidden="true"></i>

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

            <div class="col-xl-4 container">
                <div class="row">
                    <div class="card shadow col-md-12 mb-3">
                        <div class="card-header bg-transparent">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-uppercase text-muted ls-1 mb-1">Patient Queue</h6>
                                    <h2 class="mb-0">Patients awaiting for drugs</h2>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 1rem 1.5rem!important;">
                            <div class="col text-center">
                                <a href="#!" class="btn btn-sm btn-block btn-primary">See list</a>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow col-md-12 mb-3">
                        <div class="card-header bg-transparent">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-uppercase text-muted ls-1 mb-1">Drugs</h6>
                                    <h2 class="mb-0">Add non-existing drugs</h2>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 1rem 1.5rem!important;">
                            <div class="col text-center">
                                <a href="#!" class="btn btn-sm btn-block btn-primary" data-toggle="modal" data-target="#modal-drugs">Add drugs</a>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow col-md-12">
                        <div class="card-header bg-transparent">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-uppercase text-muted ls-1 mb-1">Drugs</h6>
                                    <h2 class="mb-0">Modify drug information</h2>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 1rem 1.5rem!important;">
                            <div class="col text-center">
                                <a href="#!" class="btn btn-sm btn-block btn-primary">Check in</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Footer -->
        <!--<footer class="footer" style="padding-bottom: 1rem!important;">
            <div class="row align-items-center justify-content-xl-between">
                <div class="col-xl-6">
                    <div class="copyright text-center text-xl-left text-muted">
                        &copy; 2018 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
                    </div>
                </div>
                <div class="col-xl-6">
                    <ul class="nav nav-footer justify-content-center justify-content-xl-end">
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>-->
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
    $('#add_drug').on('click', function () {

        if ($('#drugName').val() == '' || $('#drug_quantity').val() == '' || $('#dosage_times').val() == '' || $('#dosage_quantity').val() == ''){

            alert('Please fill all spaces')

        }else {
            $('#modal-drugs').modal('hide');
            $('#modal-auth').modal('show');

            var drugName = $('#drugName').val();
            var drug_quantity = $('#drug_quantity').val();
            var dosage_times = $('#dosage_times').val();
            var dosage_quantity = $('#dosage_quantity').val();

            $.ajax({

                url: "include/inc.add_drugs.php",
                method: "POST",
                data: {

                    "drugName": drugName,
                    "drug_quantity": drug_quantity,
                    "dosage_quantity": dosage_quantity,
                    "dosage_times": dosage_times

                },

                success: function (data) {

                    if (data == "SUCCESS"){
                        $('#modal-drugs').modal('hide');
                        $('.disappear').addClass('invisible');
                        $('.wrong').addClass('invisible');
                        $('.change').addClass('visible');

                        $('#drugName').val('');
                        $('#dosage_quantity').val('');
                        $('#dosage_times').val('');
                        $('#drug_quantity').val('');

                        setTimeout('$("#modal-auth").modal("hide")', 1000);
                    }

                }

            });



        }

    });
</script>

</body>
</html>