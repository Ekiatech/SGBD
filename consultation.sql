/** CONSULTATION INFORMATIONS VELOS **/

SELECT * FROM velos;

/** CONSULTATION INFORMATIONS STATIONS **/

SELECT * FROM stations;

/** CONSULTATION INFORMATIONS ADHERENTS **/

SELECT * FROM adherents, personnes where adherents.id_personne = personnes.id_personne ORDER BY personnes.id_personne asc;


/** LISTE VELOS PAR STATION **/

SELECT velos.* FROM velos INNER JOIN stations on velos.id_station = stations.id_station ORDER BY id_station;

/** LISTE VELOS EN COURS D'UTILISATION **/
SELECT id_utilisation, id_velo, id_adherent, date_debut, date_fin, kilometrage_debut, kilometrage_fin FROM velos INNER JOIN utilisations USING(id_velo) WHERE date_fin IS NULL ORDER BY id_utilisation;


INSERT INTO utilisations(id_velo, id_adherent, date_debut, kilometrage_debut, kilometrage_fin)
VALUES
(2, 1, now(), 10, 40);



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

/* Nombre de km fait */
select SUM(kilometrage_fin - kilometrage_debut) from utilisations WHERE id_adherent = ;



/** Pour ajouter utilisateur **/

/** Pour ajouter station **/

INSERT INTO stations (adresse, commune, nombre_bornes)
VALUES
('Rue Marie', 'Talence', 5);

/** Pour ajouter **/


/**  VUE **/

create view Station1 as ( SELECT * FROM etre_eloigne where id_station = );

create view Station2 as ( SELECT * FROM etre_eloigne where id_stationbis = ); 

/** Ordonner par date **/
SELECT id_velo, kilometrage_debut, kilometrage_fin, date_debut from utilisations where id_velo = id_velo ORDER BY id_velo, date_debut;

SELECT (kilometrage_fin - kilometrage_debut) from utilisations WHERE id_velo = 2 AND kilometrage_debut = 10;


/** Avoir la liste des utilisations par mois, semaine et etc... **/
 CREATE VIEW dates_utilisations SELECT *, weekofyear(date_debut) as week, month(date_debut) as month, year(date_debut) as year from utilisations ORDER BY date_debut;

/** Avoir le nombre de km effectués pour toutes les années (1 année = 1 ligne) **/
SELECT SUM(kilometrage_fin-kilometrage_debut) from date_utilisations GROUP BY year;


/** Affiche nomnbre de km parcourus pour chaque adherent en foncton de la semaine **/
SELECT SUM(kilometrage_fin-kilometrage_debut), id_adherent, week from date_utilisations GROUP BY week, id_adherent;


