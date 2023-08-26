const formularios_ajax = document.querySelectorAll(".login__form");

function enviar_formulario_ajax(e) {
  e.preventDefault();

  let enviar = confirm("quieres iniciar sesion?");

  if (enviar == true) {
    let data = new FormData(this);
    let method = this.getAttribute("method");
    let action = this.getAttribute("action");

    let encabezados = new Headers();

    let config = {
      method: method,
      headers: encabezados,
      mode: "cors",
      cache: "no-cache",
      body: data,
    };

    // fetch(action, config)
    //   .then((respuesta) => respuesta.text())
    //   .then((respuesta) => {
    //     let contenedor = document.querySelector(".form-rest");
    //     contenedor.innerHTML = respuesta;
    //   });

    fetch(action, config)
      .then((respuesta) => respuesta.json())
      .then((respuesta) => {
        let contenedor = document.querySelector(".form-rest");
        if (respuesta.success){
          window.location.href = '../public/index.php?view=homepage';
        } else if(respuesta.register) {
          window.location.href = "../public/index.php?view=login";
        } else {
          contenedor.innerHTML = respuesta.message;
        }
      });
  }
}

formularios_ajax.forEach((formularios) => {
  formularios.addEventListener("submit", enviar_formulario_ajax);
});
