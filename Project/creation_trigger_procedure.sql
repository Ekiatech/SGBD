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

         IF p_id_velo NOT IN (SELECT id_velo from utilisations WHERE p_id_velo = id_velo AND date_fin IS NULL)
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
