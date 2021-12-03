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

/** Moyenne du nombre d'usagers par vélo par jour **/

select count(*), date_debut from utilisations GROUP BY date_debut;

/** Moyene des distances parcourues par les vélos sur une semaine **/

SELECT AVG(nombre_bornes) from stations;

/** Classement des stations par nombre de places disponibles par commune **/

SELECT commune, sum(nombre_bornes) as sum_nbr_bornes from stations GROUP BY commune ORDER BY sum_nbr_bornes DESC ;

/** classement des vélos les plus chargés par station **/

SELECT id_velo FROM velos ORDER BY batterie ASC;

/** Nombre de vélos disponibles par station **/

SELECT id_station, count(*) from velos WHERE id_station IS NOT NULL GROUP BY id_station;

/** Nombre de vélos disponibles par commune **/

SELECT count(*) as velos_disponibles, commune from velos INNER JOIN stations on velos.id_station = stations.id_station GROUP BY commune;


/** Historique utilisation pour UTILISATEUR **/

select * from utilisations WHERE id_adherent = ;


/** Pour ajouter utilisateur **/

/** Pour ajouter station **/

INSERT INTO stations (adresse, commune, nombre_bornes)
VALUES
('Rue Marie', 'Talence', 5);

/** Pour ajouter **/


/**  VUE **/

create view Station1 as ( SELECT * FROM etre_eloigne where id_station = );

create view Station2 as ( SELECT * FROM etre_eloigne where id_stationbis = ); 

