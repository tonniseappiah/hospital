<?php

session_start();

include "includes/inc.database.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="The clinic of satisfaction">
    <meta name="author" content="The UENR Team">
    <title>OPD</title>

    <!-- Favicon -->
    <link href="./assets/img/brand/favicon.png" rel="icon" type="image/png">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Icons -->
    <link href="./assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="./assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

    <!-- Argon CSS -->
    <link type="text/css" href="./assets/css/argon.css?v=1.0.0" rel="stylesheet">

    <style>
        .invisible {
            display: none!important;
        }

        .visible {
            display: block!important;
        }

        .change, .wrong {
            display: none;
        }

        .modal-content hr:last-child, .modal-content hr:only-child {
            display: none!important;
            opacity: 0;
        }
    </style>
</head>

<body>


<!--<button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#modal-form">Form</button>-->
<!--<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
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
</div>-->

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


<!--  registration modal  -->
<div class="modal fade" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="modal-register" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-white">
                        <div class="text-muted text-center mb-3">
                            <h4>Please Choose The Patient Category</h4>
                        </div>
                        <div class="btn-wrapper text-center">
                            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-text" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-1-tab" data-toggle="tab" href="#tabs-1" role="tab" aria-controls="tabs-text-1" aria-selected="true">Student</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-2-tab" data-toggle="tab" href="#tabs-2" role="tab" aria-controls="tabs-text-2" aria-selected="false">Staff</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-3-tab" data-toggle="tab" href="#tabs-3" role="tab" aria-controls="tabs-text-3" aria-selected="false">Foreigner</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div id="TabContent" class="tab-content">
                        <div class="card-body pr-3 pl-3 pt-3 pb-2 tab-pane fade show active" id="tabs-1" role="tabpanel" aria-labelledby="tabs-1-tab">
                            <div class="text-center text-muted mb-4">
                                <h5>Sign Up A Student</h5>
                            </div>
                            <form role="form">

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="First Name" type="text" id="firstName_stu">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Surname" type="text" id="surname_stu">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Other Name" type="text" id="otherName_stu">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                            </div>
                                            <select class="form-control" id="level">
                                                <option selected disabled>Level</option>
                                                <option value="100">100</option>
                                                <option value="200">200</option>
                                                <option value="300">300</option>
                                                <option value="400">400</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Contact" type="number" id="contact_stu">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-ruler-pencil"></i></span>
                                            </div>
                                            <select class="form-control" id="programme">
                                                <option selected disabled>Programme</option>
                                                <option value="BSc. Computer Engineering">BSc. Computer Engineering</option>
                                                <option value="BSc. Electrical and Electronic Engineering">BSc. Electrical and Electronic Engineering</option>
                                                <option value="BSc. Mechanical Engineering">BSc. Mechanical Engineering</option>
                                                <option value="BSc. Computer Science">BSc. Computer Science</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                            </div>
                                            <select class="form-control" id="gender_stu">
                                                <option selected disabled>Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-sound-wave"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Age" type="number" id="age_stu">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-shop"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Residence" type="text" id="residence_stu">
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="button" class="btn btn-primary my-4" id="register_stu">Register</button>
                                </div>
                            </form>
                        </div>

                        <div class="card-body pr-3 pl-3 pt-3 pb-2 tab-pane fade" id="tabs-2" role="tabpanel" aria-labelledby="tabs-2-tab">
                            <div class="text-center text-muted mb-4">
                                <h5>Sign Up A Staff</h5>
                            </div>
                            <form role="form">

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="First Name" type="text" id="firstName_staff">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Surname" type="text" id="surname_staff">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Other Name" type="text" id="otherName_staff">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-5">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Contact" type="number" id="contact_staff">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-7">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-ruler-pencil"></i></span>
                                            </div>
                                            <select class="form-control" id="school">
                                                <option selected disabled>School</option>
                                                <option value="100">BSc. Computer Engineering</option>
                                                <option value="200">BSc. Electrical and Electronic Engineering</option>
                                                <option value="300">BSc. Mechanical Engineering</option>
                                                <option value="400">BSc. Computer Science</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                            </div>
                                            <select class="form-control" id="gender_staff">
                                                <option selected disabled>Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-sound-wave"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Age" type="number" id="age_staff">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-shop"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Residence" type="text" id="residence_staff">
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="button" class="btn btn-primary my-4" id="register_staff">Register</button>
                                </div>
                            </form>
                        </div>

                        <div class="card-body pr-3 pl-3 pt-3 pb-2 tab-pane fade" id="tabs-3" role="tabpanel" aria-labelledby="tabs-3-tab">
                            <div class="text-center text-muted mb-4">
                                <h5>Sign Up A Foreigner</h5>
                            </div>
                            <form role="form">

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="First Name" type="text" id="firstName_for">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Surname" type="text" id="surname_for">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Other Name" type="text" id="otherName_for">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Contact" type="number" id="contact_for">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                            </div>
                                            <select class="form-control" id="gender_for">
                                                <option selected disabled>Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-sound-wave"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Age" type="number" id="age_for">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-shop"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Residence" type="text" id="residence_for">
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="button" class="btn btn-primary my-4" id="register_for">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!--  last inserted patient  record  -->
<div class='modal fade' id='last_inserted_patient' tabindex='-1' role='dialog' aria-labelledby='last_inserted_patient' aria-hidden='true'>
    <div class='modal-dialog modal-danger modal-dialog-centered modal-' role='document'>
        <div class='modal-content bg-gradient-primary'>
            <div class='modal-body' style="padding-bottom: 0.5rem!important;" id="last_content">

            </div>
            <div class='modal-footer py-2'>
                <button type='button' class='btn btn-white btn-sm ml-auto' data-dismiss='modal'>Close</button>
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
                                <h6 class="text-uppercase text-muted ls-1 mb-1">2018 Patient Records</h6>
                                <h2 class="mb-0">Patient Registered</h2>
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
                                        <h6 class="text-uppercase text-muted ls-1 mb-1">Patient Registration</h6>
                                        <h2 class="mb-0">Adding a patient to record</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" style="padding: 1rem 1.5rem!important;">
                                <div class="col text-center">
                                    <a href="#!" class="btn btn-sm btn-block btn-primary" data-toggle="modal" data-target="#modal-register">Add Patient</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="card shadow">
                            <div class="card-header bg-transparent">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="text-uppercase text-muted ls-1 mb-1">Patient List</h6>
                                        <h2 class="mb-0">Check patient info</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" style="padding: 1rem 1.5rem!important;">
                                <div class="text-center row">
                                    <a href="#!" class="btn btn-sm btn-default col mb-1 mr-1" id="check">Newly Inserted</a>
                                    <a href="" class="btn btn-sm btn-primary col mb-1">Check List</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-2">
                        <div class="card shadow">
                            <div class="card-header bg-transparent">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="text-uppercase text-muted ls-1 mb-1">Information</h6>
                                        <h2 class="mb-0">Add location and others</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" style="padding: 1rem 1.5rem!important;">
                                <div class="col text-center">
                                    <a href="info_opd.php" class="btn btn-sm btn-block btn-primary">Get in</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Footer -->
        <footer class="footer" style="padding-bottom: 1rem!important;">
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
                            <a href="" class="nav-link font-weight-bold">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">Patient List</a>
                        </li>
                        <li class="nav-item">
                            <a href="info_opd.php" class="nav-link">OPD Information</a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
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

<!-- Argon JS -->
<script src="./assets/js/argon.js?v=1.0.0"></script>


<script>
    $('#register_stu').on('click', function () {

        if ($('#firstName_stu').val() == '' || $('#surname_stu').val() == '' || $('#contact_stu').val() == '' || $('#programme').val() == '' || $('#level').val() == '' || $('#gender_stu').val() == '' || $('#gender_stu').val() == '' || $('#residence_stu').val() == ''){

            alert('Fill all spaces');

        }else {

            $('#modal-auth').modal('show');
            $('#modal-register').modal('hide');


            var firstName = $('#firstName_stu').val();
            var surname = $('#surname_stu').val();
            var otherName = $('#otherName_stu').val();
            var contact = $('#contact_stu').val();
            var programme = $('#programme').val();
            var gender = $('#gender_stu').val();
            var age = $('#age_stu').val();
            var residence = $('#residence_stu').val();
            var level = $('#level').val();


            $.ajax({
                url: "includes/inc.processes.php",
                method: "POST",
                data: {
                    "patient": "student",
                    "firstName": firstName,
                    "surname": surname,
                    "otherName": otherName,
                    "contact": contact,
                    "programme": programme,
                    "gender": gender,
                    "age": age,
                    "level": level,
                    "residence": residence
                },

                success:function (data) {

                    if (data == "SUCCESS") {

                        $('.disappear').addClass('invisible');
                        $('.wrong').addClass('invisible');
                        $('.change').addClass('visible');
                        setTimeout('$("#modal-auth").modal("hide")', 950);

                        last_inserted_patient();
                    }else {

                        $('.disappear').addClass('invisible');
                        $('.change').addClass('invisible');
                        $('.wrong').addClass('visible');
                        setTimeout("$('#modal-auth').modal('hide')", 1000);
                    }


                }

            })

        }



    });


    $('#register_staff').on('click', function () {

        if ($('#firstName_staff').val() == '' || $('#surname_staff').val() == '' || $('#contact_staff').val() == '' || $('#gender_staff').val() == '' || $('#age_staff').val() == '' || $('#residence_staff').val() == '' || $('#school').val() == ''){
            alert("Please fill all spaces");

        } else {

            $('#modal-auth').modal('show');
            $('#modal-register').modal('hide');

            var firstName = $('#firstName_staff').val();
            var surname = $('#surname_staff').val();
            var otherName = $('#otherName_staff').val();
            var contact = $('#contact_staff').val();
            var gender = $('#gender_staff').val();
            var age = $('#age_staff').val();
            var residence = $('#residence_staff').val();
            var school = $('#school').val();

            $.ajax({

                url: "includes/inc.processes.php",
                method: "POST",
                data: {
                    "patient": "staff",
                    "firstName": firstName,
                    "surname": surname,
                    "otherName": otherName,
                    "contact": contact,
                    "gender": gender,
                    "age": age,
                    "residence": residence,
                    "school": school
                },

                success:function (data) {

                    if (data == "SUCCESS") {

                        $('.disappear').addClass('invisible');
                        $('.wrong').addClass('invisible');
                        $('.change').addClass('visible');
                        setTimeout('$("#modal-auth").modal("hide")', 950);

                        last_inserted_patient();
                    }else {

                        $('.disappear').addClass('invisible');
                        $('.change').addClass('invisible');
                        $('.wrong').addClass('visible');
                        setTimeout("$('#modal-auth').modal('hide')", 1000);
                    }


                }


            })

        }





    });


    $('#register_for').on('click', function () {

        if ($('#firstName_for').val() == '' || $('#surname_for').val() == '' || $('#contact_for').val() == '' || $('#gender_for').val() == '' || $('#age_for').val() == '' || $('#residence_for').val() == ''){

            alert("Please fill all spaces");
        }else {

            $('#modal-auth').modal('show');
            $('#modal-register').modal('hide');

            var firstName = $('#firstName_for').val();
            var surname = $('#surname_for').val();
            var otherName = $('#otherName_for').val();
            var contact = $('#contact_for').val();
            var gender = $('#gender_for').val();
            var age = $('#age_for').val();
            var residence = $('#residence_for').val();


            $.ajax({

                url: "includes/inc.processes.php",
                method: "POST",
                data: {
                    "patient": "foreign",
                    "firstName": firstName,
                    "surname": surname,
                    "otherName": otherName,
                    "contact": contact,
                    "gender": gender,
                    "age": age,
                    "residence": residence,
                },

                success:function (data) {

                    if (data == "SUCCESS") {

                        $('.disappear').addClass('invisible');
                        $('.wrong').addClass('invisible');
                        $('.change').addClass('visible');
                        setTimeout('$("#modal-auth").modal("hide")', 950);

                        last_inserted_patient();
                    }else {

                        $('.disappear').addClass('invisible');
                        $('.change').addClass('invisible');
                        $('.wrong').addClass('visible');
                        setTimeout("$('#modal-auth').modal('hide')", 1000);
                    }


                }


            })

        }


    });

    function last_inserted_patient() {
        $.ajax({

            url: "includes/inc.last_inserted_patient.php",
            method: "POST",

            success: function (data) {
                $('#last_content').html(data);

                setTimeout("$('#last_inserted_patient').modal('show')", 1000);
                /*setInterval(function () {
                    $('#last_inserted_patient').modal('show');
                }, 1000);*/
            }
        });
    }

    $('#check').on('click', function () {

        $.ajax({

            url: "includes/inc.last_inserted_patient.php",
            method: "POST",

            success: function (data) {
                $('#last_content').html(data);
                $('#last_inserted_patient').modal('show');

            }
        });

    });
</script>

</body>

</html>