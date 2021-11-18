<?php
require_once("clases/class.Sesion.php");
$se = new Sesion();

//Validamos que eixista una sesion iniciada

if (!isset($_SESSION['se_SAS'])) {
    //Si no existe una sesion iniciada enviamos a login.

    echo '<script type="text/javascript">
				window.location = "login.php";
			</script>';
}


//Importamos las clases que se van a utilizar
require_once("clases/class.Letras.php");
require_once("clases/conexcion.php");
require_once("clases/class.Funciones.php");
require_once("clases/class.Fechas.php");


//Declaramos objetos de clase
$db = new MySQL();
$fe = new Fechas();
$f = new Funciones();


//Declaramos variables y asignamos valores.
$fecha_actual = explode("-", $fe->fechaaYYYY_mm_dd_guion());
$tipo = $_SESSION['se_sas_Tipo'];


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
    <link rel="shortcut icon" type="image/png" href="images/generales/favicon.ico" />
    <!-- Favicon icon -->
    <title>Sistema </title>

    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="assets/libs/magnific-popup/dist/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="dist/css/modal.css">
    <link rel="stylesheet" type="text/css" href="dist/css/select2.css">
    <link rel="stylesheet" type="text/css" href="dist/css/multi-select.css">


    <!-- //////////////////////////////////////// FONT AWESOME y GOOGLE FONTS -->
    <!-- //////////////////////////////////////// FONT AWESOME y GOOGLE FONTS -->

    <script src="https://kit.fontawesome.com/6ca9955e84.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');
    </style>

    <!-- //////////////////////////////////////// CUSTOM CSS -->
    <!-- //////////////////////////////////////// CUSTOM CSS -->

    <link href="build/css/app.min.css" rel="stylesheet">

    <!-- /////////////////////////////////////////////////////////////////////  -->


    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>

</head>

<body>


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
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->


    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->

        <header class="header">
            <div class="header__content">


                <div class="burger">
                    <div class="burger__content">
                        <div class="burger__layer burger__layer--top"></div>
                        <div class="burger__layer burger__layer--mid"></div>
                        <div class="burger__layer burger__layer--bottom"></div>
                    </div>
                </div>

                <div class="header__logo-text">
                    <p>HOSPITAL</p>
                </div>

                <div class="header__logo">
                    <a href="https://coachdanielrios.com/">
                        <img src="images/generales/logo_login.png" alt="">
                    </a>
                </div>

            </div>
        </header>

        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <?php include("menu.php"); ?>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb" style="display: none;">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Inicio</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid" id="main">

                <div class="row">


                </div>
                <!-- ============================================================== -->
                <!-- End Container fluid  -->
                <!-- ============================================================== -->

            </div>
            <!-- ============================================================== -->
            <!-- End Page wrapper  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                TODOS LOS DERECHOS RESERVADOS &COPY; COACH DANIEL RÍOS
                <!--<a href="https://wrappixel.com">WrapPixel</a>.-->
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->


        <!-- ================================ MODALES ================================================== -->
        <div class="modal fade" id="modal-forms" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="titulo-modal-forms">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body" id="contenedor-modal-forms">

                    </div>

                    <!--<div class="modal-footer">
					<button type="button" class="btn btn-primary">Save changes</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		  		</div>-->
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="Modal-visor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="titulo-visor"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="contenedor-visor-modal" style="overflow: auto;">
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="Modal-alertas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="titulo-alerta" style="text-align: center;"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="contenedor-modal-alerta" style="overflow: auto; text-align: center;">
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================================================= -->

        <!-- //////////////////////////////////////// sidebar despegable -->
        <!-- //////////////////////////////////////// sidebar despegable -->

        <script>
            let sidebar = document.querySelector(".left-sidebar");
            document.querySelector(".burger__content").addEventListener("click", function() {
                // sidebar.style.left = 0;
                sidebar.classList.toggle("th-esconder-sidebar");
            });
        </script>

        <!-- /////////////////////////////////////////////////////////////////////  -->


        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
        <script src="assets/libs/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <!-- <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script> -->
        <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
        <script src="assets/extra-libs/sparkline/sparkline.js"></script>
        <!--Wave Effects -->
        <script src="dist/js/waves.js"></script>
        <!--Menu sidebar -->
        <script src="dist/js/sidebarmenu.js"></script>
        <!--Custom JavaScript -->
        <script src="dist/js/custom.min.js"></script>
        <!--This page JavaScript -->
        <!-- <script src="../../dist/js/pages/dashboards/dashboard1.js"></script> -->
        <!-- Charts js Files -->
        <script src="assets/libs/flot/excanvas.js"></script>
        <script src="assets/libs/flot/jquery.flot.js"></script>
        <script src="assets/libs/flot/jquery.flot.pie.js"></script>
        <script src="assets/libs/flot/jquery.flot.time.js"></script>
        <script src="assets/libs/flot/jquery.flot.stack.js"></script>
        <script src="assets/libs/flot/jquery.flot.crosshair.js"></script>
        <script src="assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
        <script src="dist/js/pages/chart/chart-page-init.js"></script>
        <script src="assets/extra-libs/DataTables/datatables.min.js"></script>
        <script src="assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <script src="assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
        <script src="assets/libs/magnific-popup/meg.init.js"></script>
        <script src="dist/js/select2.full.min.js"></script>
        <script src="dist/js/jquery.multi-select.js"></script>
        <script src="dist/js/jquery.quicksearch.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- //////////////////////////////////////// Funciones para SCRIPTS -->
        <!-- //////////////////////////////////////// Funciones para SCRIPTS -->

        <script src="js/fn_Funciones.js"></script>
        <script src="js/fn_bitacora.js"></script>
        <script src="js/fn_LoginTime.js"></script>
        <script src="js/fn_Jquery.js" type="text/javascript"></script>
        <script src="js/fn_Administrador.js" type="text/javascript"></script>

        <script src="js/fn_generales.js" type="text/javascript"></script>
        <script src="js/fn_serviciosCoach.js" type="text/javascript"></script>
        <script src="js/fn_imagenes.js" type="text/javascript"></script>
        <script src="js/fn_videos.js" type="text/javascript"></script>
        <script src="js/fn_documentos.js" type="text/javascript"></script>
        <script src="js/fn_cursos.js" type="text/javascript"></script>
        <script src="js/fn_secciones.js" type="text/javascript"></script>
        <script src="js/fn_seccionesArchivos.js" type="text/javascript"></script>
        <script src="js/fn_cursosCaracteristicas.js" type="text/javascript"></script>
        <script src="js/fn_archivos.js" type="text/javascript"></script>
        <script src="js/fn_noticias.js" type="text/javascript"></script>
        <script src="js/fn_configuracionPagina.js" type="text/javascript"></script>


    </div>
</body>

</html>