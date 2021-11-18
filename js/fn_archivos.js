//////////////////////////////////////// Selecciona tipo de archivo
//////////////////////////////////////// Selecciona tipo de archivo

function eventTipoArchivo() {
    document.querySelector("#viTipo").addEventListener("change", function () {
        let tipo = this.value;
        console.log(tipo);

        let addImagen = document.querySelector("#addImagen");
        let addDocumento = document.querySelector("#addDocumento");
        let addVideo = document.querySelector("#addVideo");
        let addWeb = document.querySelector("#addWeb");

        addImagen.classList.add("d-none");
        addDocumento.classList.add("d-none");
        addVideo.classList.add("d-none");
        addWeb.classList.add("d-none");

        if (tipo == 1) {
            addImagen.classList.remove("d-none");
        } else if (tipo == 2) {
            addDocumento.classList.remove("d-none");
        } else if (tipo == 3) {
            addVideo.classList.remove("d-none");
        } else if (tipo == 4) {
            addWeb.classList.remove("d-none");
        }
    });
}

//////////////////////////////////////// Guardar
//////////////////////////////////////// Guardar

function guardarArchivos(formulario, archivoEnvio, archivoVizualizar, dondeMostrar) {
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
                datos = obtenerImagen("viImagen", datos);
                datos = obtenerImagen("viDocumento", datos);

                console.log(...datos);
                ajaxGuardar(archivoEnvio, archivoVizualizar, dondeMostrar, datos);
            }
        });
    }
}

//////////////////////////////////////// Borrar
//////////////////////////////////////// Borrar

function borrarArchivos(id, campo, tabla, tipo, archivoVizualizar, dondeMostrar) {
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
