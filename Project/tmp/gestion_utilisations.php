<html>
<head>
<title>Page avec du PHP</title>
<link href="style/bouttons.css" rel="stylesheet" type="text/css">
</head>
<body>

	<div>
		<input type="button" class = 'button' onclick="window.location.href = 'https://cdeplanne001.vvvpedago.enseirb-matmeca.fr/tmp/mise_a_jour.php';" value="Retour"/> 
    </div>  

	<br>
	
	<h1> Gestion des utilisations</h1>
	
	<h2> Supprimer une utilisation</h2> 

	<form method = "post">
		<p>
			<label>Num&eacute;ro de l'utilisation :</label>
			<input type="text" name="id_utilisateur" />
            <input type="submit" class = 'button' value="Supprimer" />
            <input type="submit" class = 'button' value="?" name="aide"/>
		</p>
    </form>
	
	<?php

	
	if (!empty($_POST['id_utilisateur'])) 
        {	
			include "connect.php";
			$requete = "CALL delete_utilisation(".$_POST['id_utilisateur'].");";
			if($res = $connection->query($requete)){
				echo "<h3>Suppression effectu&eacute;e</h3>";
				$connection->close();
			}
			else{
				echo "<h3>$connection->error</h3>";
				$connection->close();
			}
        
	}
        
        
      if (!empty($_POST['aide'])) {
			echo "<h3>Listes des utilisations possibles</h3>";
			?>
		  <table>
			  <thead>
				<tr>
					<th>ID utilisation</th>
					<th>ID adherent</th>
					<th>ID station debut</th>
					<th>ID station fin</th>
					<th>Date debut</th>
					<th>Date debut</th>
					<th>Kilometrage</th>
				</tr>
				</thead>
				<tbody>
			<?php

			include "connect.php"; 	
            $requete = "SELECT * FROM utilisations;";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($var =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$var['id_utilisation'].'</td>';
					echo '<td>'.$var['id_adherent'].'</td>';
					echo '<td>'.$var['id_station_debut'].'</td>';
					echo '<td>'.$var['id_station_fin'].'</td>';
					echo '<td>'.$var['date_debut'].'</td>';
					echo '<td>'.$var['date_fin'].'</td>';
					echo '<td>'.$var['kilometrage_parcouru'].'</td>';
					echo '</tr>'."\n";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
		}

?>
</tbody>
</table>
</body>
</html>
