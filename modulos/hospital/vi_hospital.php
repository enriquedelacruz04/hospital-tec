<?php
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Sesion.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Hospital.php");

//========================= Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$hospital = new Hospital();
$hospital->db = $db;

//========================= Sesion 
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../login.php");
    exit;
}

//========================= Rutas
$rutaViHospital = "modulos/hospital/vi_hospital.php";
$rutaFaHospital = "modulos/hospital/fa_hospital.php";
$rutaGaHospital = "modulos/hospital/ga_hospital.php";
?>

<!-- //=========================================================== -->
<!-- // Vista de tabla  -->
<!-- //===========================================================  -->

<div class="card th-card-titulo">
    <div class="card-header">
        <h5 class="card-title">LISTA DE HOSPITALES </h5>
        <div class="card-botones">
            <button onClick="aparecermodulos('<?= $rutaFaHospital . "?numero=0"  ?>','main');" type=" button" class="btn btn-info">NUEVO HOSPITAL</button>
        </div>
    </div>
</div>

<div class="card th-card-table">
    <div class="card-body">
        <div class="table-responsive">
            <table id="zeroConfig" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">NUMERO</th>
                        <th class="text-center">NOMBRE</th>
                        <th class="text-center">DIRECCION</th>
                        <th class="text-center">TELEFONO</th>
                        <th class="text-center">CORREO</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    //========================= Consulta
                    $consultaHospital = $hospital->getAllHospital();
                    while ($rowHospital = $db->fetch_assoc($consultaHospital)) {

                        //========================= Variables de la vista
                        $numero = $rowHospital['numero'];
                        $nombre = $rowHospital['nombre'];
                        $direccion = $rowHospital['direccion'];
                        $telefono = $rowHospital['telefono'];
                        $correo = $rowHospital['correo'];
                    ?>
                        <tr>
                            <td align="center"><?= $numero ?></td>
                            <td align="center"><?= $nombre ?></td>
                            <td align="center"><?= $direccion ?></td>
                            <td align="center"><?= $telefono ?></td>
                            <td align="center"><?= $correo ?></td>
                            <td align="center">

                                <!-- Editar -->
                                <button onClick="aparecermodulos('<?= $rutaFaHospital . "?numero=$numero" ?>','main');" type="button" class="btn btn-outline-info" title="EDITAR"><i class="fas fa-pencil-alt"></i></button>

                                <!-- Eliminar -->
                                <button onClick="BorrarDatos('<?= $numero; ?>','numero','hospital','n','<?= $rutaViHospital ?>','main');" type="button" class="btn btn-outline-danger" title="ELIMINAR"><i class="fas fa-trash-alt"></i></button>

                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>