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
            <h1>Listes des stations  pr&eacute;sentes dans une commune</h1>
        </div>
        
        <!-- Récupération des données -->
        <form method = "post">
            <p>
				<label>Nom de la commune :</label>
                <input type="text" name="commune" />
                <input type="submit" value="Valider" />
            </p>
        </form>

        
        <!-- Requete -->
        <?php 
        
        if (!empty($_POST['commune'])) 
        {
			echo "Station pr&eacute;sentes &agrave; ".$_POST['commune'];
		?>
		<table>
			<tr>
		        <th>id_station</th>
		        <th>adresse</th>
			</tr>

		<?php
			include "connect.php"; 	
            $requete = "SELECT * FROM stations WHERE commune = '".$_POST['commune']."';";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($station =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$station['id_station'].'</td>';
					echo '<td>'.$station['adresse'].'</td>';
					echo '</tr>'."\n";
                }
		
             //fermeture de la connexion avec la base
             $connection->close();
        } 
        
         ?>
         </table>    
   </body>
</html>

