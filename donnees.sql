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
('MOSS', 'Angela', 'Victoire', 'Bordeaux');


INSERT INTO stations (adresse, commune, nombre_bornes)
VALUES

('Rue Marie', 'Talence', 10),
('Prison', 'Gradignan', 20);


INSERT INTO velos (reference, marque, date_mise_en_service)
VALUES

('BG-230', 'Artengo', now()),
('BG-240', 'Artengo', now()),
('BG-240', 'Artengo', now()),
('BG-250', 'Artengo', now());

UPDATE velos SET batterie = 75 WHERE id_velo = 3; 
UPDATE velos SET batterie = 40 WHERE id_velo = 4; 

INSERT INTO adherents (id_personne, date_debut_adhesion)
VALUES

('2', now());

INSERT INTO utilisations(id_velo, id_adherent, date_debut, kilometrage_debut)
VALUES

(2, 1, now(), 10);
