<div id="message"></div>
  <script>
    fetch('https://rickandmortyapi.com/api/character')
      .then(response => response.json())
      .then(data => {
        data.results.forEach(personaje => mostrarPersonaje(personaje));
      });

      function mostrarPersonaje(personaje){
        const img = document.createElement("img");
        img.setAttribute("src", personaje.image);
        const name = document.createElement("h1");
        const container = document.createElement("div");
        container.setAttribute("class", "container");
        name.innerHTML = personaje.name;
        container.appendChild(img)
        container.appendChild(name)
        // if (personaje.name.includes('u')){
            document.getElementById("message").appendChild(container);
        // };
      };
  </script>