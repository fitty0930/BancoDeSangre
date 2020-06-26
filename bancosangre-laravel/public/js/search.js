document.addEventListener("DOMContentLoaded", function () {
    
    "use strict";
    let cuerpoTabla = document.querySelector("#pacientes-tabla");
    let textbuscar = document.getElementById("buscar");
    textbuscar.onkeyup = function () {
    buscar();
    }

    function buscar() {
        let valorabuscar = document.getElementById('buscar').value.toLowerCase().trim();
        let tabla_tr = document.getElementsByTagName("tbody")[0].rows;
        for (let i = 0; i < tabla_tr.length; i++) {
            let tr = tabla_tr[i];
            let textotr = tr.innerText.toLowerCase();
            tr.className = (textotr.indexOf(valorabuscar) != -1) ? "mostrar" : "ocultar";
            // operador ternario
        }
    }

});