//////////////////////////////////////// Guardar
//////////////////////////////////////// Guardar

function guardarVideos(formulario, archivoEnvio, archivoVizualizar, dondeMostrar) {
    let datosValidar = [{ REQUERIDO: "viTitulo" }];
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
                datos = obtenerImagen("viArchivo", datos);
                console.log(...datos);

                ajaxGuardar(archivoEnvio, archivoVizualizar, dondeMostrar, datos);
            }
        });
    }
}

function borrarVideos(id, campo, tabla, tipo, archivoVizualizar, dondeMostrar) {
    var cadena = "id=" + id + "&campo=" + campo + "&tabla=" + tabla + "&tipo=" + tipo;

    Swal.fire({
        title: "ESTAS SEGURO DE REALIZAR ESTA OPERACIÓN ?",
        text: 'SE ELIMINARA EL REGISTRO CON ID = "' + id + '" ',
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: incorrecto,
        cancelButtonColor: colorSuccess,
        confirmButtonText: "SI, ELIMINAR!",
        cancelButtonText: "CANCELAR",
    }).then((result) => {
        if (result.isConfirmed) {
            ajaxEliminar(archivoVizualizar, dondeMostrar, cadena);
        }
    });
}
