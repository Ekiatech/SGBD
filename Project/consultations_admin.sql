/** =============== INFOS GENERALES =============== **/

/** NOMBRE ADHERENTS ACTUELS **/
SELECT * FROM adherents WHERE date_fin_adhesion < NOW();

/** INFORMATION SUR 1 ADHERENT **/
CALL info_adherent(p_id_adherent INT)


/** VELOS EN COURS D'UTILISATION **/
SELECT * FROM velos WHERE id_station IS NULL;

/** INFOS VELOS **/
CALL infos_velos(IN p_id_velo INT)
BEGIN
SELECT * FROM velos WHERE id_velo = p_id_velo;
END |
DELIMITER ;

/** VELOS EN MAUVAIS ETAT **/
SELECT * FROM velos WHERE etat IN ('Mauvais', 'Inutilisable');

/** =============== UTILISATIONS =============== **/

/** AJOUT VELO **/
CALL ajout_velo(p_reference VARCHAR(100), p_marque VARCHAR(100), p_kilometrage FLOAT, p_etat VARCHAR(100), p_batterie INT, p_id_station INT)



/** SUPPRESSION VELO **/
CALL suppression_velo(p_id_velo INT)


/** AJOUT STATION **/
/*DELIMITER |
CREATE PROCEDURE ajout_station(IN p_commune VARCHAR(100), IN p_adresse VARCHAR(100), IN p_nbr_bornes INT)
BEGIN
INSERT INTO stations (commune, adresse, nombre_bornes)
VALUES
(p_commune, p_adresse, p_nbr_bornes);
END |
DELIMITER ;
*/

/** SUPPRESSION ADHERENT **/
CALL suppression_adherent(p_id_adherent INT)

/** DEPLACER VELO **/
CALL deplacement_velo(p_id_velo INT, p_id_station INT)

/** =============== STATS GENERALES =============== **/

/** CLASSEMENT STATIONS LES + UTILISEES **/

/* STATION DEBUT */
SELECT id_station_debut, count(*) as nbr_utilisations FROM utilisations GROUP BY id_station_debut ORDER BY nbr_utilisations DESC;

/* STATION FIN */
SELECT id_station_fin, count(*) as nbr_utilisations FROM utilisations GROUP BY id_station_fin ORDER BY nbr_utilisations DESC;

/** CLASSEMENT VELOS LES + UTILISES **/
SELECT id_velo, count(*) as nbr_utilisations FROM utilisations GROUP BY id_velo ORDER BY nbr_utilisations DESC;

/** MOYENNE DISTANCE PARCOURU/SEMAINE **/
SELECT week, (km / nbr_adh) as nbr_km_moyenne_par_adherentFROM (SELECT count(*) as nbr_adh FROM adherents WHERE date_fin_adhesion >= DATE(NOW())) as a, (SELECT weekofyear(date_debut) as week, SUM(kilometrage_parcouru) as km FROM utilisations GROUP BY weekofyear(date_debut)) as b;


/** MOYENNE NOMBRE D'USAGER PAR VELO PAR JOUR  **/
/*DELIMITER |
CREATE PROCEDURE avg_nbr_usager_velo_jour(IN p_day VARCHAR(100))
BEGIN
SELECT dayname, (km / nbr_adh) as nbr_km_moyenne_par_adherent FROM (SELECT count(*) as nbr_adh FROM adherents WHERE date_fin_adhesion >= DATE(NOW())) as a, (SELECT DAYNAME(date_debut) as dayname, count(*) as km FROM utilisations WHERE DAYNAME(date_debut) = p_day GROUP BY DAYNAME(date_debut)) as b;
END |
DELIMITER ;
*/

/** RAPPORT RENOUVELLEMENT ABONNEMENT **/
Nombre pers renouvele / nombre personne

CREATE VIEW nbr_pers_renew as SELECT count(nbr_renew) as nbr_pers_renew FROM (SELECT nbr_renew FROM (SELECT count(*) as nbr_renew FROM adherents GROUP BY id_personne) as al WHERE nbr_renew > 1) as a;

SELECT nbr_pers_renew FROM nbr_pers_renew;

SELECT count(id_personne) as nbr_pers FROM personnes;

x
/** CLASSEMENT TRAJET PLUS EFFECTUE **/
SELECT id_station_debut, id_station_fin, count(*) as nbr_de_fois_effectue from utilisations GROUP BY id_station_debut, id_station_fin;


/** LISTE DES ADHERENTS AYANT EMPRUNTE AU MOINS 2 VELOS DIFFERENTS SUR UNE MEME JOURNEE **/
SELECT id_adherent FROM (SELECT id_adherent, count(*) as nbr FROM (SELECT id_adherent FROM utilisations WHERE DATE(date_debut) = DATE(NOW()) GROUP BY id_adherent, id_velo) as d GROUP BY id_adherent) as c WHERE nbr > 1;

