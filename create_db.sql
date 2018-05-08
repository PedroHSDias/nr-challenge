
CREATE SCHEMA IF NOT EXISTS db_grafeno DEFAULT CHARACTER SET utf8 ;
USE db_grafeno ;

CREATE TABLE IF NOT EXISTS db_grafeno.tb_biddings (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(250) NOT NULL,
  origin VARCHAR(150) NOT NULL,
  object TEXT NULL,
  starting_date VARCHAR(75) NULL,
  over_date VARCHAR(45) NULL,
  original_link VARCHAR(500) NULL,
  publiched_in VARCHAR(45) NULL,
  last_update DATETIME NOT NULL,
  PRIMARY KEY (id)
)ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS db_grafeno.tb_apends (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(150) NULL,
  file_location VARCHAR(150) NULL,
  file_link VARCHAR(250) NULL,
  tb_biddings_fk INT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (tb_biddings_fk) REFERENCES tb_biddings(id)
)ENGINE = InnoDB;