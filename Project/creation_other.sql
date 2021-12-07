/** CREATION TRIGGER **/

/** VERIFICATIONS AVANT UTILISATION VELO **/
DELIMITER |
CREATE TRIGGER utilisations_velos_before
       BEFORE INSERT ON utilisations
       FOR EACH ROW
       BEGIN

       /** VERIFICATION ADHERENT **/
       SELECT date_fin_adhesion INTO @date_fin FROM adherents WHERE NEW.id_adherent = adherents.id_adherent;
       IF @date_fin IS NOT NULL AND @date_fin < now()
       THEN
       SIGNAL SQLSTATE '45000'
              SET MESSAGE_TEXT = 'Veuillez adherer';
       END IF;

       /** VERIFICATION VELO DISPONIBLE **/
       IF NEW.id_velo NOT IN (SELECT id_velo FROM stations INNER JOIN velos USING(id_station) WHERE id_station = NEW.id_station_debut)
       THEN
       SIGNAL SQLSTATE '45000'
              SET MESSAGE_TEXT = 'Velo non disponible';
       END IF;

       /** VERIFICATION ADHERENT NE PREND PAS PLUS DE 1 VELO **/
       IF NEW.id_adherent IN (SELECT id_adherent FROM utilisations WHERE date_fin IS NULL)
       THEN
       SIGNAL SQLSTATE '45000'
              SET MESSAGE_TEXT = 'Vous ne pouvez pas emprunter 2 velos simultanement';
       END IF;
       END |
DELIMITER ;

/** METTRE A NULL LA STATION DU VELO UTILISE **/
CREATE TRIGGER utilisations_velos_after
       AFTER INSERT ON utilisations
       FOR EACH ROW
       UPDATE velos SET id_station = NULL
       WHERE velos.id_velo = NEW.id_velo AND NEW.date_fin IS NULL;


/** VERIFICATION AVANT REPOSE VELO (places dispos à la station souhaitee) **/
DELIMITER |
CREATE TRIGGER utilisations_velos
       BEFORE UPDATE ON utilisations
       FOR EACH ROW
       BEGIN
         CALL nbr_places_dispos_station(NEW.id_station_fin, @p_value);
         IF @p_value = 0
         THEN
         SIGNAL SQLSTATE '45000'
	        SET MESSAGE_TEXT = 'Pas de places disponibles à la station';
         END IF;

         END |
DELIMITER ;
   

/** NOMBRE DE VELOS DISPONIBLES A L'ENSEMBLE DES STATIONS **/
CREATE VIEW nbr_velos_dispos_stations AS SELECT id_station, count(id_velo) as nbr_velos from stations LEFT OUTER JOIN velos USING(id_station) GROUP BY id_station;

/** NOMBRE DE PLACES LIBRES DISPONIBLES A L'ENSEMBLE DES STATIONS **/
CREATE VIEW nbr_places_dispos_stations AS SELECT id_station, nombre_bornes - nbr_velos from (SELECT id_station, nombre_bornes FROM stations) as nbr_bornes_stations INNER JOIN nbr_velos_dispos_stations USING(id_station);

/** NOMBRE DE VELOS DISPONIBLE A LA STATION p_id_station **/
DELIMITER |
CREATE PROCEDURE nbr_velos_dispos_station (IN p_id_station INT)
BEGIN
SELECT id_station, count(*) as nbr from velos WHERE id_station IS NOT NULL AND id_station = p_id_station GROUP BY id_station ;
END |
DELIMITER ;

/** NOMBRE DE PLACES LIBRES DISPONIBLES A LA STATION p_id_station **/
DELIMITER |
CREATE PROCEDURE nbr_places_dispos_station (IN p_id_station INT, OUT p_value INT)
BEGIN
        SELECT nombre_bornes - nbr_velos as nbr_places_dispos INTO p_value from (SELECT id_station, nombre_bornes from stations) as nbr_bornes_commune INNER JOIN nbr_velos_dispos_stations USING(id_station) WHERE id_station = p_id_station;
END |
DELIMITER ;

/** AJOUT DEBUT UTILISATION **/
DELIMITER |
CREATE PROCEDURE ajout_debut_utilisation(IN p_id_velo INT, IN p_id_adherent INT)
BEGIN
        SELECT id_station INTO @p_id_station FROM velos WHERE id_velo = p_id_velo;
        INSERT INTO utilisations(id_velo, id_adherent, id_station_debut, date_debut, kilometrage_parcouru)
        VALUES
        (p_id_velo, p_id_adherent, @p_id_station, now(), 0);
END |
DELIMITER ;


DELIMITER |
CREATE PROCEDURE ajout_fin_utilisation(IN p_id_velo INT, IN p_id_adherent INT, IN p_id_station_fin INT)
BEGIN

        IF p_id_adherent NOT IN (SELECT id_adherent FROM utilisations WHERE id_adherent = p_id_adherent AND date_fin IS NULL)
        THEN
         SIGNAL SQLSTATE '45000'
	        SET MESSAGE_TEXT = 'Vous navez pas emprunte de velo';
         END IF;

         IF p_id_velo NOT IN (SELECT id_velo FROM utilisations WHERE p_id_velo = id_velo AND date_fin IS NULL AND id_adherent = p_id_adherent) 
         THEN
           SIGNAL SQLSTATE '45000'
	        SET MESSAGE_TEXT = 'Veuillez reposer le velo emprunte et non un autre';
         END IF;

         
        SELECT id_utilisation INTO @id_utilisation FROM utilisations WHERE id_adherent = p_id_adherent AND date_fin IS NULL;
        
        SELECT id_station_debut INTO @p_id_station_debut FROM utilisations WHERE id_utilisation = @id_utilisation;

        /** MISE A JOUR TABLE UTILISATIONS id_station_fin **/
        UPDATE utilisations SET id_station_fin = p_id_station_fin WHERE id_utilisation = @id_utilisation;

        SET @dist = 0;
        IF p_id_station_fin < @p_id_station_debut
        THEN
                SELECT distance INTO @dist FROM etre_eloigne WHERE id_station = p_id_station_fin AND id_stationbis = @p_id_station_debut;
        ELSE
                SELECT distance INTO @dist FROM etre_eloigne WHERE id_stationbis = p_id_station_fin AND id_station = @p_id_station_debut;
        END IF;

        /** MISE A JOUR TABLE UTILISATIONS KM PARCOURU + date_fin **/
        UPDATE utilisations SET kilometrage_parcouru = @dist WHERE id_utilisation = @id_utilisation;
        UPDATE utilisations SET date_fin = now() WHERE id_utilisation = @id_utilisation;

        /** MISE A JOUR TABLE VELOS DE station VELO **/
        UPDATE velos set id_station = p_id_station_fin WHERE velos.id_velo = p_id_velo;

        /** MISE A JOUR TABLE VELOS kilometrage VELO **/
        UPDATE velos SET kilometrage = kilometrage + @dist WHERE velos.id_velo = p_id_velo;

        /** MISE A JOUR TABLE VELOS batterie VELO **/
        SELECT batterie INTO @batterie FROM velos WHERE p_id_velo = id_velo;

        IF (@batterie - 0.2 * @dist) > 0
         THEN
            UPDATE velos SET batterie = (batterie - 0.2 * @dist) WHERE velos.id_velo = p_id_velo;
        ELSE      
           UPDATE velos SET batterie = 0 WHERE velos.id_velo = p_id_velo;
         END IF;

END |
DELIMITER ;


/** HISTORIQUE ADHERENT **/
DELIMITER |
CREATE PROCEDURE history_utilisateur (IN p_id_adherent INT)
BEGIN
SELECT * FROM utilisations WHERE id_adherent = p_id_adherent;
END |
DELIMITER ;

/** AVOIR LA LISTE D'UTILISATION PAR SEMAINE/MOIS/ANNEE **/
CREATE VIEW dates_utilisations AS SELECT *, weekofyear(date_debut) as weeks, month(date_debut) as months, year(date_debut) as years from utilisations ORDER BY date_debut;

/** NOMBRE DE KM PARCOURUS PAR ADHERENTS SEMAINE/MOIS/ANNEE **/
DELIMITER |
CREATE PROCEDURE nbr_km_parcourus_semaine (IN p_id_adherent INT, IN yo VARCHAR(100))
BEGIN
SELECT SUM(kilometrage_parcouru), id_adherent, weeks from dates_utilisations WHERE id_adherent = p_id_adherent GROUP BY weeks, id_adherent;
END |
DELIMITER ;

DELIMITER |
CREATE PROCEDURE nbr_km_parcourus_mois (IN p_id_adherent INT)
BEGIN
SELECT SUM(kilometrage_parcouru), id_adherent, months from dates_utilisations WHERE id_adherent = p_id_adherent GROUP BY months, id_adherent;
END |
DELIMITER ;


DELIMITER |
CREATE PROCEDURE nbr_km_parcourus_annee (IN p_id_adherent INT)
BEGIN
SELECT SUM(kilometrage_parcouru), id_adherent, years from dates_utilisations WHERE id_adherent = p_id_adherent GROUP BY years, id_adherent;
END |
DELIMITER ;

/** NOMBRE HEURE PARCOURUES PAR ADHERENTS SEMAINE/MOIS/ANNEE **/
DELIMITER |
CREATE PROCEDURE nbr_h_adh_annee (IN p_id_adherent INT)
BEGIN
SELECT SUM(TIMESTAMPDIFF(MINUTE, date_debut, date_fin)), id_adherent, years from dates_utilisations WHERE id_adherent = p_id_adherent GROUP BY years, id_adherent;
END |
DELIMITER ;

/** Moyene des distances parcourues par les vélos sur une semaine **/

DELIMITER |
CREATE PROCEDURE nbr_km_parcourus_semaine_all (IN p_weeks INT)
BEGIN
SELECT SUM(kilometrage_parcouru) from dates_utilisations WHERE weeks = p_weeks GROUP BY weeks;
END |
DELIMITER ;

/** ============================================== 

                    UTILISATEUR

    ============================================== **/ 

/** =============== CONNEXION =============== **/

/** ADHERENT EXISTANT **/
DELIMITER |
CREATE PROCEDURE exist_adherent(IN p_id_adherent INT)
BEGIN
        SET @id = p_id_adherent;
        IF @id NOT IN (SELECT id_adherent FROM adherents)
        THEN
          SIGNAL SQLSTATE '45000'
                     SET MESSAGE_TEXT = 'Adherent inexistant';
       END IF;
END |
DELIMITER ;

/** AJOUT PERSONNE **/
DELIMITER |
CREATE PROCEDURE ajout_personne(IN p_nom VARCHAR(100), IN p_prenom VARCHAR(100), IN p_adresse VARCHAR(100), IN p_commune VARCHAR(100))
BEGIN
        INSERT INTO personnes (nom, prenom, adresse, commune)
        VALUES
        (p_nom, p_prenom, p_adresse, p_commune);
        SET @id_pers = 0;
        SELECT id_personne INTO @id_pers FROM personnes WHERE nom = p_nom AND prenom = p_prenom AND adresse = p_adresse;
        INSERT INTO adherents(id_personne, date_debut_adhesion, date_fin_adhesion)
        VALUES
        (@id_pers, now(), ADDDATE(now(), INTERVAL 6 MONTH));
END |
DELIMITER ;

/** =============== CONSULTATIONS =============== **/

/** INFOS VELOS STATION **/
DELIMITER |
CREATE PROCEDURE info_velo_station(IN p_id_velo INT)
BEGIN
SELECT * FROM velos INNER JOIN stations USING(id_station) WHERE id_velo = p_id_velo;
END |
DELIMITER ;

/** INFOS STATIONS COMMUNE X **/
DELIMITER |
CREATE PROCEDURE info_station_commune(IN p_commune VARCHAR(100))
BEGIN
SELECT * FROM stations WHERE commune = p_commune;
END |
DELIMITER ;

/** CLASSEMENT STATIONS D'UNE COMMUNE EN FONCTION NOMBRE DE VELOS **/
DELIMITER |
CREATE PROCEDURE rank_station_commune(IN p_commune VARCHAR(100))
BEGIN
SELECT * FROM nbr_velos_dispos_stations INNER JOIN stations USING(id_station) WHERE commune = p_commune ORDER BY nbr_velos DESC;
END |
DELIMITER ;

/** DISTANCE ENTRE DEUX STATIONS **/
DELIMITER |
CREATE PROCEDURE dist_between_2_stations(IN p_id_station INT, IN p_id_stationbis INT)
BEGIN
        SET @dist = 0;
        IF p_id_station < p_id_stationbis
        THEN
                SELECT distance FROM etre_eloigne WHERE id_station = p_id_station AND id_stationbis = p_id_stationbis;
        ELSE
                SELECT distance FROM etre_eloigne WHERE id_station = p_id_stationbis AND id_stationbis = p_id_station;
        END IF;
END |
DELIMITER ;


/** =============== STATISTIQUES =============== **/

/** CLASSEMENT STATION_DEBUT PLUS UTILISEE **/
DELIMITER |
CREATE PROCEDURE rank_start_station(IN p_id_adherent INT)
BEGIN
SELECT id_station_debut, count(*) as nbr_utilisations FROM utilisations WHERE id_adherent = p_id_adherent GROUP BY id_station_debut ORDER BY nbr_utilisations;
END |
DELIMITER ;

/** CLASSEMENT STATION_FIN PLUS UTILISEE **/
DELIMITER |
CREATE PROCEDURE rank_end_station(IN p_id_adherent INT)
BEGIN
SELECT id_station_debut, count(*) as nbr_utilisations FROM utilisations WHERE id_adherent = p_id_adherent GROUP BY id_station_debut ORDER BY nbr_utilisations;
END |
DELIMITER ;

/** DATE DE FIN D'ABONNEMENT **/
DELIMITER |
CREATE PROCEDURE date_end_adhesion(IN p_id_adherent INT)
BEGIN
SELECT date_fin_adhesion FROM adherents WHERE id_adherent = p_id_adherent;
END |
DELIMITER ;


/** DUREE ABONNEMENT **/
DELIMITER |
CREATE PROCEDURE duration_adhesion(IN p_id_adherent INT)
BEGIN
SELECT TIMESTAMPDIFF(DAY, date_debut_adhesion, date_fin_adhesion) FROM adherents WHERE id_adherent = p_id_adherent;
END |
DELIMITER ;

/** ============================================== 

                    ADMINISTRATEUR

    ============================================== **/ 

/** =============== INFOS GENERALES =============== **/


/** INFORMATION SUR 1 ADHERENT **/

DELIMITER |
CREATE PROCEDURE info_adherent(IN p_id_adherent INT)
BEGIN
SELECT * FROM adherents INNER JOIN personnes USING(id_personne) WHERE id_adherent = p_id_adherent;
END |
DELIMITER ;

/** INFOS VELOS **/
DELIMITER |
CREATE PROCEDURE infos_velos(IN p_id_velo INT)
BEGIN
SELECT * FROM velos WHERE id_velo = p_id_velo;
END |
DELIMITER ;


/** =============== UTILISATIONS =============== **/

/** AJOUT VELO **/
DELIMITER |
CREATE PROCEDURE ajout_velo(IN p_reference VARCHAR(100), IN p_marque VARCHAR(100), IN p_kilometrage FLOAT, IN p_etat VARCHAR(100), IN p_batterie INT, IN p_id_station INT)
BEGIN
CALL nbr_places_dispos_station(p_id_station, @p_value);
IF @p_value = 0
THEN
        SIGNAL SQLSTATE '45000'
               SET MESSAGE_TEXT = 'Pas de places disponibles cette station. Veuillez en renseigner une autre';
END IF;
INSERT INTO velos (reference, marque, date_mise_en_service, kilometrage, etat, batterie, id_station)
VALUES
(p_reference, p_marque, NOW(), p_kilometrage, p_etat, p_batterie, p_id_station);
END |
DELIMITER ;


/** SUPPRESSION VELO **/
DELIMITER |
CREATE PROCEDURE suppression_velo(IN p_id_velo INT)
BEGIN
IF p_id_velo NOT IN (SELECT id_velo FROM velos) 
THEN
        SIGNAL SQLSTATE '45000'
               SET MESSAGE_TEXT = 'id_velo invalide';
END IF;
SET FOREIGN_KEY_CHECKS=1;
DELETE FROM velos WHERE id_velo = p_id_velo;
SET FOREIGN_KEY_CHECKS=1;
END |
DELIMITER ;


/** SUPPRESSION ADHERENT **/
DELIMITER |
CREATE PROCEDURE suppression_adherent(IN p_id_adherent INT)
BEGIN
IF p_id_adherent NOT IN (SELECT id_adherent FROM adherents) 
THEN
        SIGNAL SQLSTATE '45000'
               SET MESSAGE_TEXT = 'id_adherent invalide';
END IF;


SELECT date_fin_adhesion INTO @date_fin FROM adherents WHERE id_adherent = p_id_adherent;
       IF @date_fin IS NOT NULL AND @date_fin < now()
       THEN
       SIGNAL SQLSTATE '45000'
              SET MESSAGE_TEXT = 'Personne deja plus adherente';
       END IF;
       
UPDATE adherents SET date_fin_adhesion = NOW() WHERE id_adherent = p_id_adherent;
END |
DELIMITER ;

/** DEPLACER VELO **/
DELIMITER |
CREATE PROCEDURE deplacement_velo(IN p_id_velo INT, IN p_id_station INT)
BEGIN
IF p_id_velo NOT IN (SELECT id_velo FROM velos) 
THEN
        SIGNAL SQLSTATE '45000'
               SET MESSAGE_TEXT = 'id_velo invalide';
END IF;

IF p_id_station NOT IN (SELECT id_station FROM stations)
THEN
        SIGNAL SQLSTATE '45000'
               SET MESSAGE_TEXT = 'id_station invalide';
END IF;

CALL nbr_places_dispos_station(p_id_station, @p_value);
IF @p_value = 0
THEN
        SIGNAL SQLSTATE '45000'
               SET MESSAGE_TEXT = 'Pas de places disponibles cette station. Veuillez en renseigner une autre';
END IF;

UPDATE velos SET id_station = p_id_station WHERE id_velo = p_id_velo;
END |
DELIMITER ;


/** REABONNEMENT **/
DELIMITER |
CREATE PROCEDURE se_reabonner(IN p_id_adherent INT)
BEGIN
       IF p_id_adherent NOT IN (SELECT id_adherent FROM adherents) 
THEN
        SIGNAL SQLSTATE '45000'
               SET MESSAGE_TEXT = 'Vous ne vous etes encore jamais abonne au service';
END IF;

       IF DATE(NOW()) < (SELECT date_fin_adhesion FROM adherents WHERE id_adherent = p_id_adherent)
THEN
        SIGNAL SQLSTATE '45000'
               SET MESSAGE_TEXT = 'Votre abonnement est encore en cours. Impossible de se reabonner';
END IF;

    SELECT id_personne INTO @id_personne FROM adherents WHERE id_adherent = p_id_adherent;
    INSERT INTO adherents (id_personne, date_debut_adhesion, date_fin_adhesion)
    VALUES
    (@id_personne, NOW(), ADDDATE(NOW(), INTERVAL 6 MONTH));
END |
DELIMITER ;


/** TAUX DE REABONNEMENT **/
DELIMITER |
CREATE PROCEDURE taux_reabonnement()
BEGIN
       SELECT nbr_pers_renew INTO @nbr_pers_renew FROM nbr_pers_renew;
       SELECT count(id_adherent) as nbr_pers INTO @nbr_pers FROM adherents WHERE date_fin_adhesion < NOW();
       SELECT @nbr_pers_renew / @nbr_pers;

END |
DELIMITER;

/** RECHARGER BATTERIE **/
DELIMITER |
CREATE PROCEDURE recharge_batterie(IN p_id_velo INT, IN p_batterie INT)
BEGIN
       IF p_id_velo NOT IN (SELECT id_velo FROM velos) 
THEN
        SIGNAL SQLSTATE '45000'
               SET MESSAGE_TEXT = 'id_velo invalide';
END IF;

    SET @batterie = 0;
    SELECT batterie INTO @batterie FROM velos WHERE id_velo = p_id_velo;
    IF @batterie + p_batterie > 100
    THEN
        UPDATE velos SET batterie = 100 WHERE id_velo = p_id_velo;
    ELSE
        UPDATE velos SET batterie = batterie + p_batterie WHERE id_velo = p_id_velo;
    END IF;
END |
DELIMITER ;

/** CLASSEMENT MEILLEUR VELO (BATTERIE) NON UTILISEE **/
DELIMITER |
CREATE PROCEDURE rank_velos_station(IN p_id_station INT)
BEGIN
       IF p_id_station NOT IN (SELECT id_station FROM stationss) 
THEN
        SIGNAL SQLSTATE '45000'
               SET MESSAGE_TEXT = 'id_station invalide';
END IF;

  SELECT * FROM velos WHERE id_station IS NOT NULL AND id_station = p_id_station ORDER BY batterie;
END |
DELIMITER ;

