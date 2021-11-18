//////////////////////////////////////// Guardar
//////////////////////////////////////// Guardar

function guardarConfiguracionPagina(formulario, archivoEnvio, archivoVizualizar, dondeMostrar) {
    let datosValidar = [{ REQUERIDO: "viNombrePagina" }];
    let textoValidacion = validarFormulario(datosValidar);

    //---------------------- Con errores
    if (textoValidacion != "") {
        alertValidacionError(textoValidacion);
    } else {
        //---------------------- Sin errores
        Swal.fire({
            title: "ESTAS SEGURO DE REALIZAR ESTA OPERACIÓN ?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: colorSuccess,
            cancelButtonColor: incorrecto,
            confirmButtonText: "ACEPTAR",
            cancelButtonText: "CANCELAR",
        }).then((result) => {
            if (result.isConfirmed) {
                let datos = obtenerDatos(formulario);

                console.log(...datos);
                ajaxGuardar(archivoEnvio, archivoVizualizar, dondeMostrar, datos);
            }
        });
    }
}
