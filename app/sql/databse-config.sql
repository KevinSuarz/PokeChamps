CREATE DATABSE pokechamps;

CREATE TABLE users (
  user_id INT NOT NULL AUTO_INCREMENT,
  user_name VARCHAR(255) NOT NULL,
  user_lastName VARCHAR(255),
  user_email VARCHAR(255),
  user_userName VARCHAR(255) NOT NULL,
  user_password VARCHAR(100) NOT NULL,
  PRIMARY KEY (user_id)
);

