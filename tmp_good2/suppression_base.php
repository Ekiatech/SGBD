 <html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>

     <?php
     
     echo "<h2>Suppression de la base</h2>";
     
    include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */
    /* On crée une table avec des données: */

	$suppression="/** SUPPRESSION FOREIGN KEY **/

ALTER TABLE velos DROP FOREIGN KEY `fk_velos_id_station`;
ALTER TABLE adherents DROP FOREIGN KEY `fk_adherent_personnes`;
ALTER TABLE utilisations DROP FOREIGN KEY `fk_utilisations_id_velo`;
ALTER TABLE utilisations DROP FOREIGN KEY `fk_utilisations_id_adherent`;
ALTER TABLE utilisations DROP FOREIGN KEY `fk_utilisations_id_station_debut`;
ALTER TABLE utilisations DROP FOREIGN KEY `fk_utilisations_id_station_fin`;
ALTER TABLE etre_eloigne DROP FOREIGN KEY `fk_etre_eloigne_station`;
ALTER TABLE etre_eloigne DROP FOREIGN KEY `fk_etre_eloigne_stationbis`;

/** SUPPRESSION TABLES **/
DROP TABLE velos;
DROP TABLE stations;
DROP TABLE utilisations;
DROP TABLE adherents;
DROP TABLE personnes;
DROP TABLE etre_eloigne;";
	$connection->multi_query($suppression);
	echo "tables supprimees";
	$connection->close();
	
     ?>


   </table>
 </body>
</html>
