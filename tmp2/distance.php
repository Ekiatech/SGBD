<html>
   <head>
      <title>Ma première page HTML</title>
      <meta http-equiv="content-type" content="text/html;charset=utf-8">
   </head>
   <body>
      <!-- Bouton retour -->
		
		<form method = "post">
            <p>
				<input type="hidden" name="return" value="1">
				<input type="submit" value="Retour"  />
            </p>
        </form>
        
        <?php
        if (!empty($_POST['return'])) {
			header("Location: https://cdeplanne001.vvvpedago.enseirb-matmeca.fr/tmp/menu_utilisateur.php?id=".$_GET['id']);
			exit();
		}
        ?>
        
         <!-- Type de la requete -->
        <div>
            <h1>Distance entre deux stations</h1>
        </div>
        
        <!-- Récupération des données -->
        <form method = "post">
            <p>
				<label>Id de la premi&egrave;re station :</label>
                <input type="text" name="commune" />
            </p>
            <p>
				<label>Id de la deuxi&egrave;me station:</label>
                <input type="text" name="commune" />
            </p>
            <p>
                <input type="submit" value="Valider" />
                <input type="submit" value="?" name="help" />
            </p>
        </form>

        
        <!-- Requete -->
        
        <?php 
        
		
		if (!empty($_POST['help'])) {

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
             echo "<h4> Attention - Id 1 doit &ecirc;tre inferieur &agrave; Id 2</h4>";
		}
         
        
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
