<?php
require_once("clases/class.Funciones.php");
$f = new Funciones();

$navegador = $f->navegador();



?>
<!DOCTYPE html>
<html dir="ltr" lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <!-- Favicon icon -->
    <title>Inicio de sesi&oacute;n</title>

    <!-- //////////////////////////////////////// FONT AWESOME y GOOGLE FONTS -->
    <!-- //////////////////////////////////////// FONT AWESOME y GOOGLE FONTS -->

    <script src="https://kit.fontawesome.com/6ca9955e84.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;600&display=swap');
    </style>
    
    <!-- //////////////////////////////////////// CUSTOM CSS -->
    <!-- //////////////////////////////////////// CUSTOM CSS -->

    <link href="build/css/app.min.css" rel="stylesheet">

    <!-- /////////////////////////////////////////////////////////////////////  -->

</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
            <div class="auth-box  border-top">
                <div id="loginform">
                    <div class="text-center p-t-20 p-b-20">
                        <h1 style="font-size: 2rem; margin-bottom:2rem">Sistema Hospital</h1>
                        <span class="db" style="color: #fff; font-weight: bold; font-size: 25px;">
                            <img src="images/logo.svg" style="height: 100px;" alt="logo" />
                            <!--Sistema de Ventas-->
                        </span>
                    </div>
                    <!-- Form -->
                    <form class="form-horizontal m-t-20" id="loginform">
                        <div class="row p-b-30">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <i class="fas fa-user"></i>
                                    <div class="input-group-prepend">
                                        <!--<span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>-->
                                    </div>
                                    <input type="text" name="usuario" class="form-control form-control-lg" placeholder="Usuario" id="usuario" aria-label="Usuario" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <i class="fas fa-unlock"></i>
                                    <div class="input-group-prepend">
                                        <!--<span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>-->
                                    </div>
                                    <input type="password" name="contrasena" class="form-control form-control-lg" placeholder="Contrase&ntilde;a" id="password" aria-label="Contrase&ntilde;a" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                        <div class="row border-top">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20">
                                        <!--<button class="btn btn-info" id="to-recover" type="button"><i class="fa fa-lock m-r-5"></i> Lost password?</button>-->
                                        <div class="alert alert-danger" role="alert" style="display: none;"></div>
                                        <div class="alert alert-success" role="alert" style="display: none;"></div>
                                        <div id="validar"><button id="validar" class="btn btn-success float-right" type="button">Iniciar sesi&oacute;n</button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
            <div class="modal-dialog" role="document ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Popup Header</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true ">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Here is the text coming you can put also image if you want…
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
        $('#to-login').click(function() {

            $("#recoverform").hide();
            $("#loginform").fadeIn();
        });
    </script>

    <script src="js/fn_Login.js" type="text/javascript"></script>
    <script src="js/fn_Jquery.js" type="text/javascript"></script>

</body>

</html>