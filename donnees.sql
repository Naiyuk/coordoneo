SET NAMES utf8;
CREATE DATABASE coordoneo CHARACTER SET 'utf8';
USE coordoneo;

CREATE TABLE co_client (
    c_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    c_name VARCHAR(50) NOT NULL,
    c_first_name VARCHAR(50) NOT NULL,
    c_address VARCHAR(90) NOT NULL,
    c_postal_code CHAR(5) NOT NULL,
    c_city VARCHAR(60) NOT NULL,
    c_country VARCHAR(30) NOT NULL,
    c_email VARCHAR(70) NOT NULL,
    PRIMARY KEY (c_id),
    UNIQUE INDEX ind_uni_c_email (c_email)
)
ENGINE=INNODB;

LOCK TABLES co_client WRITE;
INSERT INTO co_client(c_name, c_first_name, c_address, c_postal_code, c_city, c_country, c_email)
VALUES  ('Albert', 'Christophe', '10 allee des camelia', '54000', 'Nancy', 'France', 'alberchristophe@laposte.net'),
        ('Roche', 'Albert', '12 rue de la cascade', '33000', 'Bordeaux', 'France', 'rochealbert@yahoo.com'),
        ('Colin', 'Jean', '2 impasse des fleurs', '33000', 'Bordeaux', 'France', 'colin-jean@gmail.com'),
        ('Brunet', 'Claire', '9 bd Verdun', '15000', 'Aurillac', 'France', 'brunet-claire15@yahoo.com'),
        ('Gaillard', 'Bernard', '15 rue Pierre Marty', '54000', 'Nancy', 'France', 'gaillardbern@gmail.com'),
        ('Renard', 'John', '5 rue des roses', '33000', 'Bordeaux', 'France', 'ren-john@yahoo.com'),
        ('Leroux', 'Tom', '3 rue du General', '15000', 'Aurillac', 'France', 'lerouxtom@laposte.net'),
        ('Lemoine', 'Corinne', '5 impasse Achille', '06000', 'Nice', 'France', 'lemoine-corinne@gmail.com'),
        ('Jean', 'Eric', '33 rue du Ferry', '13000', 'Marseille', 'France', 'ericjean@yahoo.com'),
        ('Aubert', 'Patrick', '7 Impasse de Nevers', '13000', 'Marseille', 'France', 'aubert-patrick@gmail.com'),
        ('Roger', 'Alexandre', '22 allee des bouleaux', '06000', 'Nice', 'France', 'rogeralex@hotmail.fr'),
        ('Dumas', 'Arnaud', '8 allee Esperance', '06000', 'Nice', 'France', 'dumasarnaud06@yahoo.com'),
        ('Benoit', 'Polin', '40 avenue Beaucour', '31000', 'Toulouse', 'France', 'benoit-polin@hotmail.fr'),
        ('Andre', 'Luc', '23 rue du Monastere', '31000', 'Toulouse', 'France', 'andreluc31@yahoo.com'),
        ('Pierre', 'Lea', '20 rue de la fontaine', '75000', 'Paris', 'France', 'leapierre@gmail.com'),
        ('Benoit', 'Pauline', '1 allee fleurie', '75000', 'Paris', 'France', 'benoit-pauline@laposte.net'),
        ('Rolland', 'Gerard', '10 avenue Vivaldi', '35000', 'Rennes', 'France', 'rollandgege35@hotmail.fr'),
        ('Hubert', 'Lucas', '16 allee des Vergers', '35000', 'Rennes', 'France', 'hubert-lucas@gmail.com'),
        ('Perez', 'Edouard', '2 allee des Erables', '69000', 'Lyon', 'France', 'perez-edouard@yahoo.com'),
        ('Royer', 'Gabriel', '3 rue des forgerons', '69000', 'Lyon', 'France', 'royergab69@hotmail.fr');
UNLOCK TABLES;

CREATE TABLE co_user (
    u_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    u_username VARCHAR(40) NOT NULL,
    u_password VARCHAR(64) NOT NULL,
    u_email VARCHAR(80) NOT NULL,
    u_role VARCHAR(20) NOT NULL,
    PRIMARY KEY (u_id),
    UNIQUE INDEX ind_uni_u_email (u_email)
)
ENGINE=INNODB;

LOCK TABLES co_user WRITE;
INSERT INTO co_user(u_username, u_password, u_email, u_role)
VALUES ('Demo', '$2y$10$odA8S49PQCbELCiZOdr2U.FaXgOmK/.lnMfuHsXjZRwWgl8jFxQey', 'demo@yahoo.com', 'Administrateur');
UNLOCK TABLES;