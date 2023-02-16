DROP DATABASE IF EXISTS taskforce;

CREATE DATABASE taskforce
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE taskforce;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  email VARCHAR(255) NOT NULL UNIQUE,
  name VARCHAR(128) NOT NULL,
  password CHAR(64) NOT NULL,
  role TINYINT(1) DEFAULT (0),
  avatar_path CHAR(255) NULL,
  birthday TIMESTAMP NULL DEFAULT NULL,
  phone CHAR(11) NULL,
  telegram varchar(64) NULL,
  information TEXT,
  rating DECIMAL DEFAULT NULL,
  city_id INT
);

CREATE TABLE cities (
  id INT AUTO_INCREMENT PRIMARY KEY,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  name VARCHAR(255) NOT NULL UNIQUE,
  lat decimal(11,8) NOT NULL,
  lng decimal(11,8) NOT NULL
);

CREATE TABLE tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  status VARCHAR (64) NOT NULL,
  name VARCHAR(255) NOT NULL,
  description TEXT,
  deadline_at DATE NULL,
  budget INT NOT NULL,
  file_id INT,
  user_id INT,
  category_id INT,
  city_id INT,
  implementer_id INT
);

CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  icon VARCHAR(255) NOT NULL
);

CREATE TABLE user_categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  category_id INT
);

CREATE TABLE responses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  implementer_id INT,
  task_id INT,
  price INT NULL,
  comment VARCHAR(255) NULL
);

CREATE TABLE feedbacks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  task_id INT,
  rate TINYINT(5) NOT NULL,
  comment VARCHAR(255) NOT NULL
);

CREATE TABLE files (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL
);

ALTER TABLE users
   ADD FOREIGN KEY (city_id) REFERENCES cities (id);

ALTER TABLE tasks
   ADD FOREIGN KEY (user_id) REFERENCES users (id);
ALTER TABLE tasks
   ADD FOREIGN KEY (category_id) REFERENCES categories (id);
ALTER TABLE tasks
   ADD FOREIGN KEY (city_id) REFERENCES cities (id);
ALTER TABLE tasks
   ADD FOREIGN KEY (file_id) REFERENCES files (id);
ALTER TABLE tasks
   ADD FOREIGN KEY (implementer_id) REFERENCES users (id);

ALTER TABLE user_categories
   ADD FOREIGN KEY (user_id) REFERENCES users (id);
ALTER TABLE user_categories
   ADD FOREIGN KEY (category_id) REFERENCES categories (id);

ALTER TABLE responses
   ADD FOREIGN KEY (task_id) REFERENCES tasks (id);
 ALTER TABLE responses
   ADD FOREIGN KEY (implementer_id) REFERENCES users (id);

ALTER TABLE feedbacks
   ADD FOREIGN KEY (task_id) REFERENCES tasks (id);

CREATE INDEX ct_name ON cities(name);
CREATE INDEX t_name ON tasks(name);
CREATE INDEX c_name ON categories(name);
CREATE INDEX f_name ON files(name);
