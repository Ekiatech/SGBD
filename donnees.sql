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
