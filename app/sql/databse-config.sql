CREATE DATABSE pokechamps;

CREATE TABLE users (
  user_id INT NOT NULL AUTO_INCREMENT,
  user_email VARCHAR(255),
  user_userName VARCHAR(255) NOT NULL,
  user_profilePic VARCHAR(20),
  user_password VARCHAR(100) NOT NULL,
  PRIMARY KEY (user_id)
);

CREATE TABLE pokemons (
	pokemons_id INT AUTO_INCREMENT PRIMARY KEY,
  pokemons_apiID TEXT
);

CREATE TABLE user_pokemons (
  userPokemonsID INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  pokemons_id INT,
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  FOREIGN KEY (pokemons_id) REFERENCES pokemons(pokemons_id)
);