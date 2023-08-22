
document
  .querySelector(".hero__timer-lock")
  .addEventListener("click", () => {
    // Fetch a random Pokémon card from the PokeAPI
    fetch("https://pokeapi.co/api/v2/pokemon/" + getRandomPokemonID())
      .then((res) => res.json())
      .then((data) => {
        // Extract relevant data from the PokeAPI response
        const cardData = {
          cardName: data.name, // You can adjust this based on how you want to use the data
          cardAttributes: data.types.map((type) => type.type.name).join(", "), // Concatenate types if there are multiple
          rarity: "Unknown", // You can customize this
        };

        // Display the random Pokémon card in the cardContainer div
        const cardContainer = document.getElementById("cardContainer");
        cardContainer.innerHTML = `
                <h2>Random Pokémon Card:</h2>
                <p>Name: ${cardData.cardName}</p>
                <p>Attributes: ${cardData.cardAttributes}</p>
                <p>Rarity: ${cardData.rarity}</p>
            `;

        // Send the card data to the server for storage
        fetch("storeUserPokemon.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(cardData),
        })
          .then((response) => response.json())
          .then((responseData) => {
            console.log(responseData.status); // Check the server response status
            console.log(responseData.message); // Display any server response message
          })
          .catch((error) => console.error("Error:", error));
      })
      .catch((error) => console.error("Error:", error));
  });

// Function to get a random Pokémon ID (adjust as needed)
function getRandomPokemonID() {
  return Math.floor(Math.random() * 151) + 1; // Assuming you want IDs for the first 151 Pokémon
}
// ...
