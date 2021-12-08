/** =============== CONNEXION =============== **/

/** ADHERENT EXISTANT **/
CALL exist_adherent(p_id_adherent INT);

/** AJOUT PERSONNE **/
CALL ajout_personne(p_nom VARCHAR(100), p_prenom VARCHAR(100), p_adresse VARCHAR(100), p_commune VARCHAR(100));


/** =============== CONSULTATIONS =============== **/

/** LISTE DES STATIONS **/
SELECT * FROM stations;

/** INFOS VELOS STATION **/
SELECT * FROM stations INNER JOIN velos USING(id_station) ORDER BY id_station;

CALL info_velo_station(p_id_velo INT);

/** CLASSEMENT MEILLEUR VELO (BATTERIE) NON UTILISEE **/
SELECT * FROM velos WHERE id_station IS NOT NULL ORDER BY batterie;

/** LISTE COMMUNES **/
SELECT DISTINCT commune FROM stations ORDER BY commune;

/** INFOS STATIONS COMMUNE X **/
CALL info_station_commune(p_commune VARCHAR(100));

/** CLASSEMENT STATIONS D'UNE COMMUNE EN FONCTION NOMBRE DE VELOS **/
CALL info_station_commune(p_commune VARCHAR(100));

/** DISTANCE ENTRE DEUX STATIONS **/
CALL dist_between_2_stations(p_id_station INT, p_id_stationbis INT);


/** =============== STATISTIQUES =============== **/

/** CLASSEMENT STATION_DEBUT PLUS UTILISEE **/
CALL rank_start_station(p_id_adherent INT);

/** CLASSEMENT STATION_FIN PLUS UTILISEE **/
CALL rank_end_station(p_id_adherent INT);

/** DATE DE FIN D'ABONNEMENT **/
CALL date_end_adhesion(p_id_adherent INT);

/** DUREE ABONNEMENT **/
CALL duration_adhesion(p_id_adherent INT);

/** SE REABONNER **/
CALL se_reabonner(p_id_adherent INT);

/** CLASSEMET VELOS (BATTERIE) SUR UNE STATION **/
CALL rank_velos_station(p_id_station INT);


