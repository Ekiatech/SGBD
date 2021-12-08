<html>
   <head>
      <title>Page exemple</title>
		<link href="style/bouttons.css" rel="stylesheet" type="text/css">
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
            <?php echo "<h1>Mes statistiques -- Adh&eacute;rent n&deg;".$_GET['id']." </h1>"; ?>
        </div>
        
        <br>
        <!-- Récupération des données -->
        
  
        <form method = "post">
            <p>
				<input type="hidden" name="kilometres" value="1">
				<input type="submit" value="" />
				<label>Nombre de kilometres r&eacute;alis&eacute; par semaine </label>
            </p>
        </form>
		
		
		<form method = "post">
            <p>
				<input type="hidden" name="heures" value="1">
				<input type="submit" value=""  />
				<label>Nombre d'heures r&eacute;alis&eacute; par semaine </label>
            </p>
        </form>
        
        <form method = "post">
            <p>
				<input type="hidden" name="stations_debut" value="1">
				<input type="submit" value=""  />
				<label>Classement des stations les plus utilis&eacute;es pour emprunter un v&eacutelo</label>
            </p>
        </form>

		<form method = "post">
            <p>
				<input type="hidden" name="stations_fin" value="1">
				<input type="submit" value=""  />
				<label>Classement des stations les plus utilis&eacute;es pour rendre un v&eacutelo</label>
            </p>
        </form>
		
		 <form method = "post">
            <p>
				<input type="hidden" name="abonnement" value="1">
				<input type="submit" value=""  />
				<label>Temps depuis votre d&eacute;but d'abonnement </label>
            </p>
        </form>

		<form method = "post">
            <p>
				<input type="hidden" name="fin_abonnement" value="1">
				<input type="submit" value=""  />
				<label>Date de fin d'abonnement </label>
            </p>
        </form>

		<form method = "post">
            <p>
				<input type="hidden" name="reabonnement" value="1">
				<input type="submit" value=""  />
				<label>Se reabonner </label>
            </p>
        </form>
        
        <br>
		
		<!-- Requete -->



        <?php 
        
		
		if (!empty($_POST['kilometres'])) {

			echo "<h3>Distance parcouru par semaine :</h3>";
			
			?>
			<table>
				<tr>
					<th>Semaine</th>
					<th>Kilom&egrave;tre</th>
				</tr>

			<?php
			include "connect.php"; 	
            $requete = "CALL nbr_km_parcourus_semaine (".$_GET['id'].");";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($station =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$velo['weeks'].'</td>';
					echo '<td>'.$velo['SUM(kilometrage_parcouru)'].'</td>';
					echo '</tr>'."\n";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
			?>

			</table>
		
			<?php
		}
	
		if (!empty($_POST['heures'])) {

			echo "<h3>Heures de v&eacute;los effectu&eacute;es par semaine :</h3>";
			
			?>
			<table>
				<tr>
					<th>ID</th>
					<th>Marque</th>
					<th>Etat</th>
				</tr>

			<?php
			include "connect.php"; 	
            $requete = "CALL nbr_km_parcourus_annee (".$_GET['id'].");";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($station =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$velo['years'].'</td>';
					echo '<td>'.$velo['SUM(kilometrage_parcouru)'].'</td>';
					echo '</tr>'."\n";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
			
			 ?>

			 </table>
		 
			 <?php
		}
	
	
		if (!empty($_POST['stations_debut'])) {

			echo "<h3>Stations les plus utilis&eacute;es pour emprunter un v&eacute;lo :</h3>";
			
			?>
			<table>
				<tr>
					<th>Id_station</th>
					<th>Nombre d'utilisations</th>
				</tr>

			<?php
			include "connect.php"; 	
            $requete = "CALL rank_start_station(".$_GET['id'].");";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($station =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$velo['id_station_debut'].'</td>';
					echo '<td>'.$velo['nbr_utilisations'].'</td>';
					echo '</tr>'."\n";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
			
			 ?>

			 </table>
		 
			 <?php
		
		}


		if (!empty($_POST['stations_fin'])) {

			echo "<h3>Stations les plus utilis&eacute;es pour rendre un v&eacute;lo :</h3>";
			
			?>
			<table>
				<tr>
					<th>Id_station</th>
					<th>Nombre d'utilisations</th>
				</tr>

			<?php
			include "connect.php"; 	
            $requete = "CALL rank_end_station(".$_GET['id'].");";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($station =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$velo['id_station_debut'].'</td>';
					echo '<td>'.$velo['nbr_utilisations'].'</td>';
					echo '</tr>'."\n";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
			
			 ?>

			 </table>
		 
			 <?php
		
		}
		
		
		if (!empty($_POST['abonnement'])) {

			echo "<h3>Dur&eacute;e de l'abonnement :";
			
			include "connect.php"; 	
            $requete = "CALL duration_adhesion(".$_GET['id'].");";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($station =  $res->fetch_assoc()) {
					echo $station['TIMESTAMPDIFF(DAY, date_debut_adhesion, date_fin_adhesion)']."</h3>";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
		}

		if (!empty($_POST['fin_abonnement'])) {

			echo "<h3>Fin de l'abonnement :";
			
			include "connect.php"; 	
            $requete = "CALL date_end_adhesion(".$_GET['id'].");";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($station =  $res->fetch_assoc()) {
					echo $station['date_fin_adhesion']."</h3>";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
			 
		}

		if (!empty($_POST['reabonnement'])) {

			
			include "connect.php"; 	
            $requete = "CALL se_reabonner(".$_GET['id'].");";
            // Si l'execution est reussie... 
            if($connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				echo "<h3>Reabonnement effectu&eacute</h3>";

             //fermeture de la connexion avec la base
             $connection->close();
			 
		}



		?>
         
   </body>
</html>

