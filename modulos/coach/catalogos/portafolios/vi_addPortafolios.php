<?php
require_once("../../clases/conexcion.php");
require_once("../../clases/class.Sesion.php");
require_once("../../clases/class.Funciones.php");
require_once("../../clases/class.Sucursales.php");

//---------------------- Funciones
$db = new MySQL();
$se = new Sesion();
$fun = new Funciones();
$servicios = new Servicios();
$sucursales->db = $db;

//---------------------- Sesion 
if (!isset($_SESSION['se_SAS'])) {
    header("Location: ../login.php");
    exit;
}

//---------------------- Rutas de archivo
$ruta1 = "catalogos/sucursales/";

//---------------------- Editando o creando
$id = $_GET['id'];
$editar = ($id != 0) ? true : false;

if ($editar) {
    $rowSucursales = $sucursales->getOneSucursales($id);
}

//---------------------- Datos a rellenar del formulario si esta en editar o valor predeterminado si esta en crear
$idCliente = ($editar) ?  $fun->imprimir_cadena_utf8($rowSucursales['idcliente']) : '';
$nombre = ($editar) ?  $fun->imprimir_cadena_utf8($rowSucursales['nombre']) : '';
$direccion = ($editar) ?  $fun->imprimir_cadena_utf8($rowSucursales['direccion']) : '';
$whatsapp = ($editar) ?  $fun->imprimir_cadena_utf8($rowSucursales['whatsapp']) : '';
$email = ($editar) ?  $fun->imprimir_cadena_utf8($rowSucursales['email']) : '';
$estatus = ($editar) ?  $fun->imprimir_cadena_utf8($rowSucursales['estatus']) : '1';

//---------------------- Directorio de Imagenes
$directorioImagenes = $ruta1 . "imagenes/";
$logo = ($editar) ?  $directorioImagenes . $rowSucursales['logo'] : 'images/sinfoto.png';

//---------------------- Consultas para rellenar campos del formulario 
$consultaClientes = $sucursales->getAllClientes();
?>

<!-- //////////////////////////////////////// Vista de formulario -->
<!-- //////////////////////////////////////// Vista de formulario -->

<div class="card">
    <div class="card-body d-flex flex-column flex-lg-row justify-content-between">
        <h5 class="card-title mr-2"><?= ($editar) ? "MODIFICAR SUCURSAL" : "ALTA DE SUCURSAL" ?></h5>
        <div class="d-flex flex-wrap justify-content-end">
            <button onClick="aparecermodulos('<?= $ruta1 ?>vi_sucursales.php','main');" type="button" class="btn btn-info mr-2 mb-2 mb-md-0">VER SUCURSALES</button>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">DATOS DE LA SUCURSAL</h5>
        <form id="form-add-sucursales" class="mt-4">

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>CLIENTE:</label>
                    <select class="form-control" id="viIdCliente" name="viIdCliente">
                        <option value="0" disabled selected>SELECCIONE UN CLIENTE</option>
                        <?php
                        while ($rowClientes = $db->fetch_assoc($consultaClientes)) {
                            $rowClientesId = $rowClientes['idcliente'];
                            $rowClientesNombre = $fun->imprimir_cadena_utf8($rowClientes['nombre']) . " " .
                                $fun->imprimir_cadena_utf8($rowClientes['paterno']) . " " .
                                $fun->imprimir_cadena_utf8($rowClientes['materno']);
                        ?>
                            <option value="<?= $rowClientesId ?>" <?= ($idCliente == $rowClientesId) ? 'selected="selected"' : ''  ?>>
                                <?= $rowClientesNombre ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>NOMBRE:</label>
                    <input type="text" class="form-control" id="viNombre" name="viNombre" value="<?= $nombre ?>" title="NOMBRE">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>CORREO:</label>
                    <input type="text" class="form-control" id="viEmail" name="viEmail" value="<?= $email ?>" title="CORREO">
                </div>
                <div class="form-group col-md-6">
                    <label>WHATSAPP:</label>
                    <input type="number" class="form-control" id="viWhatsapp" name="viWhatsapp" value="<?= $whatsapp ?>" title="WHATSAPP">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>DIRECCION:</label>
                    <textarea class="form-control" id="viDireccion" name="viDireccion" rows="3" title="DIRECCION"><?= $direccion ?></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label>ESTATUS:</label>
                    <select class="form-control" id="viEstatus" name="viEstatus">
                        <option value="1" <?= ($estatus == 1) ? 'selected="selected"' : "" ?>>ACTIVO</option>
                        <option value="0" <?= ($estatus == 0) ? 'selected="selected"' : "" ?>>NO ACTIVO</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>LOGO:</label>
                    <input type="file" class="form-control" id="viLogo" name="viLogo" accept=".png, .jpg, .jpeg">
                    <div class="col-md-12 d-flex justify-content-center mt-4">
                        <img src="<?php echo $logo; ?>" class="border border-dark" width="150" height="150" alt="logo" />
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-12 d-flex justify-content-end">

                    <input type="hidden" id="viId" name="viId" value="<?php echo $id ?>" />

                    <button onClick="var resp=MM_validateForm('viNombre','','R','viWhatsapp','','R','viEmail','','isEmail'); 
                    if(resp==1){
                        guardarSucursales('form-add-sucursales',
                        '<?= $ruta1 ?>c_addSucursales.php',
                        '<?= $ruta1 ?>vi_sucursales.php',
                        'main')
                    }" type="button" class="btn btn-success mt-3"><?= ($editar) ? "ACTUALIZAR" : "GUARDAR" ?></button>
                </div>
            </div>
        </form>
    </div>
</div>