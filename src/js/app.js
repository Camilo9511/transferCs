document.addEventListener("DOMContentLoaded", function () {
    // ACTIVAR ENLACE ACTUAL
    const enlaces = document.querySelectorAll(".navegacion__enlace");
    const paginaActual = window.location.pathname.split("/").pop().toLowerCase();

    enlaces.forEach(enlace => {
        let href = enlace.getAttribute("href");
        if (!href || href === "#") return;
        href = href.toLowerCase().split("/").pop();
        if (href === paginaActual) {
            enlace.classList.add("activo");
        }
    });

    // IMAGEN GRANDE AL CLIC
    const imagenes = document.querySelectorAll(".imagenes");
    const overlay = document.createElement("div");
    overlay.classList.add("overlay");
    document.body.appendChild(overlay);

    const imagenGrande = document.createElement("img");
    imagenGrande.classList.add("imagen-grande");
    overlay.appendChild(imagenGrande);

    imagenes.forEach(img => {
        img.addEventListener("click", () => {
            imagenGrande.src = img.src;
            overlay.classList.add("activo");
        });
    });

    overlay.addEventListener("click", () => {
        overlay.classList.remove("activo");
    });

    // VALIDACIÓN DE FORMULARIO
    const formulario = document.querySelector(".formulario");
    const modal = document.getElementById("modal");
    const cerrarModal = document.getElementById("cerrar-modal");

    formulario.addEventListener("submit", function(event) {
        event.preventDefault();

        // Limpiar mensajes de error previos
        const mensajesError = document.querySelectorAll(".mensaje-error");
        mensajesError.forEach(msg => msg.remove());

        let codigo = document.getElementsByName("codigo")[0].value;
        let insumo = document.getElementsByName("insumo")[0].value;
        let cantidad = document.getElementsByName("cantidad")[0].value;
        let tipo = document.getElementsByName("tipo")[0].value;
        let obra_envia = document.getElementsByName("obra_envia")[0].value;
        let obra_recibe = document.getElementsByName("obra_recibe")[0].value;

        let errores = false;

        // Validaciones
        if (codigo.length !== 5) {
            mostrarError("codigo", "Por favor ingrese un código de 5 dígitos");
            errores = true;
        }

        if (insumo.trim() === "") {
            mostrarError("insumo", "Por favor ingresa el nombre del insumo");
            errores = true;
        }

        if (cantidad.trim() === "") {
            mostrarError("cantidad", "Por favor ingresa la cantidad del insumo");
            errores = true;
        }

        if (tipo.trim() === "") {
            mostrarError("tipo", "Por favor selecciona el tipo de traslado");
            errores = true;
        }

        if (obra_envia.trim() === "") {
            mostrarError("obra_envia", "Por favor ingresa la obra que envía");
            errores = true;
        }

        if (obra_recibe.trim() === "") {
            mostrarError("obra_recibe", "Por favor ingresa la obra que recibe");
            errores = true;
        }

        if (errores) return;

        modal.style.display = "flex";

        setTimeout(() => {
            formulario.submit();
        }, 1000);
    });

    // Mostrar mensaje de error debajo del campo
    function mostrarError(campo, mensaje) {
        const input = document.getElementsByName(campo)[0];

        if (!input.nextElementSibling || !input.nextElementSibling.classList.contains("mensaje-error")) {
            const mensajeError = document.createElement("div");
            mensajeError.classList.add("mensaje-error");
            mensajeError.textContent = mensaje;
            input.classList.add("input-error");
            input.parentNode.appendChild(mensajeError);
        }
    }

    // Eliminar errores automáticamente cuando el usuario escribe o cambia
    ["codigo", "insumo", "cantidad", "tipo", "obra_envia", "obra_recibe"].forEach(nombre => {
        const input = document.getElementsByName(nombre)[0];

        input.addEventListener("input", () => {
            const error = input.parentNode.querySelector(".mensaje-error");
            if (error) {
                error.remove();
                input.classList.remove("input-error");
            }
        });

        input.addEventListener("change", () => {
            const error = input.parentNode.querySelector(".mensaje-error");
            if (error) {
                error.remove();
                input.classList.remove("input-error");
            }
        });
    });

    cerrarModal.addEventListener("click", function () {
        modal.style.display = "none";
        formulario.reset();
    });
});
