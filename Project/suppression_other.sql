DROP trigger IF EXISTS utilisations_velos_before;
DROP trigger IF EXISTS utilisations_velos_after;
DROP trigger IF EXISTS utilisations_velos;

DROP VIEW IF EXISTS nbr_velos_dispos_stations;
DROP VIEW IF EXISTS nbr_places_dispos_stations;

DROP PROCEDURE IF EXISTS nbr_velos_dispos_station;
DROP PROCEDURE IF EXISTS nbr_places_dispos_station;
DROP PROCEDURE IF EXISTS ajout_debut_utilisation;
DROP PROCEDURE IF EXISTS ajout_fin_utilisation;
DROP PROCEDURE IF EXISTS history_utilisateur;

