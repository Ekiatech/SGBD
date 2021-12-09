  <?php
     
     
    include("connect.php"); /* Le fichier connect.php contient les identifiants de connexion */
    /* On crée une table avec des données: */

	$suppression_autres="DROP trigger IF EXISTS utilisations_velos_before;
DROP trigger IF EXISTS utilisations_velos_after;
DROP trigger IF EXISTS utilisations_velos;

DROP VIEW IF EXISTS nbr_velos_dispos_stations;
DROP VIEW IF EXISTS nbr_places_dispos_stations;
DROP VIEW IF EXISTS dates_utilisations;
DROP VIEW IF EXISTS nbr_pers_renew;
DROP VIEW IF EXISTS nbr_renew0;
DROP VIEW IF EXISTS nbr_renew1;
DROP VIEW IF EXISTS stations_bornes;

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
DROP PROCEDURE IF EXISTS se_reabonner;
DROP PROCEDURE IF EXISTS rank_velos_station;

/** SUPPRESSION PROCEDURES ADMINISTRATEUR **/
DROP PROCEDURE IF EXISTS info_adherent;
DROP PROCEDURE IF EXISTS infos_velos;
DROP PROCEDURE IF EXISTS taux_reabonnement;
DROP PROCEDURE IF EXISTS recharche_batterie;
DROP PROCEDURE IF EXISTS avg_nbr_usager_velo_jour;
DROP PROCEDURE IF EXISTS avg_nbr_utilisations_jour;
DROP PROCEDURE IF EXISTS delete_utilisation;
DROP PROCEDURE IF EXISTS delete_adherent;
DROP PROCEDURE IF EXISTS ajout_velo;
DROP PROCEDURE IF EXISTS suppression_velo;
DROP PROCEDURE IF EXISTS fin_adhesion;
DROP PROCEDURE IF EXISTS deplacement_velo;
DROP PROCEDURE IF EXISTS suppression_adherent;
DROP PROCEDURE IF EXISTS recharge_batterie;
DROP PROCEDURE IF EXISTS rank_station_commune;

/** SUPPRESSION PROCEDURES PEUPLEMENT **/
DROP PROCEDURE IF EXISTS ajout_debut_utilisation_peuplement;
DROP PROCEDURE IF EXISTS ajout_fin_utilisation_peuplement;
";
	$connection->multi_query($suppression_autres);

$connection->close();
?>
