function getRandomPokemonID() {
  return Math.floor(Math.random() * 151) + 1;
};

  (async () => {
    try {
      const pokeId = getRandomPokemonID();
      const cardID = {
        cardID: pokeId
      };

      const init = {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
        },
        body: JSON.stringify(cardID),
      };

      const response = await fetch("../app/php/openCards.php", init);

      if (response.ok) {
        var responseData = await response.json();

        fetch("https://pokeapi.co/api/v2/pokemon/" + pokeId)
          .then((res) => res.json())
          .then((data) => {
            const cardData = {
              cardName: data.name,
              cardAttributes: data.types
                .map((type) => type.type.name)
                .join(", "),
              cardSprite: data.sprites.other.home.front_default,
              cardID: pokeId,
            };

            const cardContainer = document.querySelector(".cardContainer");
            cardContainer.innerHTML = `
              <h2>Pokémon Card:</h2>
              <p>Name: ${cardData.cardName}</p>
              <p>Attributes: ${cardData.cardAttributes}</p>
              <p>id: ${cardData.cardID}</p>
              <img src="${cardData.cardSprite}"></img>
            `;
            console.log(responseData.html);
          });
        
      } else {
        throw new Error(response.statusText);
      }
    } catch (err) {
      console.error(err.message);
    }
  })();
