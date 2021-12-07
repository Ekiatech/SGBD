/*====================== AJUSTEMENT DE LA BASE DE DONNEE ======================*/

/** SUPPRESSION FOREIGN KEY **/

ALTER TABLE velos DROP FOREIGN KEY fk_velos_id_station;
ALTER TABLE adherents DROP FOREIGN KEY fk_adherent_personnes;
ALTER TABLE utilisations DROP FOREIGN KEY fk_utilisations_id_velo;
ALTER TABLE utilisations DROP FOREIGN KEY fk_utilisations_id_adherent;
ALTER TABLE utilisations DROP FOREIGN KEY fk_utilisations_id_station_debut;
ALTER TABLE utilisations DROP FOREIGN KEY fk_utilisations_id_station_fin;
ALTER TABLE etre_eloigne DROP FOREIGN KEY fk_etre_eloigne_station;
ALTER TABLE etre_eloigne DROP FOREIGN KEY fk_etre_eloigne_stationbis;

/** SUPPRESSION TABLES **/
TRUNCATE TABLE velos;
TRUNCATE TABLE stations;
TRUNCATE TABLE utilisations;
TRUNCATE TABLE adherents;
TRUNCATE TABLE personnes;
TRUNCATE TABLE etre_eloigne;

/** SUPPRESSION DE LA BASE DE DONNEE PROJECT_SQL SI EXISTANTE **/

DROP DATABASE IF EXISTS PROJECT_SQL;
