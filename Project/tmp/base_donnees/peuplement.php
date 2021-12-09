 <?php
    include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */
    /* On crée une table avec des données: */
    /* Execution d'une requete multiple */
    

	
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

('AD-95', 'BIKECI', SUBDATE(now(), 100), 1),
('BG-230', 'Artengo', SUBDATE(now(), 100), 1),
('BG-240', 'Artengo', SUBDATE(now(), 82), 3),
('BG-240', 'Artengo', SUBDATE(now(), 80), 5),
('BG-250', 'Artengo', SUBDATE(now(), 45), 1),
('AZ-404', 'AddBike', SUBDATE(now(), 32), 2);

UPDATE velos SET batterie = 75 WHERE id_velo = 3; 
UPDATE velos SET batterie = 40 WHERE id_velo = 4;
UPDATE velos SET batterie = 1 WHERE reference = 'AD-95';
UPDATE velos SET etat = 'Mauvais' WHERE reference = 'AD-95';
UPDATE velos SET etat = 'Mauvais' WHERE reference = 'BG-250';

INSERT INTO adherents (id_personne, date_debut_adhesion, date_fin_adhesion)
VALUES

(1, SUBDATE(now(), 150), SUBDATE(now(), 20)),
(2, SUBDATE(now(), 120), SUBDATE(now(), 15)),
(3, SUBDATE(now(), 100), ADDDATE(now(), 50)),
(4, SUBDATE(now(), 80), ADDDATE(now(), 8)),
(5, SUBDATE(now(), 65), ADDDATE(now(), 60)),
(6, SUBDATE(now(), 20), ADDDATE(now(), 214));

UPDATE adherents SET date_fin_adhesion = SUBDATE(now(), 100) WHERE id_personne = 1;

INSERT INTO adherents (id_personne, date_debut_adhesion, date_fin_adhesion)
VALUES

(1, SUBDATE(now(),30), ADDDATE(now(), 8));


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


CALL ajout_debut_utilisation_peuplement(2, 2, SUBDATE(now(), 30));
CALL ajout_fin_utilisation_peuplement(2, 3, ADDDATE(SUBDATE(now(), 30), INTERVAL 22 MINUTE));

CALL ajout_debut_utilisation_peuplement(3, 2, SUBDATE(now(), 30));
CALL ajout_fin_utilisation_peuplement(2, 6, ADDDATE(SUBDATE(now(), 30), INTERVAL 108 MINUTE));

CALL ajout_debut_utilisation_peuplement(2, 4, SUBDATE(now(), 10));
CALL ajout_fin_utilisation_peuplement(4, 3, ADDDATE(SUBDATE(now(), 10), INTERVAL 108 MINUTE));

CALL ajout_debut_utilisation_peuplement(3, 4, SUBDATE(now(), 8));
CALL ajout_fin_utilisation_peuplement(4, 4, ADDDATE(SUBDATE(now(), 8), INTERVAL 24 MINUTE));

CALL ajout_debut_utilisation_peuplement(4, 5, SUBDATE(now(), 8));
CALL ajout_fin_utilisation_peuplement(5, 3, ADDDATE(SUBDATE(now(), 8), INTERVAL 35 MINUTE));

CALL ajout_debut_utilisation_peuplement(2, 4, SUBDATE(now(), 8));
CALL ajout_fin_utilisation_peuplement(4, 4, ADDDATE(SUBDATE(now(), 8), INTERVAL 72 MINUTE));

CALL ajout_debut_utilisation_peuplement(5, 6, SUBDATE(now(), 7));
CALL ajout_fin_utilisation_peuplement(6, 2, ADDDATE(SUBDATE(now(), 7), INTERVAL 12 MINUTE));

CALL ajout_debut_utilisation_peuplement(2, 5, SUBDATE(now(), 7));
CALL ajout_fin_utilisation_peuplement(5, 3, ADDDATE(SUBDATE(now(), 7), INTERVAL 21 MINUTE));

CALL ajout_debut_utilisation_peuplement(2, 5, SUBDATE(now(), 6));
CALL ajout_fin_utilisation_peuplement(5, 2, ADDDATE(SUBDATE(now(), 6), INTERVAL 42 MINUTE));

CALL ajout_debut_utilisation_peuplement(3, 4, SUBDATE(now(), 3));
CALL ajout_fin_utilisation_peuplement(4, 3, ADDDATE(SUBDATE(now(), 3), INTERVAL 9 MINUTE));

CALL ajout_debut_utilisation_peuplement(4, 5, SUBDATE(now(), 2));
CALL ajout_fin_utilisation_peuplement(5, 1, ADDDATE(SUBDATE(now(), 2), INTERVAL 4 MINUTE));

CALL ajout_debut_utilisation_peuplement(4, 4, SUBDATE(now(), 2));
CALL ajout_fin_utilisation_peuplement(4, 4, ADDDATE(SUBDATE(now(), 2), INTERVAL 12 MINUTE));

CALL ajout_debut_utilisation_peuplement(4, 3, SUBDATE(now(), 2));
CALL ajout_fin_utilisation_peuplement(3, 1, ADDDATE(SUBDATE(now(), 2), INTERVAL 17 MINUTE));

CALL ajout_debut_utilisation_peuplement(2, 6, SUBDATE(now(), 2));
CALL ajout_fin_utilisation_peuplement(6, 4, ADDDATE(SUBDATE(now(), 2), INTERVAL 24 MINUTE));

CALL ajout_debut_utilisation_peuplement(2, 6, SUBDATE(now(), 2));
CALL ajout_fin_utilisation_peuplement(6, 2, ADDDATE(SUBDATE(now(), 2), INTERVAL 40 MINUTE));

CALL ajout_debut_utilisation_peuplement(2, 5, SUBDATE(now(), 1));
CALL ajout_fin_utilisation_peuplement(5, 1, ADDDATE(SUBDATE(now(), 1), INTERVAL 20 MINUTE));

CALL ajout_debut_utilisation_peuplement(4, 6, SUBDATE(now(), INTERVAL 40 MINUTE));
CALL ajout_fin_utilisation_peuplement(6, 5, ADDDATE(SUBDATE(now(), INTERVAL 40 MINUTE), INTERVAL 12 MINUTE));

CALL ajout_debut_utilisation_peuplement(5, 6, SUBDATE(now(), INTERVAL 7 MINUTE));
CALL ajout_fin_utilisation_peuplement(6, 1, SUBDATE(now(), INTERVAL 1 MINUTE));
";
	$connection->multi_query($insertion);

$connection->close();
?>
