<html>
   <head>
      <title>Projet SGBD</title>
		<link href="style/bouttons.css" rel="stylesheet" type="text/css">
   </head>
   <body>

        <!-- Bouton retour -->
		
		<div>
            <input type="button" onclick="window.location.href = 'https://cdeplanne001.vvvpedago.enseirb-matmeca.fr/tmp/menu_administrateur.php';" value="Retour"/> 
        </div>
        <br>
        
        <!-- Type de la requete -->
        <div>
            <h1>Informations g&eacute;n&eacute;rales</h1>
        </div>
        
        <br>
        <!-- Récupération des données -->
        
  
        <form method = "post">
            <p>
				<input type="hidden" name="nbr_adherents" value="1">
				<input type="submit" value="" />
				<label>Nombre d'adh&eacute;rents actuel </label>
            </p>
        </form>
		
		
		<form method = "post">
            <p>
				<input type="submit" class = 'button' value=""  />
				<label>Information sur un adh&eacute;rent -- num&eacute;ro d'adh&eacute;rent : </label>
				<input type="text" name="id_adherent" />
				<input type="submit" class = 'button' value="?" name="help_id"/>
            </p>
        </form>
        
        <form method = "post">
            <p>
				<input type="submit" class = 'button' value=""  />
				<label>Liste des adh&eacute;rent qui utilisent au moins deux v&eacute;los pour un jour donn&eacute;es -- date : </label>
				<input type="text" name="date" />
				<input type="submit" class = 'button' value="?" name="help_date"/>
            </p>
        </form>
		
		 <form method = "post">
            <p>
				<input type="hidden" name="nbr_velos" value="1">
				<input type="submit" class = 'button' value=""  />
				<label>Nombre de v&eacute;los </label>
            </p>
        </form>
        
        <form method = "post">
            <p>
				<input type="hidden" name="velo_utilisation" value="1">
				<input type="submit" class = 'button' value=""  />
				<label>Nombre de v&eacute;los en cours d'utilisation</label>
            </p>
        </form>
        
        <form method = "post">
            <p>
				<input type="submit" class = 'button' value=""  />
				<label>Information sur un v&eacute;lo -- id_v&eacute;lo :</label>
				<input type="text" name="id_velo" />
				<input type="submit" class = 'button' value="?" name="help_velo"/>
            </p>
        </form>
        
        <form method = "post">
            <p>
				<input type="hidden" name="velo_etat" value="1">
				<input type="submit" class = 'button' value=""  />
				<label>Liste des v&eacute;los en mauvais &eacute;tat </label>
            </p>
        </form>
        
        <br>
		
		<!-- Aide -->
		
		<?php 
        
		
		if (!empty($_POST['help_id'])) {

			echo "<h3>Listes des adh&eacute;rnet possibles</h3>";
			echo "<b>ID_adh&eacute;rent</b><br>";
			include "connect.php"; 	
            $requete = "SELECT * FROM adherents;";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($station =  $res->fetch_assoc()) {
					echo $station['id_adherent']."<br>";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
		}
		
		if (!empty($_POST['help_date'])) {

			echo "<h3>Usage : ann&eacute;e/mois/jour  (Exemple : 2021/12/24)</h3>";

			
		}
		
		
		if (!empty($_POST['help_velo'])) {

			echo "<h3>Listes des v&eacute;los possibles</h3>";
			echo "<b>Id_velo</b><br>";
			include "connect.php"; 	
            $requete = "SELECT * FROM velos;";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($station =  $res->fetch_assoc()) {
					echo $station['id_velo']."<br>";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
		}
		
		?>
		
		<!-- Requete -->


        <?php 
        
		
		if (!empty($_POST['nbr_adherents'])) {
			include "connect.php"; 	
			$requete = "SELECT count(*) as nbr FROM adherents WHERE date_fin_adhesion < NOW();";
			// Si l'execution est reussie... 
			if($res = $connection->query($requete))
			// ... on récupère un tableau stockant le résultat 
			while ($var =  $res->fetch_assoc()) {
					echo '<h3>Il y a actuellement '.$var['nbr'].' adh&eacute;rent.s</h3>';
				}
			 //fermeture de la connexion avec la base
			 $connection->close();
		}
	
		if (!empty($_POST['id_adherent'])) {

			echo "<h3>Informations sur un adh&eacute;rent :</h3>";
			
			?>
			<table>
				<tr>
					<th>Id adh&eacute;rent</th>
					<th>Nom</th>
					<th>Prenom</th>
					<th>Adresse</th>
					<th>Commune</th>
					<th>Date d&eacute;but d'abonnement</th>
					<th>Date fin d'abonnement</th>
				</tr>

			<?php
			include "connect.php"; 	
            $requete = "CALL info_adherent(".$_POST['id_adherent'].");";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($station =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$station['id_adherent'].'</td>';
					echo '<td>'.$station['nom'].'</td>';
					echo '<td>'.$station['prenom'].'</td>';
					echo '<td>'.$station['adresse'].'</td>';
					echo '<td>'.$station['commune'].'</td>';
					echo '<td>'.$station['date_debut_adhesion'].'</td>';
					echo '<td>'.$station['date_fin_adhesion'].'</td>';
					echo '</tr>'."\n";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
			?>
			 <\table>
			<?php
		}
	
	
		if (!empty($_POST['date'])) {

			echo "<h3>Liste des adh&eacute;rent qui utilisent au moins deux v&eacute;los pour un jour donn&eacute;es :</h3>";

			echo "<h4>Id adh&eacute;rent</h4>";
			include "connect.php"; 	
            $requete = "SELECT id_adherent FROM (SELECT id_adherent, count(*) as nbr FROM (SELECT id_adherent FROM utilisations WHERE DATE(date_debut) = ".$_POST['date']." GROUP BY id_adherent, id_velo) as d GROUP BY id_adherent) as c WHERE nbr > 1;";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($station =  $res->fetch_assoc()) {
					echo $station['id_adherent']."<br>";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
			 ?>
			 <\table>
			<?php

		}
		
		
		if (!empty($_POST['nbr_velos'])) {

			echo "<h3>Nombre ed v&eacute;lo en cours d'utilisation :</h3>";
			include "connect.php"; 	
            $requete = "SELECT * FROM velos WHERE id_station IS NULL;";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($station =  $res->fetch_assoc()) {
					echo $station['id_velo']."<br>";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();		
		}



		if (!empty($_POST['id_velo'])) {

			echo "<h3>Informations sur le véeacute;lo ".$_POST['id_velo']." :</h3>";
			
			?>
			<table>
				<tr>
					<th>ID</th>
					<th>R&eacute;f&eacute;rence</th>
					<th>Marque</th>
					<th>Etat</th>
					<th>Date de mise en service</th>
					<th>Kilometrage</th>
					<th>Batterie</th>
				</tr>

			<?php
			include "connect.php"; 	
            $requete = "CALL infos_velos(".$_POST['id_velo'].");";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($var =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$var['id_velo'].'</td>';
					echo '<td>'.$var['reference'].'</td>';
					echo '<td>'.$var['marque'].'</td>';
					echo '<td>'.$var['etat'].'</td>';
					echo '<td>'.$var['date_mise_en_service'].'</td>';
					echo '<td>'.$var['kilometrage'].'</td>';
					echo '<td>'.$var['batterie'].'</td>';
					echo '</tr>'."\n";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
			?>
			 <\table>
			<?php
		}


		if (!empty($_POST['nbr_velos'])) {

			echo "<h3>Liste des v&eacute;los en mauvais &eacute;tat :</h3>";
			
			?>
			<table>
				<tr>
					<th>ID</th>
					<th>Etat</th>
				</tr>

			<?php
			include "connect.php"; 	
            $requete = "SELECT * FROM velos WHERE etat IN ('Mauvais', 'Inutilisable');";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($var =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$var['id_velo'].'</td>';
					echo '<td>'.$var['etat'].'</td>';
					echo '</tr>'."\n";
				}
             //fermeture de la connexion avec la base
             $connection->close();
			 ?>
			 <\table>
			<?php
		
		}
		?>
         
   </body>
</html>

