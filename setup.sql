CREATE TABLE IF NOT EXISTS user (
  id INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(64) NOT NULL,
  password VARCHAR(256) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS recipe (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(64) NOT NULL,
  description VARCHAR(512) NOT NULL,
  ingredients VARCHAR(512) NOT NULL,
  visibility TINYINT(1) NOT NULL,
  user_id INT NOT NULL,
  image_folder_path VARCHAR(128) NOT NULL,
  extension VARCHAR(16) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES user(id)
);

CREATE TABLE IF NOT EXISTS saved_recipe (
  id INT NOT NULL AUTO_INCREMENT,
  user_id INT NOT NULL,
  recipe_id INT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES user(id),
  FOREIGN KEY (recipe_id) REFERENCES recipe(id)
);

CREATE TABLE IF NOT EXISTS ingredient (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(64) NOT NULL,
  amount VARCHAR(64) NOT NULL,
  recipe_id INT not NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (recipe_id) REFERENCES recipe(id)
);

