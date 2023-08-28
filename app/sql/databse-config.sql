CREATE DATABASE pokechamps;

USE pokechamps;

CREATE TABLE users (
  user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_email VARCHAR(255),
  user_userName VARCHAR(255) NOT NULL,
  user_profilePic VARCHAR(20),
  user_password VARCHAR(100) NOT NULL
);

CREATE TABLE pokemons (
	pokemons_id INT PRIMARY KEY AUTO_INCREMENT,
  pokemons_cards TEXT,
  user_id INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(user_id)
);