<html>
   <head>
      <title>Page exemple</title>
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

			echo "<h3>Distance parcouru par semaine :</h3>";
			/*
			?>
			<table>
				<tr>
					<th>ID</th>
					<th>Marque</th>
					<th>Etat</th>
				</tr>

			<?php
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
			<\table>
		*/
		}
	
		if (!empty($_POST['id_adherent'])) {

			echo "<h3>Heures de v&eacute;los effectu&eacute;es par semaine :</h3>";
			/*
			?>
			<table>
				<tr>
					<th>ID</th>
					<th>Marque</th>
					<th>Etat</th>
				</tr>

			<?php
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
			<\table>
		*/
		}
	
	
		if (!empty($_POST['stations'])) {

			echo "<h3>Stations les plus utilis&eacute;es :</h3>";
			/*
			?>
			<table>
				<tr>
					<th>ID</th>
					<th>Marque</th>
					<th>Etat</th>
				</tr>

			<?php
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
			<\table>
		*/
		}
		
		
		if (!empty($_POST['abonnement'])) {

			echo "<h3>Dur&eacute;e de l'abonnement :</h3>";
			/*
			?>
			<table>
				<tr>
					<th>ID</th>
					<th>Marque</th>
					<th>Etat</th>
				</tr>

			<?php
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
			<\table>
		*/
		}
		?>
         
   </body>
</html>

