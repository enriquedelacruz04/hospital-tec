// JavaScript Document

function RedondearaDos(num) {
    return +(Math.round(num + "e+2") + "e-2");
}

function formato_numero(numero, decimales, separador_decimal, separador_miles) {
    // v2007-08-06
    numero = parseFloat(numero);
    if (isNaN(numero)) {
        return "";
    }

    if (decimales !== undefined) {
        // Redondeamos
        numero = numero.toFixed(decimales);
    }

    // Convertimos el punto en separador_decimal
    numero = numero.toString().replace(".", separador_decimal !== undefined ? separador_decimal : ",");

    if (separador_miles) {
        // Añadimos los separadores de miles
        var miles = new RegExp("(-?[0-9]+)([0-9]{3})");
        while (miles.test(numero)) {
            numero = numero.replace(miles, "$1" + separador_miles + "$2");
        }
    }

    return numero;
}

function Backup(donde, regresar) {
    //alert(archivo_envio);
    if (confirm("\u00BFEstas seguro de querer realizar esta operaci\u00f3n?")) {
        //console.log(datos);

        $("#main").html('<div align="center" class="mostrar"><img src="images/loading.gif" alt="" /><br />Subiendo Archivos...</div>');

        setTimeout(function () {
            $.ajax({
                url: "administrador/backup.php", //Url a donde la enviaremos
                type: "POST", //Metodo que usaremos
                //data: datos, //Le pasamos el objeto que creamos con los archivos
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    var error;
                    console.log(XMLHttpRequest);
                    if (XMLHttpRequest.status === 404) error = "Pagina no existe" + XMLHttpRequest.status; // display some page not found error
                    if (XMLHttpRequest.status === 500) error = "Error del Servidor" + XMLHttpRequest.status; // display some server error
                    $("#abc").html('<div class="alert_error">' + error + "</div>");
                    //aparecermodulos("catalogos/vi_ligas.php?ac=0&msj=Error. "+error,'main');
                },
                success: function (msj) {
                    console.log("El resultado de msj es: " + msj);
                    var array = msj.split("|");
                    if (array[0] == 1) {
                        aparecermodulos(regresar + "?ac=1&msj=Operacion realizada con exito", donde);
                    } else {
                        aparecermodulos(regresar + "?ac=0&msj=Error. " + msj, donde);
                    }
                },
            });
        }, 1000);
    }
}

function iraLogin() {
    console.log("fue a login");
    window.location.href = "index.php";
}

////////////////////////////////////////  animaciones al menu
////////////////////////////////////////  animaciones al menu

let iconos_menu = document.querySelectorAll(".sidebar-item .sidebar-item").forEach(function (icono_menu) {
    icono_menu.addEventListener("click", function () {
        document.querySelectorAll(".sidebar-item .sidebar-item").forEach(function (icono_menu) {
            icono_menu.classList.remove("sidebar-animate");
        });

        icono_menu.classList.add("sidebar-animate");
        // document.querySelector("input").placeholder = "BUSCAR";
    });
});


// document.getElementById("myText").placeholder = "Type name here..";

