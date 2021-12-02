/*====================== AJUSTEMENT DE LA BASE DE DONNEE ======================*/

/** SUPPRESSION DE LA BASE DE DONNEE PROJECT_SQL SI EXISTANTE **/

DROP DATABASE IF EXISTS PROJECT_SQL;

/** CREATION DE LA BASE DE DONNEE PROJECT_SQL **/

CREATE DATABASE PROJECT_SQL;

/** POUR SE PLACER DANS LA BASE DE DONNEE PROJECT_SQL**/

USE PROJECT_SQL;


/*====================== CREATION DES DIVERSES TABLES ======================*/

/* TABLES :
          VELOS
          STATIONS
          ADHERENTS
          PERSONNES
          UTILISER
*/

/** CREATION TABLE VELOS **/

CREATE TABLE velos (

id_velo INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,

reference VARCHAR(100) NOT NULL,

marque VARCHAR(100) NOT NULL,

date_mise_en_service DATE NOT NULL,

kilometrage INTEGER NOT NULL DEFAULT 0,

etat VARCHAR(100) NOT NULL DEFAULT 'Bon',

batterie INTEGER NOT NULL DEFAULT 100

);


/** CREATION TABLE STATIONS **/

CREATE TABLE stations (

id_station INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,

adresse VARCHAR(100) NOT NULL,

commune VARCHAR(100) NOT NULL,

nombre_bornes INTEGER NOT NULL

);

/** CREATION TABLE ADHERENTSS **/

CREATE TABLE adherents (

id_adherent INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,

id_personne INTEGER NOT NULL,

date_debut_adhesion DATE NOT NULL,

date_fin_adhesion DATE

);

/** CREATION TABLE PERSONNES **/

CREATE TABLE personnes (

id_personne INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,

nom VARCHAR(100) NOT NULL,

prenom VARCHAR(100) NOT NULL,

adresse VARCHAR(100) NOT NULL,

commune VARCHAR(100) NOT NULL

);

/** CREATION TABLE UTILISER **/

CREATE TABLE utilisations (

id_utilisation INT NOT NULL AUTO_INCREMENT,

id_velo INT NOT NULL,

id_adherent INT,

date_debut DATE NOT NULL,

date_fin DATE,

kilometrage_debut INT NOT NULL,

CONSTRAINT PRIMARY KEY (id_utilisation)

);


/** CREATION TABLE ETRE_ELOIGNE **/


CREATE TABLE etre_eloigne (

id_station INT NOT NULL,

id_stationbis INT NOT NULL,

distance INT NOT NULL,

CONSTRAINT PRIMARY KEY (id_station, id_stationbis)

);


/** AJOUTE LES FOREIGN KEY **/

ALTER TABLE velos
      ADD id_station INT DEFAULT 1;

ALTER TABLE velos
      ADD CONSTRAINT fk_velos_id_station
      FOREIGN KEY (id_station)
      REFERENCES stations(id_station);
      /*ON DELETE SET NULL;*/

ALTER TABLE adherents
      ADD CONSTRAINT fk_adherent_personnes
      FOREIGN KEY (id_personne)
      REFERENCES personnes(id_personne);

      
ALTER TABLE utilisations
      ADD CONSTRAINT fk_utilisations_id_velo
      FOREIGN KEY (id_velo)
      REFERENCES velos(id_velo);  

ALTER TABLE utilisations
      ADD CONSTRAINT fk_utilisations_id_adherent
      FOREIGN KEY (id_adherent)
      REFERENCES adherents(id_adherent);

ALTER TABLE etre_eloigne
      ADD CONSTRAINT fk_etre_eloigne_station
      FOREIGN KEY (id_station)
      REFERENCES stations(id_station);

ALTER TABLE etre_eloigne
      ADD CONSTRAINT fk_etre_eloigne_stationbis
      FOREIGN KEY (id_stationbis)
      REFERENCES stations(id_station);
