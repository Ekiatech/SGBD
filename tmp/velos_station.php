<html>
   <head>
      <title>Page exemple</title>
   </head>
   <body>

        <!-- Bouton retour -->
        <div>
            <input type="button" onclick="window.location.href = 'https://cdeplanne001.vvvpedago.enseirb-matmeca.fr/tmp/menu_utilisateur.php';" value="Retour"/> 
        </div>  
        
        <!-- Type de la requete -->
        <div>
            <h1>Informations sur les v&eacute;los  pr&eacute;sent &agrave; une station</h1>
        </div>
        
        <br>
        <!-- Récupération des données -->
        
        <form method = "post">
            <p>
				<label>Num&eacute;ro de la station :</label>
                <input type="text" name="id_station" />
                <input type="submit" value="Valider" />
                <input type="submit" value="?" name="liste" />
            </p>
        </form>
		
		<br>
		<!-- Requete -->

        <?php 
        
		
		if (!empty($_POST['liste'])) {

			echo "<h3>Listes des stations possibles</h3>";
			echo "<b>ID_station</b><br>";
			include "connect.php"; 	
            $requete = "SELECT * FROM stations;";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($station =  $res->fetch_assoc()) {
					echo $station['id_station']."<br>";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
		}
        
        if (!empty($_POST['id_station'])) 
        {
			echo "<h3>V&eacute;los  pr&eacute;sent &agrave; la station num&eacute;ro ".$_POST['id_station']." :\n</h3>";
		?>
		<table>
			<tr>
		        <th>ID</th>
		        <th>Marque</th>
		        <th>Etat</th>
			</tr>

		<?php
			include "connect.php"; 	
            $requete = "SELECT velos.* FROM velos INNER JOIN stations on velos.id_station = stations.id_station WHERE stations.id_station=".$_POST['id_station'].";";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($velo =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$velo['id_velo'].'</td>';
					echo '<td>'.$velo['marque'].'</td>';
					echo '<td>'.$velo['etat'].'</td>';
					echo '</tr>'."\n";
                }
		
             //fermeture de la connexion avec la base
             $connection->close();
        } 
        
         ?>
         </table>
         <br>
         <?php 
        
        if (!empty($_POST['id_station'])) 
        {
			echo "<h3>Classement des v&eacute;los les plus charg&eacute;s &agrave; la station num&eacute;ro ".$_POST['id_station']." :\n</h3>";
		?>
		<table>
			<tr>
		        <th>ID</th>
		        <th>Batterie</th>
			</tr>

		<?php
			include "connect.php"; 	
            $requete = "SELECT id_velo, batterie FROM velos INNER JOIN stations on velos.id_station = stations.id_station WHERE stations.id_station=".$_POST['id_station']." ORDER BY batterie DESC;";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($velo =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$velo['id_velo'].'</td>';
					echo '<td>'.$velo['batterie'].'</td>';
					echo '</tr>'."\n";
                }
		
             //fermeture de la connexion avec la base
             $connection->close();
        } 
        
         ?>
         </table>
         
   </body>
</html>

