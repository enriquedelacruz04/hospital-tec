<?php
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Sesion.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Paciente.php");

//========================= Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$paciente = new Paciente();
$paciente->db = $db;

//========================= Sesion 
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../login.php");
    exit;
}

//========================= Rutas
$rutaViPaciente = "modulos/paciente/vi_paciente.php";
$rutaFaPaciente = "modulos/paciente/fa_paciente.php";
$rutaGaPaciente = "modulos/paciente/ga_paciente.php";
?>

<!-- //=========================================================== -->
<!-- // Vista de tabla  -->
<!-- //===========================================================  -->

<div class="card th-card-titulo">
    <div class="card-header">
        <h5 class="card-title">PACIENTES</h5>
        <div class="card-botones">
            <button onClick="aparecermodulos('<?= $rutaFaPaciente . "?rfc=0"  ?>','main');" type=" button" class="btn btn-info">NUEVO PACIENTE</button>
        </div>
    </div>
</div>

<div class="card th-card-table">
    <div class="card-body">
        <div class="table-responsive">
            <table id="zeroConfig" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">RFC</th>
                        <th class="text-center">NOMBRE</th>
                        <th class="text-center">EDAD</th>
                        <th class="text-center">SEXO</th>
                        <th class="text-center">TELEFONO</th>
                        <th class="text-center">TIPO DERECHO HABIENTE</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    //========================= Consulta
                    $consultaPaciente = $paciente->getAllPaciente();
                    while ($rowPaciente = $db->fetch_assoc($consultaPaciente)) {

                        //========================= Variables de la vista
                        $rfc = $rowPaciente['rfc'];
                        $nombre = $rowPaciente['nombre'];
                        $edad = $rowPaciente['edad'];
                        $sexo = $rowPaciente['sexo'];
                        $telefono = $rowPaciente['telefono'];
                        $tipo = $rowPaciente['tipo_derecho_habiente'];
                    ?>
                        <tr>
                            <td align="center"><?= $rfc ?></td>
                            <td align="center"><?= $nombre ?></td>
                            <td align="center"><?= $edad ?></td>
                            <td align="center"><?= $sexo ?></td>
                            <td align="center"><?= $telefono ?></td>
                            <td align="center"><?= $tipo ?></td>
                            <td align="center">

                                <!-- Editar -->
                                <button onClick="aparecermodulos('<?= $rutaFaPaciente . "?rfc=$rfc" ?>','main');" type="button" class="btn btn-outline-info" title="EDITAR"><i class="fas fa-pencil-alt"></i></button>

                                <!-- Eliminar -->
                                <button onClick="BorrarDatos('<?= $rfc ?>','rfc','paciente','1','<?= $rutaViPaciente ?>','main');" type="button" class="btn btn-outline-danger" title="ELIMINAR"><i class="fas fa-trash-alt"></i></button>

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