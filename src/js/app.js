console.log('🚀 app.js cargado');
console.log('formulario detectado al inicio?', document.querySelector('.formulario'));


document.addEventListener('DOMContentLoaded', () => {
  console.log('formulario existe?', document.querySelector('.formulario'));
});




document.addEventListener('DOMContentLoaded', () => {
  // ACTIVAR ENLACE ACTUAL
  const enlaces = document.querySelectorAll(".navegacion__enlace");
  const paginaActual = window.location.pathname.split("/").pop().toLowerCase();
  enlaces.forEach(enlace => {
    const href = enlace.getAttribute("href")?.split("/").pop().toLowerCase();
    if (href === paginaActual) enlace.classList.add("activo");
  });

  // IMAGEN GRANDE AL CLIC
 // ...existing code...
// IMAGEN GRANDE AL CLIC
document.querySelectorAll("img.imagenes").forEach(img => {
  img.addEventListener("click", () => {
    const lightbox = document.getElementById("lightbox");
    const imagenGrande = document.getElementById("imagen-grande");
    if (lightbox && imagenGrande) {
      imagenGrande.src = img.src;
      lightbox.style.display = "flex";
    }
  });
});

// Cerrar lightbox al hacer clic fuera de la imagen
const lightbox = document.getElementById("lightbox");
if (lightbox) {
  lightbox.addEventListener("click", (e) => {
    if (e.target === lightbox) {
      lightbox.style.display = "none";
      document.getElementById("imagen-grande").src = "";
    }
  });
}
// ...existing code...

  // VALIDACIÓN DE FORMULARIO
  const formulario = document.querySelector('.formulario');
  const modal = document.getElementById('modal');
  const cerrarModal = document.getElementById('cerrar-modal');

  if (formulario) {
    formulario.addEventListener('submit', event => {
      event.preventDefault();
      document.querySelectorAll('.mensaje-error').forEach(el => el.remove());

      const valores = ['codigo','insumo','cantidad','tipo','obra_envia','obra_recibe']
        .reduce((acc, name) => {
          acc[name] = document.getElementsByName(name)[0]?.value.trim() || '';
          return acc;
        }, {});
      const codigosValidos = ['404051','404052','404053','404054','404055','404056'];

      let errores = false;
      if (valores.codigo.length !== 5) { mostrarError('codigo','Código debe tener 5 dígitos'); errores = true; }
      if (!valores.insumo) { mostrarError('insumo','Ingresa nombre insumo'); errores = true; }
      if (!valores.cantidad) { mostrarError('cantidad','Ingresa cantidad'); errores = true; }
      if (!valores.tipo) { mostrarError('tipo','Selecciona tipo'); errores = true; }
      if (!valores.obra_envia) { mostrarError('obra_envia','Ingresa obra que envía'); errores = true; }
      if (!valores.obra_recibe) {
        mostrarError('obra_recibe','Ingresa obra que recibe'); errores = true;
      } else if (!codigosValidos.includes(valores.obra_recibe)) {
        alert(`La obra ${valores.obra_recibe} no existe: ` );
        errores = true;
      }

      if (errores) return;

      if (modal) {
        modal.style.display = 'flex';
        setTimeout(() => formulario.submit(), 1000);
      } else {
        formulario.submit();
      }
    });
  }

  // Cierre del modal
  if (cerrarModal && modal) {
    cerrarModal.addEventListener('click', () => {
      modal.style.display = 'none';
      formulario.reset();
      document.querySelectorAll('.mensaje-error').forEach(el => el.remove());
    });
  }

  // Limpieza de errores al modificar campos
  ['codigo','insumo','cantidad','tipo','obra_envia','obra_recibe'].forEach(name => {
    const input = document.getElementsByName(name)[0];
    if (!input) return;
    ['input','change'].forEach(evt =>
      input.addEventListener(evt, () => {
        const err = input.parentNode.querySelector('.mensaje-error');
        if (err) { err.remove(); }
      })
    );
  });

  // Función para mostrar errores
  function mostrarError(name, msg) {
    const input = document.getElementsByName(name)[0];
    if (!input) return;
    const div = document.createElement('div');
    div.classList.add('mensaje-error');
    div.textContent = msg;
    input.parentNode.appendChild(div);
  }
});
