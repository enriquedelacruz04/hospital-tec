//////////////////////////////////////// Variables CSS
//////////////////////////////////////// Variables CSS

const colorSuccess = "#47a0f3";
const incorrecto = "#cf0808";

//////////////////////////////////////// Funciones
//////////////////////////////////////// Funciones

function obtenerDatos(form) {
    let formulario = document.querySelector("#" + form);
    let datos = new FormData();

    for (var elemento of formulario) {
        if (elemento.tagName == "INPUT" || elemento.tagName == "TEXTAREA" || elemento.tagName == "SELECT") {
            datos.append(elemento.name, elemento.value);
        }
    }
    return datos;
}

function obtenerImagen(id, datos) {
    let input = document.querySelector("#" + id);
    let archivo = input.files;

    for (var elemento of archivo) {
        console.log(elemento);
        datos.append(id, elemento);
    }
    return datos;
}

function capitalizar(word) {
    let textoSplit = word.split(" ");
    let texto = "";
    textoSplit.forEach((elemento, index) => {
        texto += elemento[0] + elemento.slice(1).toLowerCase() + " ";
    });
    texto = texto.trim();
    return texto;
}

function obtenerLabel(elemento) {
    let entrada = document.querySelector("#" + elemento);
    let label = entrada.parentElement.firstElementChild.innerText;
    label = capitalizar(label).replace(":", "").trim();

    return label;
}

function validarFormulario(datos) {
    let texto = "";
    const pattern = new RegExp(/^[a-zA-Z\u00C0-\u017F\s]+$/);

    datos.forEach(function (elemento) {
        let clave = Object.keys(elemento)[0];
        let valor = Object.values(elemento)[0];
        let label = obtenerLabel(valor);
        let entrada = document.querySelector("#" + valor);

        if (clave == "REQUERIDO") {
            if (entrada.value == "") {
                texto += "<p> EL campo <span style='font-weight: 700'> \"" + label + '"</span> esta vacio </p>';
            }
        }

        if (clave == "TEXT") {
            if (entrada.value == "") {
                texto += "<p> EL campo " + label + " esta vacio </p> ";
            } else if (!pattern.test(entrada.value)) {
                texto += "<p> EL campo <span style='font-weight: 700'> \"" + label + '"</span> debe contener solo letras </p>';
            }
        }
    });

    return texto;
}

function alertOk(texto) {
    Swal.fire({
        position: "center",
        icon: "success",
        title: texto,
        showConfirmButton: false,
        timer: 900,
    });
}

function alertError(texto) {
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: texto,
        confirmButtonColor: colorSuccess,
    });
}

function alertValidacionError(texto) {
    Swal.fire({
        title: "Hubo en error",
        icon: "warning",
        html: texto,
        confirmButtonText: "ACEPTAR",
        confirmButtonColor: colorSuccess,
    });
}

function ajaxGuardar(archivoEnvio, archivoVizualizar, dondeMostrar, datos) {
    $("#abc").html('<div align="center" class="mostrar"><img src="images/loading.gif" alt="" /><br />Cargando...</div>');
    overlayopen("abc");

    $.ajax({
        type: "POST",
        url: archivoEnvio,
        data: datos,
        contentType: false, //Debe estar en false para que pase el objeto sin procesar
        processData: false, //Debe estar en false para que JQuery no procese los datos a enviar
        success: function (msj) {
            console.log("El resultado de msj es: " + msj);
            if (msj == 1) {
                overlayclose("abc");
                aparecermodulos(archivoVizualizar, dondeMostrar);
                alertOk("REGISTRO GUARDADO CORRECTAMENTE");
            } else {
                overlayclose("abc");
                aparecermodulos(archivoVizualizar, dondeMostrar);
                alertError(msj);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            var error;
            console.log(XMLHttpRequest);
            if (XMLHttpRequest.status === 404) error = "PAGINA NO EXISTE " + XMLHttpRequest.status; // display some page not found error
            if (XMLHttpRequest.status === 500) error = "ERROR DEL SERVIDOR " + XMLHttpRequest.status; // display some server error
            if (textStatus === "timeout") error = " SE HA DEMORADO DEMASIADO TIEMPO "; // display some server error
            overlayclose("abc");
            aparecermodulos(archivoVizualizar, dondeMostrar);
            alertError(error);
        },

        timeout: 7000,
    });
}

function ajaxEliminar(archivoVizualizar, dondeMostrar, cadena) {
    $("#abc").html('<div align="center" class="mostrar"><img src="images/loading.gif" alt="" /><br />Cargando...</div>');
    overlayopen("abc");

    $.ajax({
        type: "POST",
        url: "clases/borrar.php",
        data: cadena,
        success: function (msj) {
            if (msj == 1) {
                overlayclose("abc");
                aparecermodulos(archivoVizualizar, dondeMostrar);
                alertOk("REGISTRO BORRADO CORRECTAMENTE");
            } else {
                overlayclose("abc");
                aparecermodulos(archivoVizualizar, dondeMostrar);
                alertError("A OCURRIDO UN ERROR!  " + msj);
            }
        },
        error: function () {
            aparecermodulos(archivoVizualizar, dondeMostrar);
            alertError("A OCURRIDO UN DURANTE LA EJECUCIÓN! ");
        },
        timeout: 5000,
    });
}

// //////////////////////////////////////// Seleccionar Imagen
// //////////////////////////////////////// Seleccionar Imagen

// function eventSelectImagen() {
//     document.querySelectorAll(".th-modal-card-imagen").forEach(function (element) {
//         element.addEventListener("click", function () {
//             document.querySelectorAll(".th-modal-card-imagen").forEach(function (element) {
//                 element.classList.remove("th-modal-card-imagen--active");
//             });

//             this.classList.add("th-modal-card-imagen--active");
//         });
//     });
// }

// function selectImagen() {
//     let imgId = document.querySelector(".th-modal-card-imagen--active #viRowImagenesId");
//     let imagenTitulo = document.querySelector(".th-modal-card-imagen--active h5");
//     let img = document.querySelector(".th-modal-card-imagen--active img");

//     $("#modalAddImagen").modal("hide");

//     document.querySelector(".select-imagen #viIdImagenes").value = imgId.value;
//     document.querySelector(".select-imagen #imagenSelectInput").value = imagenTitulo.innerText;
//     document.querySelector(".select-imagen img").setAttribute("src", img.src);
//     document.querySelector(".select-imagen img").style.display = "block";
// }

// //////////////////////////////////////// Seleccionar Video
// //////////////////////////////////////// Seleccionar Video

// function eventSelectVideo() {
//     document.querySelectorAll(".th-modal-card-video").forEach(function (element) {
//         element.addEventListener("click", function () {
//             document.querySelectorAll(".th-modal-card-video").forEach(function (element) {
//                 element.classList.remove("th-modal-card-video--active");
//             });
//             this.classList.add("th-modal-card-video--active");
//         });
//     });
// }

// function selectVideo() {
//     let videoId = document.querySelector(".th-modal-card-video--active #viRowVideosId");
//     let videoTitulo = document.querySelector(".th-modal-card-video--active h5");

//     $("#modalAddVideo").modal("hide");

//     document.querySelector(".select-video #viIdVideos").value = videoId.value;
//     document.querySelector(".select-video #videoSelectInput").value = videoTitulo.innerText;
// }

//////////////////////////////////////// Seleccionar Archivo
//////////////////////////////////////// Seleccionar Archivo

function eventSelectArchivo() {
    document.querySelectorAll(".th-modal-item").forEach(function (element) {
        element.addEventListener("click", function () {
            document.querySelectorAll(".th-modal-item").forEach(function (element) {
                element.classList.remove("th-modal-item--active");
            });
            this.classList.add("th-modal-item--active");
        });
    });
}

function selectArchivo() {
    let archivoId = document.querySelector(".th-modal-item--active #viRowArchivosId");
    let archivoTitulo = document.querySelector(".th-modal-item--active h5");

    $("#modalAddArchivo").modal("hide");

    document.querySelector("#archivoSelect #viIdArchivos").value = archivoId.value;
    document.querySelector("#archivoSelect .th-vizualizar-documentos p").innerText = archivoTitulo.innerText;
}
