 <html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>

     <?php
     
     echo "<h2>Suppression de la base</h2>";
     
    include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */
    /* On crée une table avec des données: */

	$suppression_autres="DROP trigger IF EXISTS utilisations_velos_before;
DROP trigger IF EXISTS utilisations_velos_after;
DROP trigger IF EXISTS utilisations_velos;

DROP VIEW IF EXISTS nbr_velos_dispos_stations;
DROP VIEW IF EXISTS nbr_places_dispos_stations;
DROP VIEW IF EXISTS dates_utilisations;

DROP PROCEDURE IF EXISTS nbr_velos_dispos_station;
DROP PROCEDURE IF EXISTS nbr_places_dispos_station;
DROP PROCEDURE IF EXISTS ajout_debut_utilisation;
DROP PROCEDURE IF EXISTS ajout_fin_utilisation;
DROP PROCEDURE IF EXISTS history_utilisateur;
DROP PROCEDURE IF EXISTS nbr_km_parcourus_semaine;
DROP PROCEDURE IF EXISTS nbr_km_parcourus_mois;
DROP PROCEDURE IF EXISTS nbr_km_parcourus_annee;
DROP PROCEDURE IF EXISTS nbr_h_adh_annee;
DROP PROCEDURE IF EXISTS nbr_km_parcourus_semaine_all;

/** SUPPRESSION PROCEDURES UTILISATEUR **/
DROP PROCEDURE IF EXISTS exist_adherent;
DROP PROCEDURE IF EXISTS ajout_personne;
DROP PROCEDURE IF EXISTS info_velo_station;
DROP PROCEDURE IF EXISTS info_station_commune;
DROP PROCEDURE IF EXISTS dist_between_2_stations;
DROP PROCEDURE IF EXISTS rank_start_station;
DROP PROCEDURE IF EXISTS rank_end_station;
DROP PROCEDURE IF EXISTS date_end_adhesion;
DROP PROCEDURE IF EXISTS duration_adhesion;

/** SUPPRESSION PROCEDURES ADMINISTRATEUR **/
DROP PROCEDURE IF EXISTS info_adherent;
DROP PROCEDURE IF EXISTS infos_velos;
DROP PROCEDURE IF EXISTS ajout_velo;
DROP PROCEDURE IF EXISTS suppression_velo;
DROP PROCEDURE IF EXISTS suppression_adherent;
DROP PROCEDURE IF EXISTS deplacement_velo;

";
	$connection->multi_query($suppression_autres);
	$connection->close();
	
     ?>


   </table>
 </body>
</html>
