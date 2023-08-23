
window.onload=function(){
  const pokeId = getRandomPokemonID();
  fetch("https://pokeapi.co/api/v2/pokemon/" + pokeId)
    .then((res) => res.json())
    .then((data) => {

      // Extracting relevant data from the PokeAPI response
      const cardData = {
        cardName: data.name,
        cardAttributes: data.types.map((type) => type.type.name).join(", "), // Concatenate types if there are multiple
        cardSprite: data.sprites.other.home.front_default,
        cardID: pokeId
      };

      // Display the random Pokémon card in the cardContainer div
      const cardContainer = document.querySelector(".cardContainer");
      cardContainer.innerHTML = `
                <h2>Pokémon Card:</h2>
                <p>Name: ${cardData.cardName}</p>
                <p>Attributes: ${cardData.cardAttributes}</p>
                <p>id: ${cardData.cardID}</p>
                <img src="${cardData.cardSprite}"></img>
            `;

      // Send the card data to the server for storage
      fetch("../app/php/openCards.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(pokeId),
      })
        .then((response) => response.json())
        .then((responseData) => {
          console.log(responseData.status); // Check the server response status
          console.log(responseData.message); // Display any server response message
        })
        .catch((error) => console.error("Error:", error));
    })
    .catch((error) => console.error("Error:", error));
};

function getRandomPokemonID() {
  return Math.floor(Math.random() * 151) + 1;
};
