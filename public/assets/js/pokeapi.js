const pokeList = document.querySelector('.pokeList');
const PokeCard = document.querySelector('.cards__pokemon');
function fetchPokeApi(id){
  fetch(`https://pokeapi.co/api/v2/pokemon/${id}`)
    .then((res) => res.json())
    .then((data) => {
      createCard(data, id);
    })
    .catch((e) => console.error(e));
}

function fetchPokemons(number){
  for(let i=1; i<=number ; i++){
    fetchPokeApi(i);
  }
}
function createCard(pokemon, id){
//CONTENEDOR DE LA TARJETA
  const card = document.createElement('div');
  card.classList.add('pokeList__card');
  card.classList.add('pokeCard');
//NUMERO DEL POKEMON
  const pokeNumber = document.createElement('h3');
  pokeNumber.classList.add("pokeCard__number");
  pokeNumber.textContent = `#${pokemon.id.toString().padStart(3,0)}`
//NOMBRE DEL POKEMON
  const name = document.createElement('h3');
  name.classList.add('pokeCard__name');
  name.textContent = pokemon.name;
//CONTAINER DEL SPRITE DE POKEMON
  const spriteContainer = document.createElement('div');
  spriteContainer.classList.add("pokeCard__spriteC");
//SPRITE DEL POKEMON
  const sprite = document.createElement('img');
  sprite.classList.add("pokeCard__sprite");
  sprite.src = pokemon.sprites.other.home.front_default;
  spriteContainer.appendChild(sprite);

  card.appendChild(pokeNumber);
  card.appendChild(name);
  card.appendChild(spriteContainer);
  card.appendChild(sprite);
  pokeList.appendChild(card);
//AGREGAR ATRIBUTO DATA PARA DIFERENCIAR CADA POKEMON Y ASI REALIZAR LA BUSQUEDA DE ESTE Y PODER MOSTRAR LA TARJETA
  card.setAttribute("poke-id",id);
}
fetchPokemons(151);


//MOSTRAR EL POKEMON COMO TARJETA CON TODAS SUS CUALIDADES
document.addEventListener("DOMContentLoaded", () => {
  const randomID = Math.floor(Math.random() * 151) + 1;
  fetchPokeCard(randomID);
});

pokeList.addEventListener("click", (e) => {
  const card = e.target.closest(".pokeList__card");
  if (card) {
    const pokeID = card.getAttribute("poke-id");
    fetchPokeCard(pokeID);
  }
});

// function fetchPokeCard(id) {
//   PokeCard.innerHTML = "";
//   fetch(`https://pokeapi.co/api/v2/pokemon/${id}`)
//     .then((res) => res.json())
//     .then((data) => {
//       createPokeCard(data);
//     })
//     .catch((e) => console.error(e));
// }

//ESTUDIAR ASYNCS Y AWAIT
async function fetchPokeCard(id) {
  PokeCard.innerHTML = "";
  try {
    const res = await fetch(`https://pokeapi.co/api/v2/pokemon/${id}`);
    const data = await res.json();
    createPokeCard(data);
  } catch (error) {
    console.error(error);
  }
}



function createPokeCard(pokemon) {
  //CONTENEDOR DE LA TARJETA
  const carta = document.createElement("div");
  carta.classList.add("Carta");

  //CARTA CABECERA
  const cartaCabecera = document.createElement("div");
  cartaCabecera.classList.add("carta__header");
  //NOMBRE DEL POKEMON
  const name = document.createElement("h4");
  name.classList.add("carta__name");
  name.textContent = pokemon.name;
  //EXPERIENCIA POKEMON
  const level = document.createElement("h5");
  level.classList.add("carta__level");
  level.textContent = "EXP "+pokemon.base_experience;
  //HP POKEMON
  const hp = document.createElement("h5");
  hp.classList.add("carta__hp");
  hp.textContent = "HP " + pokemon.stats[0].base_stat;
  //TIPO POKEMON
  const type = document.createElement("h5");
  type.classList.add("carta__type");
  type.textContent = pokemon.types[0].type.name;

  //CONTAINER DEL SPRITE DE POKEMON
  const spriteContainer = document.createElement("div");
  spriteContainer.classList.add("carta__spriteC");
  //SPRITE DEL POKEMON
  const sprite = document.createElement("img");
  sprite.classList.add("carta__sprite");
  sprite.src = pokemon.sprites.other["official-artwork"].front_default;
  //CONTAINER DE STATS
  const statsContainer = document.createElement("div");
  statsContainer.classList.add("carta__stats");
  //NUMERO DEL POKEMON
  const pokemonID = document.createElement("h6");
  pokemonID.classList.add("carta__id");
  pokemonID.textContent = `#${pokemon.id.toString().padStart(3, 0)}`;
  //ALTURA DEL POKEMON
  const height = document.createElement("h5");
  height.classList.add("carta__height");
  height.textContent = "height: " + pokemon.height;
  //PESO DEL POKEMON
  const weight = document.createElement("h5");
  weight.classList.add("carta__weight");
  weight.textContent = "weight: " + pokemon.weight;

  //ATAQUE
  const attack = document.createElement("h4");
  attack.classList.add("carta__attack");
  attack.textContent = pokemon.moves[0].move.name;
  //DESCRIPCION ATAQUE
  const attackDesc = document.createElement("h5");
  attackDesc.classList.add("carta__attackDesc");
  let description = pokemon.moves[0].move.url;
  fetch(description)
    .then((res) => res.json())
    .then((data) => {
      let pokeDesc = data.effect_entries[0].effect;
      attackDesc.textContent = pokeDesc;
    })
    .catch((e) => console.error(e));

  cartaCabecera.appendChild(name);
  cartaCabecera.appendChild(level);
  cartaCabecera.appendChild(hp);
  cartaCabecera.appendChild(type);
  carta.appendChild(cartaCabecera);
  spriteContainer.appendChild(sprite);
  statsContainer.appendChild(pokemonID);
  statsContainer.appendChild(height);
  statsContainer.appendChild(weight);
  spriteContainer.appendChild(statsContainer);
  carta.appendChild(spriteContainer);
  carta.appendChild(attack);
  carta.appendChild(attackDesc);
  PokeCard.appendChild(carta);
}