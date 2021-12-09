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
				<input type="submit" class = 'button' value="Retour"  />
            </p>
        </form>
        
        <?php
        if (!empty($_POST['return'])) {
			header("Location: https://cdeplanne001.vvvpedago.enseirb-matmeca.fr/tmp/menu_adherent.php?id=".$_GET['id']);
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
				<input type="hidden" name="historique" value="1">
				<input type="submit" class = 'button' value="" />
				<label>Historique des utilisations </label>
            </p>
        </form>
        
        
        <form method = "post">
            <p>
				<input type="hidden" name="kilometres" value="1">
				<input type="submit" class = 'button' value="" />
				<label>Nombre de kilom&egrave;tres r&eacute;alis&eacute;s par semaine </label>
            </p>
        </form>
		
		
		<form method = "post">
            <p>
				<input type="hidden" name="heures" value="1">
				<input type="submit" class = 'button' value=""  />
				<label>Temps d'utilisation de v&eacute;los r&eacute;alis&eacute; par an </label>
            </p>
        </form>
        
        <form method = "post">
            <p>
				<input type="hidden" name="stations_debut" value="1">
				<input type="submit" class = 'button' value=""  />
				<label>Classement des stations les plus utilis&eacute;es pour emprunter un v&eacutelo</label>
            </p>
        </form>

		<form method = "post">
            <p>
				<input type="hidden" name="stations_fin" value="1">
				<input type="submit" class = 'button' value=""  />
				<label>Classement des stations les plus utilis&eacute;es pour rendre un v&eacutelo</label>
            </p>
        </form>
		
	
        <br>
		
		<!-- Requete -->



        <?php 
        
        if (!empty($_POST['historique'])) {
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
            $requete = "CALL history_utilisateur(".$_GET['id'].");";
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
        }
        ?>
        </tbody>
</table>
<?php
		
		if (!empty($_POST['kilometres'])) {

			echo "<h3>Distance parcouru par semaine :</h3>";
			
			?>
			<table>
				<thead>
				<tr>
					<th>Semaine</th>
					<th>Kilom&egrave;tre</th>
				</tr>
				</thead>
    <tbody>

			<?php
			include "connect.php"; 	
            $requete = "CALL nbr_km_parcourus_semaine (".$_GET['id'].");";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($var =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$var['weeks'].'</td>';
					echo '<td>'.$var['SUM(kilometrage_parcouru)'].'</td>';
					echo '</tr>'."\n";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
			?>
			</tbody>
			</table>
		
			<?php
		}
	
		if (!empty($_POST['heures'])) {

			echo "<h3>Temps d'utilisation de v&eacute;lo r&eacute;alis&eacute; par an :</h3>";
			
			?>
			<table>
				<thead>
				<tr>
					<th>Ann&eacute;e</th>
					<th>minute.s</th>
				</tr>
				</thead>
    <tbody>

			<?php
			include "connect.php"; 	
            $requete = "CALL nbr_h_adh_annee (".$_GET['id'].");";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($var =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$var['years'].'</td>';
					echo '<td>'.$var['SUM(TIMESTAMPDIFF(MINUTE, date_debut, date_fin))'].'</td>';
					echo '</tr>'."\n";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
			
			 ?>
			</tbody>
			 </table>
		 
			 <?php
		}
	
	
		if (!empty($_POST['stations_debut'])) {

			echo "<h3>Stations les plus utilis&eacute;es pour emprunter un v&eacute;lo :</h3>";
			
			?>
			<table>
				<thead>
				<tr>
					<th>Id_station</th>
					<th>Nombre d'utilisations</th>
				</tr>
				</thead>
    <tbody>

			<?php
			include "connect.php"; 	
            $requete = "CALL rank_start_station(".$_GET['id'].");";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($var =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$var['id_station_debut'].'</td>';
					echo '<td>'.$var['nbr_utilisations'].'</td>';
					echo '</tr>'."\n";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
			
			 ?>
			 </tbody>
			 </table>
		 
			 <?php
		
		}


		if (!empty($_POST['stations_fin'])) {

			echo "<h3>Stations les plus utilis&eacute;es pour rendre un v&eacute;lo :</h3>";
			
			?>
			<table>
				<thead>
				<tr>
					<th>Id_station</th>
					<th>Nombre d'utilisations</th>
				</tr>
				</thead>
    <tbody>

			<?php
			include "connect.php"; 	
            $requete = "CALL rank_end_station(".$_GET['id'].");";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($var =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$var['id_station_fin'].'</td>';
					echo '<td>'.$var['nbr_utilisations'].'</td>';
					echo '</tr>'."\n";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
			
			 ?>
			 </tbody>
			 </table>
		 
			 <?php
		
		}
		



		?>
         
   </body>
</html>

