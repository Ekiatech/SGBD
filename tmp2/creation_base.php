 <html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
   <h2>Exemple de requ&ecirc;te php MySQL</h2>
     <?php
    include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */
    /* On crée une table avec des données: */
    $creation="
       
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
      REFERENCES stations(id_station);";  
    /* Execution d'une requete multiple */
    $connection->multi_query($creation);

	$insertion="
	SET FOREIGN_KEY_CHECKS=0;
TRUNCATE TABLE velos;
TRUNCATE TABLE stations;
TRUNCATE TABLE utilisations;
TRUNCATE TABLE adherents;
TRUNCATE TABLE personnes;
SET FOREIGN_KEY_CHECKS=1;

INSERT INTO personnes (nom, prenom, adresse, commune)

VALUES

('ALDERSON', 'Elliot', 'Rue Marie', 'Talence'),
('WELLICK', 'Tyrell', 'Prison', 'Gradignan'),
('MOSS', 'Angela', 'Victoire', 'Bordeaux'),
('DUPUIS', 'Martin', 'Place Lumière', 'Lyon'),
('GAUTIER', 'Manon', 'Rue Couturier', 'Blondel-les-Bains'),
('PELTIER', 'Laure', 'Rue Maurice Brunet', 'Leger');



INSERT INTO stations (adresse, commune, nombre_bornes)
VALUES

('Rue Marie', 'Talence', 5),
('Prison', 'Gradignan', 20),
('ENSEIRB', 'Talence', 42),
('Victoire', 'Bordeaux', 15),
('Rue du stade', 'Saint Morillon', 1),
('Copona', 'Chassieu', 10),
('Place de la mairie', 'Saint Eugène', 2);


INSERT INTO velos (reference, marque, date_mise_en_service, id_station)
VALUES

('AD-95', 'BIKECI', SUBDATE(now(), 2), 1),
('BG-230', 'Artengo', now(), 1),
('BG-240', 'Artengo', now(), 3),
('BG-240', 'Artengo', now(), 5),
('BG-250', 'Artengo', now(), 1),
('AZ-404', 'AddBike', ADDDATE(now(), 4), NULL);

UPDATE velos SET batterie = 75 WHERE id_velo = 3; 
UPDATE velos SET batterie = 40 WHERE id_velo = 4;
UPDATE velos SET batterie = 1 WHERE reference = 'AD-95';
UPDATE velos SET etat = 'Mauvais' WHERE reference = 'AD-95';

INSERT INTO adherents (id_personne, date_debut_adhesion)
VALUES

(1, SUBDATE(now(), 750)),
(3, SUBDATE(now(), 150)),
(4, SUBDATE(now(), 150)),
(5, SUBDATE(now(), 10)),
(6, SUBDATE(now(), 150));

UPDATE adherents SET date_fin_adhesion = SUBDATE(now(), 300) WHERE id_personne = 1;

INSERT INTO adherents (id_personne, date_debut_adhesion)
VALUES

(1, SUBDATE(now(),30));


INSERT INTO utilisations(id_velo, id_adherent, date_debut, kilometrage_debut)
VALUES

/*(1, 1, SUBDATE(now(), 2), 0);*//*PAS POSSIBLE PLUS ADHERENT*/
(2, 1, SUBDATE(now(), 10), 10),
(2, 2, SUBDATE(now(), 8), 40),
(3, 2, SUBDATE(now(), 8), 5),
(4, 1, SUBDATE(now(), 8), 2),
(5, 1, SUBDATE(now(), 7), 0),
(2, 1, SUBDATE(now(), 7), 60),
(2, 1, SUBDATE(now(), 6), 65),
(2, 1, SUBDATE(now(), 5), 150),
(3, 4, SUBDATE(now(), 3), 25),
(4, 5, SUBDATE(now(), 2), 8);
	";
	$connection->multi_query($insertion);
	echo "donnees ajoutees";
	$connection->close();
     ?>


   </table>
 </body>
</html>
