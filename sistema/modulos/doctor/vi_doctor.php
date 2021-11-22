<?php
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Sesion.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Doctor.php");

//========================= Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$doctor = new Doctor();
$doctor->db = $db;

//========================= Sesion 
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../login.php");
    exit;
}

//========================= Rutas
$rutaViDoctor = "modulos/doctor/vi_doctor.php";
$rutaFaDoctor = "modulos/doctor/fa_doctor.php";
$rutaGaDoctor = "modulos/doctor/ga_doctor.php";
?>

<!-- //=========================================================== -->
<!-- // Vista de tabla  -->
<!-- //===========================================================  -->

<div class="card th-card-titulo">
    <div class="card-header">
        <h5 class="card-title">DOCTORES</h5>
        <div class="card-botones">
            <button onClick="aparecermodulos('<?= $rutaFaDoctor . "?cedula=0"  ?>','main');" type=" button" class="btn btn-info">NUEVO DOCTOR</button>
        </div>
    </div>
</div>

<div class="card th-card-table">
    <div class="card-body">
        <div class="table-responsive">
            <table id="zeroConfig" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">CEDULA</th>
                        <th class="text-center">NOMBRE</th>
                        <th class="text-center">EDAD</th>
                        <th class="text-center">SEXO</th>
                        <th class="text-center">TELEFONO</th>
                        <th class="text-center">ESPECIALIDAD</th>
                        <th class="text-center">NUMERO HOSPITAL</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    //========================= Consulta
                    $consultaDoctor = $doctor->getAllDoctor();
                    while ($rowDoctor = $db->fetch_assoc($consultaDoctor)) {

                        //========================= Variables de la vista
                        $cedula = $rowDoctor['cedula'];
                        $nombre = $rowDoctor['nombre'];
                        $edad = $rowDoctor['edad'];
                        $sexo = $rowDoctor['sexo'];
                        $telefono = $rowDoctor['telefono'];
                        $especialidad = $rowDoctor['especialidad'];
                        $hospital = $rowDoctor['hospital_numero'];
                    ?>
                        <tr>
                            <td align="center"><?= $cedula ?></td>
                            <td align="center"><?= $nombre ?></td>
                            <td align="center"><?= $edad ?></td>
                            <td align="center"><?= $sexo ?></td>
                            <td align="center"><?= $telefono ?></td>
                            <td align="center"><?= $especialidad ?></td>
                            <td align="center"><?= $hospital ?></td>
                            <td align="center">

                                <!-- Editar -->
                                <button onClick="aparecermodulos('<?= $rutaFaDoctor . "?cedula=$cedula" ?>','main');" type="button" class="btn btn-outline-info" title="EDITAR"><i class="fas fa-pencil-alt"></i></button>

                                <!-- Eliminar -->
                                <button onClick="BorrarDatos('<?= $cedula; ?>','cedula','doctor','1','<?= $rutaViDoctor ?>','main');" type="button" class="btn btn-outline-danger" title="ELIMINAR"><i class="fas fa-trash-alt"></i></button>

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