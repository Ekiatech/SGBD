<html>
   <head>
      <title>Page exemple</title>
		<link href="style/bouttons.css" rel="stylesheet" type="text/css">
   </head>
   <body>

        <!-- Bouton retour -->
		
		<div>
            <input type="button" class = 'button' onclick="window.location.href = 'https://cdeplanne001.vvvpedago.enseirb-matmeca.fr/tmp/menu_administrateur.php';" value="Retour"/> 
        </div>
        <br>
        
        <!-- Type de la requete -->
        <div>
            <h1>Statistiques g&eacute;n&eacute;rales</h1>
        </div>
        
        <br>
        <!-- Récupération des données -->
        
  
        <form method = "post">
            <p>
				<input type="hidden" name="station_emprunt" value="1">
				<input type="submit" class = 'button' value="" />
				<label>Classement des stations les plus utilis&eacute;es pour emprunter un v&eacute;lo </label>
            </p>
        </form>
		
		
		<form method = "post">
            <p>
				<input type="hidden" name="station_rendu" value="1">
				<input type="submit" class = 'button' value=""  />
				<label>Classement des stations les plus utilis&eacute;es pour rendre un v&eacute;lo </label>
            </p>
        </form>
        
        <form method = "post">
            <p>
				<input type="hidden" name="velo_utilisation" value="1">
				<input type="submit" class = 'button' value=""  />
				<label>Classement des v&eacute;los les plus utilis&eacute;s </label>
            </p>
        </form>
        
          <form method = "post">
            <p>
				<input type="hidden" name="trajets" value="1">
				<input type="submit" class = 'button' value=""  />
				<label>Classement des trajets les plus effectu&eacute;s </label>
            </p>
        </form>
        
		
		 <form method = "post">
            <p>
				<input type="hidden" name="moyenne_distance" value="1">
				<input type="submit" class = 'button' value=""  />
				<label>Moyenne de la distance parcourue par semaine </label>
            </p>
        </form>
		
		
        <form method = "post">
            <p>
				<input type="submit" class = 'button' value=""  />
				<label>Moyenne du nombre d'usagers par jour pour un v&eacute;lo  donn&eacute;  --  Id v&eacute;lo : </label>
				<input type="text" name="moyenne_usager" />
				<input type="submit" class = 'button' value="?" name="help_velo"/>
            </p>
        </form>
        
		
		 <form method = "post">
            <p>
				<input type="submit" class = 'button' value=""  />
				<label>Moyenne du nombre d'utilisations par adh&eacute;rent pour un jour donn&eacute; -- Date : </label>
				<input type="text" name="moyenne_utilisation" />
				<input type="submit" class = 'button' value="?" name="help_date"/>
            </p>
        </form>
        
         <form method = "post">
            <p>
				<input type="hidden" name="renouvellement" value="1">
				<input type="submit" class = 'button' value=""  />
				<label>Rapport de renouvellement d'abonnement </label>
            </p>
        </form>
        
        <br>
        
        <!-- Aide -->
        
        <?php
        if (!empty($_POST['help_date'])) {

			echo "<h3>Usage : ann&eacute;e-mois-jour  (Exemple : 2021-11-09)</h3>";

			
		}
		
		
		if (!empty($_POST['help_velo'])) {

			echo "<h3>Listes des v&eacute;los possibles</h3>";
			?>
			<table>
				<thead>
				<tr>
					<th>Id v&eacute;lo</th>
			</tr>
			</thead>
    <tbody>
			<?php
			include "connect.php"; 	
            $requete = "SELECT * FROM velos;";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($station =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$station['id_velo'].'</td>';
					echo '</tr>'."\n";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
		}
		?>
		</tbody>
</table>
<?php
        
		?>
		<!-- Requete -->



        <?php 
        
		
		if (!empty($_POST['station_emprunt'])) {

			echo "<h3>Classement des stations les plus utilis&eacute;es pour emprunter un v&eacute;lo :</h3>";
			
			?>
			<table>
				<thead>
				<tr>
					<th>ID station</th>
					<th>Nombre d'utilisations</th>
				</tr>
				</thead>
    <tbody>

			<?php
			include "connect.php"; 	
            $requete = "SELECT id_station_debut, count(*) as nbr_utilisations FROM utilisations GROUP BY id_station_debut ORDER BY nbr_utilisations DESC;";
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
	
		if (!empty($_POST['station_rendu'])) {
			echo "<h3>Classement des stations les plus utilis&eacute;es pour rendre un v&eacute;lo :</h3>";	
		
			?>
			<table>
				<thead>
				<tr>
					<th>ID station</th>
					<th>Nombre d'utilisations</th>
				</tr>
				</thead>
    <tbody>

			<?php
			include "connect.php"; 	
            $requete = "SELECT id_station_fin, count(*) as nbr_utilisations FROM utilisations WHERE id_station_fin IS NOT NULL GROUP BY id_station_fin ORDER BY nbr_utilisations DESC;";
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
	
	
		if (!empty($_POST['velo_utilisation'])) {
			echo "<h3>Classement des v&eacute;lo les plus utilis&eacute;s :</h3>";
			?>
			<table>
				<thead>
				<tr>
					<th>ID v&eacute;lo</th>
					<th>Nombre d'utilisations</th>
				</tr>
				</thead>
    <tbody>

			<?php
			include "connect.php"; 	
            $requete = "SELECT id_velo, count(*) as nbr_utilisations FROM utilisations GROUP BY id_velo ORDER BY nbr_utilisations DESC;";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($var =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$var['id_velo'].'</td>';
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
		
		if (!empty($_POST['trajets'])) {
			echo "<h3>Classement des trajets les plus effectu&eacute;s :</h3>";
			?>
			<table>
				<thead>
				<tr>
					<th>ID station de d&eacute;but</th>
					<th>ID station de fin</th>
					<th>Nombre de fois effectu&eacute;</th>
				</tr>
				</thead>
    <tbody>

			<?php
			include "connect.php"; 	
            $requete = "SELECT id_station_debut, id_station_fin, count(*) as nbr_de_fois_effectue FROM utilisations WHERE id_station_fin IS NOT NULL GROUP BY id_station_debut, id_station_fin ORDER BY nbr_de_fois_effectue DESC;";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($var =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$var['id_station_debut'].'</td>';
					echo '<td>'.$var['id_station_fin'].'</td>';
					echo '<td>'.$var['nbr_de_fois_effectue'].'</td>';
					echo '</tr>'."\n";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
             ?>
             </tbody>
			</table>
			<?php
		
		}
		
		
		if (!empty($_POST['moyenne_distance'])) {
			echo "<h3>Moyenne de la distance parcouru par semaine :</h3>";
			?>
			<table>
				<thead>
				<tr>
					<th>Semaine</th>
					<th>Moyenne distance</th>
				</tr>
				</thead>
    <tbody>

			<?php
			include "connect.php"; 	
            $requete = "SELECT week, (km / nbr_adh) as nbr_km_moyenne_par_adherent FROM (SELECT count(*) as nbr_adh FROM adherents WHERE date_fin_adhesion >= DATE(NOW())) as a, (SELECT weekofyear(date_debut) as week, SUM(kilometrage_parcouru) as km FROM utilisations GROUP BY weekofyear(date_debut)) as b";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($var =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$var['week'].'</td>';
					echo '<td>'.$var['nbr_km_moyenne_par_adherent'].'</td>';
					echo '</tr>'."\n";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
             ?>
             </tbody>
			</table>
			<?php
		}
		
		
		if (!empty($_POST['moyenne_usager'])) {
			echo "<h3>Moyenne du nombre d'usagers par jour pour le v&eacute;lo ".$_POST['moyenne_usager']." : ";
			include "connect.php"; 	
            $requete = "CALL avg_nbr_usager_velo_jour(".$_POST['moyenne_usager'].");";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($var =  $res->fetch_assoc()) {
					echo $var['nbr_use / DATEDIFF(last_date, first_date)']."</h3>";
				}
		}
		
		if (!empty($_POST['moyenne_utilisation'])) {
			echo "<h3>Moyenne du nombre d'utilisation par adh&eacute;rent pour le jour ".$_POST['moyenne_utilisation']." :";
			include "connect.php"; 	
            $requete = "CALL avg_nbr_utilisations_jour('".$_POST['moyenne_utilisation']."');";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($var =  $res->fetch_assoc()) {
					echo $var['nbr_use_moyenne_par_adherent']."</h3>";
				}
		
		
		}
		
		if (!empty($_POST['renouvellement'])) {
			echo "<h3>Taux de personnes qui se sont r&eacute;abonn&eacute;es : ";
			include "connect.php"; 	
            $requete = "CALL taux_reabonnement();";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($var =  $res->fetch_assoc()) {
					echo $var['@nbr_pers_renew / @nbr_pers']."</h3>";

				}
		
             //fermeture de la connexion avec la base
             $connection->close();
		}
		
		?>
         
   </body>
</html>
