<html>
   <head>
      <title>Ma première page HTML</title>
      <meta http-equiv="content-type" content="text/html;charset=utf-8">
		<link href="style/bouttons.css" rel="stylesheet" type="text/css">
   </head>
   <body>
      <!-- Bouton retour -->
		
		<form method = "post">
            <p>
				<input type="hidden" name="return" value="1">
				<input type="submit" class = 'button' value="Retour"  />
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
                <input type="text" name="station1" />
            </p>
            <p>
				<label>Id de la deuxi&egrave;me station:</label>
                <input type="text" name="station2" />
            </p>
            <p>
                <input type="submit" class = 'button' value="Valider" />
                <input type="submit" class = 'button' value="?" name="help" />
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
		}
         
        
        if (!empty($_POST['station1']) && !empty($_POST['station2'])) 
        {
			include "connect.php"; 	
            $requete = "CALL dist_between_2_stations(".$_POST['station1'].", ".$_POST['station2'].");";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete)){
            // ... on récupère un tableau stockant le résultat 
				$station =  $res->fetch_assoc();
				echo "<h3>La distance entre ces deux stations est : ".$station['distance']."km </h3>";
			}
            else{
				echo "<h3>$connection->error</h3>";
			}
		
             //fermeture de la connexion avec la base
             $connection->close();
        } 
        
         ?>
         </table>
   </body>
</html> 
