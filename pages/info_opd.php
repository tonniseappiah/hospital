<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="The clinic of satisfaction">
    <meta name="author" content="The UENR Team">
    <title>OPD Information</title>

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

        tr th {
            padding-top: 0!important;
            padding-bottom: 0!important;
        }
        .card-body{
            padding-bottom: 0.5rem;
            padding-top: 0.5rem;
        }

        tr th h4 {
            margin-bottom: 0!important;
            margin-top: 8px;
        }
    </style>

</head>

<body>

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
    </div>
</div>





<!--<button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#modal-form">Form</button>-->

<!--  residence modal  -->
<div class="modal fade" id="modal-residence" tabindex="-1" role="dialog" aria-labelledby="modal-residence" aria-hidden="true">
    <div class="modal-dialog modal- modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 pt-4 pb-2">
                        <form role="form">
                            <div class="form-group mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-building"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Residence" type="text" id="input_res">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-primary my-4 btn-sm btn-block" id="residence">Insert</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--   school modal  -->
<div class="modal fade" id="modal-school" tabindex="-1" role="dialog" aria-labelledby="modal-school" aria-hidden="true">
    <div class="modal-dialog modal- modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 pt-4 pb-2">
                        <form role="form">
                            <div class="form-group mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="School" type="text" id="input_sch">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-primary my-4 btn-sm btn-block" id="school">Insert</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--   Programme modal   -->
<div class="modal fade" id="modal-programme" tabindex="-1" role="dialog" aria-labelledby="modal-programme" aria-hidden="true">
    <div class="modal-dialog modal- modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 pt-4 pb-2">
                        <form role="form">
                            <div class="form-group mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-paper-diploma"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Programme" type="text" id="input_pro">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-primary my-4 btn-sm btn-block" id="programme">Insert</button>
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
    <div class="container-fluid mt--7" style="height: 72.5vh!important;">
        <div class="row">

            <div class="col-xl-4 mb-5 mb-xl-0">
                <div class="card shadow bg-secondary">
                    <div class="card-header bg-white">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">Residences</h6>
                                <h2 class="mb-0">Patient's place of residence</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="" style="max-height: 285px!important;">

                            <div class="table-responsive">
                                <table class="table table-flush">
                                    <tbody id="fetch_residence" class="text-center">

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer bg-secondary">
                        <button class="btn btn-success btn-block btn-sm" data-toggle="modal" data-target="#modal-residence"><i class="fa fa-check"></i> Place Information</button>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 mb-5 mb-xl-0">
                <div class="card shadow bg-secondary">
                    <div class="card-header bg-white">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">Programmes</h6>
                                <h2 class="mb-0">Programme of patients</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="" style="max-height: 285px!important;">

                            <div class="table-responsive">
                                <table class="table table-flush">
                                    <tbody id="fetch_programme" class="text-center">


                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer bg-secondary">
                        <button class="btn btn-success btn-block btn-sm" data-toggle="modal" data-target="#modal-programme"><i class="fa fa-check"></i> Place Information</button>
                    </div>
                </div>

            </div>

            <div class="col-xl-4 mb-5 mb-xl-0">
                <div class="card shadow bg-secondary">
                    <div class="card-header bg-white">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">School</h6>
                                <h2 class="mb-0">School of the patient</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="" style="max-height: 285px!important;">

                            <div class="table-responsive">
                                <table class="table table-flush">
                                    <tbody id="fetch_school" class="text-center">


                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer bg-secondary">
                        <button class="btn btn-success btn-block btn-sm" data-toggle="modal" data-target="#modal-school"><i class="fa fa-check"></i> Place Information</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer container-fluid" style="padding-bottom: 1rem!important;">
        <div class="row align-items-center justify-content-xl-between">
            <div class="col-xl-6">
                <div class="copyright text-center text-xl-left text-muted">
                    &copy; 2018 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">UENR Clinic System</a>
                </div>
            </div>
            <div class="col-xl-6">
                <ul class="nav nav-footer justify-content-center justify-content-xl-end">
                    <li class="nav-item">
                        <a href="#" class="nav-link font-weight-bold">APPIAH Tonnise Danquah</a>
                    </li>
                    <li class="nav-item">
                        <a href="opd.php" class="nav-link">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">Patient List</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link font-weight-bold">OPD Information</a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
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
    $(document).ready(function () {

        fetch_residence();
        fetch_programme();
        fetch_school();

    });


    
    $('#residence').on('click', function () {

        if ($('#input_res').val() == ''){

            alert('Please type in a value')

        }else {

            $('#modal-residence').modal('hide');
            $('#modal-auth').modal('show');

            var residence = $('#input_res').val();

            $.ajax({

                url: "include/inc.opd_info.php",
                method: "POST",
                data: {
                    "item_type": "residence",
                    "residence": residence
                },

                success:function (data) {

                    if (data == "SUCCESS") {
                        $('.disappear').addClass('invisible');
                        $('.change').addClass('visible');
                        setTimeout("$('#modal-auth').modal('hide')", 2000);
                        $('#input_res').val('');
                        fetch_residence();

                    }

                }

            })

        }
       

    });

    $('#programme').on('click', function () {

        if ($('#input_pro').val() == ''){

            alert('Please type in a value');

        } else {

            $('#modal-programme').modal('hide');
            $('#modal-auth').modal('show');

            var programme = $('#input_pro').val();

            $.ajax({

                url: "include/inc.opd_info.php",
                method: "POST",
                data: {
                    "item_type": "programme",
                    "programme": programme
                },

                success:function (data) {
                    if (data == "SUCCESS") {

                        $('.disappear').addClass('invisible');
                        $('.change').addClass('visible');
                        setTimeout("$('#modal-auth').modal('hide')", 2000);
                        $('#input_pro').val('');
                        fetch_programme();

                    }

                }

            })
        }



    });

    $('#school').on('click', function () {

        if ($('#input_sch').val() == ''){

            alert('Please type in a value');

        } else {

            $('#modal-school').modal('hide');
            $('#modal-auth').modal('show');

            var school = $('#input_sch').val();

            $.ajax({

                url: "include/inc.opd_info.php",
                method: "POST",
                data: {
                    "item_type": "school",
                    "school": school
                },

                success:function (data) {

                    if (data == "SUCCESS") {

                        $('.disappear').addClass('invisible');
                        $('.change').addClass('visible');
                        setTimeout("$('#modal-auth').modal('hide')", 2000);
                        $('#input_sch').val('');
                        fetch_school();

                    }

                }

            })
        }



    });

    function fetch_residence() {

        $.ajax({

            url: "include/inc.fetch_residence.php",
            method: "POST",

            success: function (data) {

                $('#fetch_residence').html(data);

            }

        })

    }


    function fetch_programme() {

        $.ajax({

            url: "include/inc.fetch_programme.php",
            method: "POST",

            success: function (data) {

                $('#fetch_programme').html(data);

            }

        })

    }


    function fetch_school() {

        $.ajax({

            url: "include/inc.fetch_school.php",
            method: "POST",

            success: function (data) {

                $('#fetch_school').html(data);

            }

        })

    }

</script>

</body>

</html>