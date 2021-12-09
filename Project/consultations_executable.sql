/** ============================================== 

                    UTILISATEUR

    ============================================== **/
    
/** =============== CONNEXION =============== **/

/** ADHERENT EXISTANT **/
CALL exist_adherent(3);

/** AJOUT PERSONNE **/
CALL ajout_personne('Valentin', 'Darmon', 'Rue Puysegur', 'Talence');

/** =============== CONSULTATIONS =============== **/

/** LISTE DES STATIONS **/
SELECT * FROM stations;

/** INFOS VELOS STATION **/
SELECT * FROM stations INNER JOIN velos USING(id_station) ORDER BY id_station;

CALL info_velo_station(2);

/** CLASSEMENT MEILLEUR VELO (BATTERIE) NON UTILISEE **/
SELECT * FROM velos WHERE id_station IS NOT NULL ORDER BY batterie;

/** LISTE COMMUNES **/
SELECT DISTINCT commune FROM stations ORDER BY commune;

/** INFOS STATIONS COMMUNE X **/
CALL info_station_commune('Talence');

/** CLASSEMENT STATIONS D'UNE COMMUNE EN FONCTION NOMBRE DE VELOS **/
CALL rank_station_commune('Talence');

/** DISTANCE ENTRE DEUX STATIONS **/
CALL dist_between_2_stations(1,3);


/** =============== STATISTIQUES =============== **/

/** CLASSEMENT STATION_DEBUT PLUS UTILISEE **/
CALL rank_start_station(5);

/** CLASSEMENT STATION_FIN PLUS UTILISEE **/
CALL rank_end_station(6);

/** DATE DE FIN D'ABONNEMENT **/
CALL date_end_adhesion(4);

/** DUREE ABONNEMENT **/
CALL duration_adhesion(5);

/** SE REABONNER **/
CALL se_reabonner(1);

/** CLASSEMENT VELOS (BATTERIE) SUR UNE STATION **/
CALL rank_velos_station(4);


/** ============================================== 

                    ADMINISTRATEUR

    ============================================== **/ 

/** =============== INFOS GENERALES =============== **/

/** NOMBRE ADHERENTS ACTUELS **/
SELECT count(id_adherent) as nbr_adherents FROM adherents WHERE date_fin_adhesion > NOW();

/** INFORMATION SUR 1 ADHERENT **/
CALL info_adherent(3);

/** VELOS EN COURS D'UTILISATION **/
SELECT * FROM velos WHERE id_station IS NULL;

/** INFOS VELOS **/
CALL infos_velos(2);

/** VELOS EN MAUVAIS ETAT **/
SELECT * FROM velos WHERE etat IN ('Mauvais', 'Inutilisable');

/** LISTE DES ADHERENTS AYANT EMPRUNTE AU MOINS 2 VELOS DIFFERENTS SUR UNE MEME JOURNEE **/
SELECT id_adherent FROM (SELECT id_adherent, count(*) as nbr FROM (SELECT id_adherent FROM utilisations WHERE DATE(date_debut) = DATE(NOW()) GROUP BY id_adherent, id_velo) as d GROUP BY id_adherent) as c WHERE nbr > 1;


/** =============== STATS GENERALES =============== **/

/** CLASSEMENT STATIONS LES + UTILISEES **/

/* STATION DEBUT */
SELECT id_station_debut, count(*) as nbr_utilisations FROM utilisations GROUP BY id_station_debut ORDER BY nbr_utilisations DESC;

/* STATION FIN */
SELECT id_station_fin, count(*) as nbr_utilisations FROM utilisations WHERE id_station_fin IS NOT NULL GROUP BY id_station_fin ORDER BY nbr_utilisations DESC;

/** CLASSEMENT VELOS LES + UTILISES **/
SELECT id_velo, count(*) as nbr_utilisations FROM utilisations GROUP BY id_velo ORDER BY nbr_utilisations DESC;

/** MOYENNE DISTANCE PARCOURU/SEMAINE **/
SELECT week, (km / nbr_adh) as nbr_km_moyenne_par_adherent FROM (SELECT count(*) as nbr_adh FROM adherents WHERE date_fin_adhesion >= DATE(NOW())) as a, (SELECT weekofyear(date_debut) as week, SUM(kilometrage_parcouru) as km FROM utilisations GROUP BY weekofyear(date_debut)) as b;

/** RAPPORT RENOUVELLEMENT ABONNEMENT **/
CALL taux_reabonnement();

/** CLASSEMENT TRAJET PLUS EFFECTUE **/
SELECT id_station_debut, id_station_fin, count(*) as nbr_de_fois_effectue FROM utilisations WHERE id_station_fin IS NOT NULL GROUP BY id_station_debut, id_station_fin ORDER BY nbr_de_fois_effectue DESC;

/** MOYENNE NOMBRE D'USAGER PAR VELO PAR JOUR  **/
CALL avg_nbr_usager_velo_jour(2);

/** MOYENNE D'UTILISATION VELOS PAR ADHERENT POUR UN JOUR DONNE **/
CALL avg_nbr_utilisations_jour('2021-12-07');
