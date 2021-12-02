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
            <h1>Listes des v&eacute;los  pr&eacute;sent &agrave; une station</h1>
        </div>
        
        <!-- Récupération des données -->
        
        <form method = "post">
            <p>
				<label>Num&eacute;ro de la station :</label>
                <input type="text" name="prenom" />
                <input type="submit" value="Valider" />
            </p>
        </form>
		

		<!-- Requete -->
        <?php 
        
        if (!empty($_POST['prenom'])) 
        {
			echo "V&eacute;los  pr&eacute;sent &agrave; la station num&eacute;ro ".$_POST['prenom']." :\n";
		?>
		<table>
			<tr>
		<th>id</th>
		<th>marque</th>
			</tr>

		<?php
			include "connect.php"; 	
            $requete = "SELECT velos.* FROM velos INNER JOIN stations on velos.id_station = stations.id_station WHERE stations.id_station=".$_POST['prenom'].";";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($velo =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$velo['id_velo'].'</td>';
					echo '<td>'.$velo['marque'].'</td>';
					echo '</tr>'."\n";
                }
		
             //fermeture de la connexion avec la base
             $connection->close();
        } 
        
         ?>
         </table>
   </body>
</html>

