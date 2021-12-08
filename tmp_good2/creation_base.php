 <html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
   <h2>Cr&eacute;ation de la base</h2>
     <?php
    include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */
    /* On crée une table avec des données: */
    $creation="/** CREATION TABLE VELOS **/

CREATE TABLE velos (

id_velo INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,

reference VARCHAR(100) NOT NULL,

marque VARCHAR(100) NOT NULL,

date_mise_en_service DATE NOT NULL,

kilometrage FLOAT NOT NULL DEFAULT 0,

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

id_station_debut INT,

id_station_fin INT,

date_debut DATETIME NOT NULL,

date_fin DATETIME,

kilometrage_parcouru INT NOT NULL,

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
      REFERENCES stations(id_station)
      ON DELETE SET NULL;

ALTER TABLE velos
      ADD CONSTRAINT check_baterry_sup
      CHECK (batterie <= 100);

ALTER TABLE velos
      ADD CONSTRAINT check_baterry_inf
      CHECK (batterie >= 0);

ALTER TABLE velos
      ADD CONSTRAINT check_etat_velos
      CHECK (etat in ('Excellent', 'Bon', 'Moyen', 'Mauvais', 'Inutilisable'));

ALTER TABLE etre_eloigne
      ADD CONSTRAINT check_station_stationbis
      CHECK (id_station < id_stationbis);
      
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
      REFERENCES adherents(id_adherent)
      ON DELETE SET NULL;

ALTER TABLE etre_eloigne
      ADD CONSTRAINT fk_etre_eloigne_station
      FOREIGN KEY (id_station)
      REFERENCES stations(id_station);

ALTER TABLE etre_eloigne
      ADD CONSTRAINT fk_etre_eloigne_stationbis
      FOREIGN KEY (id_stationbis)
      REFERENCES stations(id_station);

ALTER TABLE utilisations
      ADD CONSTRAINT fk_utilisations_id_station_debut
      FOREIGN KEY (id_station_debut)
      REFERENCES stations(id_station)
      ON DELETE SET NULL;

ALTER TABLE utilisations
      ADD CONSTRAINT fk_utilisations_id_station_fin
      FOREIGN KEY (id_station_fin)
      REFERENCES stations(id_station)
      ON DELETE SET NULL;
";  
    /* Execution d'une requete multiple */
    $connection->multi_query($creation);
    
    echo " base cr&eacute;e\n <br>";

	
	$insertion="SET FOREIGN_KEY_CHECKS=0;
TRUNCATE TABLE velos;
TRUNCATE TABLE stations;
TRUNCATE TABLE utilisations;
TRUNCATE TABLE adherents;
TRUNCATE TABLE personnes;
TRUNCATE TABLE etre_eloigne;
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

INSERT INTO adherents (id_personne, date_debut_adhesion, date_fin_adhesion)
VALUES

(1, SUBDATE(now(), 150), ADDDATE(SUBDATE(now(), 150), 60)),
(3, SUBDATE(now(), 150), ADDDATE(SUBDATE(now(), 150), 60)),
(4, SUBDATE(now(), 150), ADDDATE(SUBDATE(now(), 150), 60)),
(5, SUBDATE(now(), 10), ADDDATE(SUBDATE(now(), 10), 60)),
(6, SUBDATE(now(), 150), ADDDATE(SUBDATE(now(), 150), 60));

UPDATE adherents SET date_fin_adhesion = SUBDATE(now(), 300) WHERE id_personne = 1;

INSERT INTO adherents (id_personne, date_debut_adhesion)
VALUES

(1, SUBDATE(now(),30));


INSERT INTO utilisations(id_velo, id_adherent, date_debut, date_fin, kilometrage_parcouru, id_station_debut, id_station_fin)
VALUES

(2, 1, SUBDATE(now(), 10), ADDDATE(SUBDATE(now(), 10), INTERVAL 40 MINUTE), 40, 1, 3),
(2, 2, SUBDATE(now(), 8), ADDDATE(SUBDATE(now(), 8), INTERVAL 40 MINUTE), 20, 3, 4),
(2, 1, SUBDATE(now(), 7), ADDDATE(SUBDATE(now(), 7), INTERVAL 40 MINUTE), 25, 4, 3),
(2, 1, SUBDATE(now(), 6), ADDDATE(SUBDATE(now(), 6), INTERVAL 40 MINUTE), 85, 3, 2),
(2, 1, SUBDATE(now(), 5), ADDDATE(SUBDATE(now(), 5), INTERVAL 40 MINUTE), 12, 2, 1),

(3, 2, SUBDATE(now(), 8), ADDDATE(SUBDATE(now(), 8), INTERVAL 40 MINUTE), 20, 6, 4),
(3, 4, SUBDATE(now(), 3), ADDDATE(SUBDATE(now(), 3), INTERVAL 40 MINUTE), 5, 4, 3),

(4, 1, SUBDATE(now(), 8), ADDDATE(SUBDATE(now(), 8), INTERVAL 40 MINUTE), 6, 1, 5),
(4, 5, SUBDATE(now(), 2), ADDDATE(SUBDATE(now(), 2), INTERVAL 40 MINUTE), 3, 5, 1),

(5, 1, SUBDATE(now(), 7), ADDDATE(SUBDATE(now(), 7), INTERVAL 40 MINUTE), 12, 3, 1);

INSERT INTO etre_eloigne (id_station, id_stationbis, distance)
VALUES

(1, 2, 7),
(1, 3, 2),
(1, 4, 3),
(1, 5, 15),
(1, 6, 27),
(1, 7, 32),
(2, 3, 4),
(2, 4, 6),
(2, 5, 10),
(2, 6, 15),
(2, 7, 24),
(3, 4, 3),
(3, 5, 15),
(3, 6, 18),
(3, 7, 26),
(4, 5, 12),
(4, 6, 24),
(4, 7, 26),
(5, 6, 2),
(5, 7, 8),
(6, 7, 13);
";
	$connection->multi_query($insertion);
	echo "donnees ajoutees <br>";


     ?>


   </table>
 </body>
</html>
