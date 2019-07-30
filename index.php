<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Authentic">
    <title>Login | UENR Clinic</title>
    <!-- Favicon -->
    <link href="assets/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="assets/css/argon_1.css?v=1.0.1" rel="stylesheet">
    <link type="text/css" href="assets/css/argon.css?v=1.0.1" rel="stylesheet">
    <!-- Docs CSS -->
    <link type="text/css" href="assets/css/docs.min.css" rel="stylesheet">

    <style>
        .has-danger input, .has-danger span i{
            color: #f5365c !important;
        }

        .has-success input, .has-success span i{
            color: #2dce89 !important;
        }

        .invisible {
            display: none!important;
        }

        .visible {
            display: block!important;
        }



    </style>


</head>

<body class="h-100">

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

<main class="">
    <section class="section section-shaped section-lg h-100vh">
        <div class="shape shape-style-1 bg-gradient-default">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="container pt-lg-md">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-header bg-white text-center">
                            <img class="mb-2" src="assets/img/brand/favicon.png" alt="" width="50" height="50">

                            <h2 class="font-weight-normal text-dark">Orients Dev Inc.</h2>
                        </div>
                        <div class="card-body px-lg-5 py-lg-4">
                            <form role="form" method="post" id="login_form">
                                <div class="form-group" id="email_group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Email" type="email" id="email" name="email" required>
                                    </div>
                                </div>
                                <div class="form-group" id="password_group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control has-danger" placeholder="Password" type="password" id="password" name="password" required>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-2 mb-0 btn-sm px-5" name="submit">Sign in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
$fulUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>

<!-- Core -->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/popper/popper.min.js"></script>
<script src="assets/vendor/bootstrap/bootstrap.min.js"></script>
<script src="assets/vendor/headroom/headroom.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<script src="assets/js/notifications.js"></script>
<!-- Argon JS -->
<script src="assets/js/argon.js?v=1.0.1"></script>

<script>

    $(document).ready(function () {
        <?php
        if (strpos($fulUrl, "sessionOut") == true){//outputting an alert when session dies
        ?>

        notification.session_died('top','right');

        <?php
        }
        ?>
    });

    $("#email").keyup(function () {
        var email = $('#email').val();
        var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);

        if (!e_patt.test(email)){
            $('#email').removeClass("is-valid");
            $('#email_group').removeClass("has-success");
            $('#email').addClass("is-invalid");
            $('#email_group').addClass("has-danger");


        }else {
            $('#email').removeClass("is-invalid");
            $('#email_group').removeClass("has-danger");
            $('#email').addClass("is-valid");
            $('#email_group').addClass("has-success");

        }


    });

    $('#password').keyup(function () {

        var password = $('#password').val();

        if (password.length < 4) {
            $('#password').removeClass("is-valid");
            $('#password_group').removeClass("has-success");
            $('#password').addClass("is-invalid");
            $('#password_group').addClass("has-danger");


        }else {
            $('#password').removeClass("is-invalid");
            $('#password_group').removeClass("has-danger");
            $('#password').addClass("is-valid");
            $('#password_group').addClass("has-success");

        }


    });


</script>

<!--  Script for authentication or for login -->
<script>

    $('#login_form').on('submit', function (e) {

        e.preventDefault();

        var email = $('#email').val();
        var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);
        var password = $('#password').val();

        if (!e_patt.test(email)){
            $('#email').removeClass("is-valid");
            $('#email_group').removeClass("has-success");
            $('#email').addClass("is-invalid");
            $('#email_group').addClass("has-danger");

            notification.invalid_email('top', 'right');

        }else if (password.length < 4) {
            $('#password').removeClass("is-valid");
            $('#password_group').removeClass("has-success");
            $('#password').addClass("is-invalid");
            $('#password_group').addClass("has-danger");

            notification.invalid_password('top', 'right');

        }else {

            $('#authentication').modal('show');

            console.log("email -"+email);
            console.log("password -"+password);

            $.ajax({

                url: "includes/inc.processes.php",
                method: "POST",
                data: {
                    "login": "login",
                    "email": email,
                    "password": password
                },

                success: function (data) {

                    if (data == "Opd") {

                        $('#checking').addClass('invisible');
                        $('#wrong').addClass('invisible');
                        $('#success').removeClass('invisible');

                        setInterval(function () {
                            window.location = "pages/opd.php";
                        }, 1000)

                    }else if (data == "Nurse") {

                        $('#checking').addClass('invisible');
                        $('#wrong').addClass('invisible');
                        $('#success').removeClass('invisible');

                        setInterval(function () {
                            window.location = "pages/nurse.php";
                        }, 1000)

                    }else if (data == "Doctor") {

                        $('#checking').addClass('invisible');
                        $('#wrong').addClass('invisible');
                        $('#success').removeClass('invisible');

                        setInterval(function () {
                            window.location = "pages/doctor.php";
                        }, 1000)

                    }else if (data == "Labtech") {

                        $('#checking').addClass('invisible');
                        $('#wrong').addClass('invisible');
                        $('#success').removeClass('invisible');

                        setInterval(function () {
                            window.location = "pages/lab_tech.php";
                        }, 1000)

                    }else if (data == "Pharmacist") {

                        $('#checking').addClass('invisible');
                        $('#wrong').addClass('invisible');
                        $('#success').removeClass('invisible');

                        setInterval(function () {
                            window.location = "pages/pharm.php";
                        }, 1000)

                    }else if (data == "INVALID_EMAIL") {

                        $('#checking').addClass('invisible');
                        $('#success').addClass('invisible');
                        $('#wrong').removeClass('invisible');

                        $('#email').val('');

                        $('#email').removeClass("is-valid");
                        $('#email_group').removeClass("has-success");
                        $('#email').addClass("is-invalid");
                        $('#email_group').addClass("has-danger");

                        notification.incorrect_email('top', 'right');

                        setTimeout("$('#authentication').modal('hide')", 1200);

                    }else if (data == "INVALID_PASSWORD") {

                        $('#checking').addClass('invisible');
                        $('#success').addClass('invisible');
                        $('#wrong').removeClass('invisible');

                        $('#password').val('');

                        $('#password').removeClass("is-valid");
                        $('#password_group').removeClass("has-success");
                        $('#password').addClass("is-invalid");
                        $('#password_group').addClass("has-danger");

                        notification.unmatched_password('top', 'right');

                        setTimeout("$('#authentication').modal('hide')", 1200);

                    }

                }

            });
        }


    });

    $(document).ready(function () {
        <?php
        if (strpos($fulUrl, "session_die") == true){//outputting an alert when session dies
        ?>

        notification.session_died('top','right');

        <?php
        }
        ?>
    });

</script>

</body>
</html>