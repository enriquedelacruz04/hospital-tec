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
    <!-- Favicon icon -->
    <title>Sistema </title>



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



</head>

<body>




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
                    <img src="images/logo.svg" alt="">
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

            <div class="container-fluid" id="main">

                <div class="row">

                    <div class="" style="display: flex; flex-direction: column; align-items: center; width: 100%; margin-top:5rem">


                        <h1 style="text-align: center; font-size: 5rem; ">Sistema HOSPITAL</h1>
                        <img src="images/logo.svg " style="width: 200px; margin-top:5rem" alt="">
                    </div>

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
                TODOS LOS DERECHOS RESERVADOS &COPY; TALLER DE BASE DE DATOS
                <!--<a href="https://wrappixel.com">WrapPixel</a>.-->
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->



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
        <!--Wave Effects -->
        <script src="dist/js/waves.js"></script>
        <!--Menu sidebar -->
        <script src="dist/js/sidebarmenu.js"></script>
        <!--Custom JavaScript -->
        <script src="dist/js/custom.min.js"></script>

        <!-- //////////////////////////////////////// Funciones para SCRIPTS -->
        <!-- //////////////////////////////////////// Funciones para SCRIPTS -->

        <script src="js/fn_Funciones.js"></script>
        <script src="js/fn_bitacora.js"></script>
        <script src="js/fn_LoginTime.js"></script>
        <script src="js/fn_Jquery.js" type="text/javascript"></script>
        <script src="js/fn_Administrador.js" type="text/javascript"></script>

        <script src="js/fn_generales.js" type="text/javascript"></script>


    </div>
</body>

</html>