/** CONSULTATION INFORMATIONS VELOS **/

SELECT * FROM velos;

/** CONSULTATION INFORMATIONS STATIONS **/

SELECT * FROM stations;

/** CONSULTATION INFORMATIONS ADHERENTS **/

SELECT * FROM adherents, personnes where adherents.id_personne = personnes.id_personne ORDER BY personnes.id_personne asc;


/** LISTE VELOS PAR STATION **/

SELECT velos.* FROM velos INNER JOIN stations on velos.id_station = stations.id_station ORDER BY id_station;

/** LISTE VELOS EN COURS D'UTILISATION **/

SELECT velos.* FROM velos INNER JOIN stations on velos.id_station = stations.id_station ORDER BY id_station;

/** LISTE DES STATIONS DANS UNE COMMUNE DONNÉE **/

SELECT * FROM stations WHERE commune = '';

/** LISTE DES ADHERENTS QUI ONT EMPRUNTÉ AU MOINS 2 VELOS DIFFERENTS POUR UN JOUR DONNÉ **/

SELECT * from (SELECT utilisations.id_adherent, count(*) as nbr_utilisations from utilisations WHERE utilisations.date_debut = '2021-11-22' GROUP BY utilisations.id_adherent), adherents WHERE nbr_utilisations >= 2;
