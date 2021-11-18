<?php
require_once("../../../clases/conexcion.php");
require_once("../../../clases/class.Sesion.php");
require_once("../../../clases/class.Funciones.php");
require_once("../../../clases/class.SeccionesArchivos.php");
require_once("../../../clases/class.Secciones.php");
require_once("../../../clases/class.Cursos.php");
require_once("../../../clases/class.Archivos.php");

//---------------------- Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$seccionesArchivos = new SeccionesArchivos();
$secciones = new Secciones();
$cursos = new Cursos();
$archivos = new Archivos();
$seccionesArchivos->db = $db;
$secciones->db = $db;
$cursos->db = $db;
$archivos->db = $db;

//---------------------- Sesion 
if (!isset($_SESSION['se_SAS'])) {
   header("Location: ../login.php");
   exit;
}

//---------------------- Rutas 
$rutaSeccionesArchivos = "modulos/cursos/seccionesArchivos/";
$rutaSecciones = "modulos/cursos/secciones/";

//---------------------- Parametros por GET
$idSecciones =  $_GET['idSecciones'];
$idCursos =  $_GET['idCursos'];

//---------------------- Consulta
$consultaSeccionesArchivos = $seccionesArchivos->getAllSeccionesArchivos($idSecciones);

// //---------------------- Consulta titulo de la seccion
$rowSecciones = $secciones->getOneSecciones($idSecciones);
$seccionesTitulo = $fun->imprimir_cadena_utf8($rowSecciones['titulo']);

//---------------------- Consulta nombre del curso
$rowCursos = $cursos->getOneCursos($idCursos);
$cursosNombre = $fun->imprimir_cadena_utf8($rowCursos['titulo']);

//---------------------- Funcion para vista Add
function add($id, $idSecciones, $idArchivos, $idCursos)
{
   global $rutaSeccionesArchivos;
   return "aparecermodulos('{$rutaSeccionesArchivos}vi_addSeccionesArchivos.php?id={$id}&idSecciones={$idSecciones}&idDocumentos={$idArchivos}&idCursos={$idCursos}','main')";
}
?>

<!-- //////////////////////////////////////// Vista tabla -->
<!-- //////////////////////////////////////// Vista tabla -->

<div class="card th-card-titulo">
   <div class="card-header">
      <h5 class="card-title">ARCHIVOS DE CURSO</h5>
      <div class="card-botones">

         <button onClick="aparecermodulos('<?= $rutaSecciones ?>vi_secciones.php?idCursos=<?= $idCursos ?>','main');" type="button" class="btn btn-info">VER SECCIONES</button>

         <button onClick="<?= add(0, $idSecciones, 0, $idCursos) ?>" type="button" class="btn btn-info">NUEVO ARCHIVO</button>

      </div>
   </div>
</div>

<div class="card th-card-subtitulo">
   <div class="card-header">
      <h5 class="card-title">CURSOS / SECCIONES / ARCHIVOS DE SECCIÓN</h5>
      <h5 class="card-title">CURSO : <?= $cursosNombre ?></h5>
      <h5 class="card-title">SECCIÓN : <?= $seccionesTitulo ?></h5>
   </div>
</div>

<div class="card th-card-table">
   <div class="card-body">
      <div class="table-responsive">
         <table id="zeroConfig" class="table table-striped table-bordered">
            <thead>
               <tr>
                  <th class="text-center">ID</th>
                  <th class="text-center">ARCHIVO</th>
                  <th class="text-center">CONTENIDO</th>
                  <th class="text-center">ACCIONES</th>
               </tr>
            </thead>
            <tbody>

               <?php
               while ($rowSeccionesArchivos = $db->fetch_assoc($consultaSeccionesArchivos)) {

                  //---------------------- Variables de la vista
                  $id = $fun->imprimir_cadena_utf8($rowSeccionesArchivos['idsecciones_archivos']);
                  $contenido = $fun->imprimir_cadena_utf8($rowSeccionesArchivos['contenido']);
                  $idArchivos = $fun->imprimir_cadena_utf8($rowSeccionesArchivos['idarchivos']);

                  // ---------------------- Consulta titulo del Archivo
                  $rowArchivos = $archivos->getOneArchivos($idArchivos);
                  $archivosTitulo = $fun->imprimir_cadena_utf8($rowArchivos['titulo']);
               ?>
                  <tr>
                     <td align="center"><?= $id ?></td>
                     <td align="center"><?= $archivosTitulo ?></td>
                     <td align="center"><?= $contenido ?></td>
                     <td align="center">

                        <!-- Editar-->
                        <button onClick="<?= add($id, $idSecciones, $idArchivos, $idCursos) ?>" type="button" class="btn btn-outline-info" title="EDITAR"><i class="fas fa-pencil-alt"></i></button>

                        <!-- Eliminar-->
                        <button onClick="borrarSeccionesArchivos('<?= $id; ?>','idsecciones_archivos','secciones_archivos','n','<?= $rutaSeccionesArchivos ?>vi_seccionesArchivos.php?idSecciones=<?= $idSecciones ?>&idCursos=<?= $idCursos ?>','main');" type="button" class="btn btn-outline-danger" title="ELIMINAR"><i class="fas fa-trash-alt"></i></button>

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

<!-- //---------------------- Paginacion -->
<script type="text/javascript" charset="utf-8">
   var oTable = $('#zeroConfig').dataTable({
      "oLanguage": {
         "sLengthMenu": "Mostrar _MENU_ Registros por página",
         "sZeroRecords": "No existen registros en esta tabla",
         "sInfo": "Mostrar _START_ a _END_ de _TOTAL_ Registros",
         "sInfoEmpty": "",
         "sInfoFiltered": "(filtered desde _MAX_ total Registros)",
         "sSearch": "",
         "oPaginate": {
            "sFirst": "Inicio",
            "sPrevious": "Anterior",
            "sNext": "Siguiente",
            "sLast": "Ultimo"
         }
      },
      "sPaginationType": "full_numbers",
      "ordering": false,
      // "sScrollX": "100%",
      // "sScrollXInner": "100%",
   });
</script>