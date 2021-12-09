<html>
	<head>
		<title>Menu adh&eacute;rent</title>
		<link href="style/bouttons.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		
		
		
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
        
        
        
		<?php echo "<h1>Adh&eacute;rent  - n&deg;".$_GET['id']." </h1>"; ?>
		
		
		<!-- Listes des stations dans une commune -->
		
		<form method = "post">
            <p>
				<input type="submit" class = 'button' value=""  />
				<label>Listes des stations  pr&eacute;sentes dans une commune donn&eacute;e  --  Nom commune : </label>
				<input type="text" name="commune1" />
				<input type="submit" class = 'button' value="?" name="help_commune"/>
            </p>
        </form>
        
        
        
        <!-- Classement des stations dans une commune par nombre de places disponibles -->
		
		
		
		<form method = "post">
            <p>
				<input type="submit" class = 'button' value=""  />
				<label>Classement des stations dans une commune par nombre de v&eacute;los disponibles  --  Nom commune :  </label>
				<input type="text" name="commune2" />
				<input type="submit" class = 'button' value="?" name="help_commune"/>
            </p>
        </form>
        
		
		
		<!-- Listes des vélos  présent à une station -->
		
		
		
		<form method = "post">
            <p>
				<input type="submit" class = 'button' value=""  />
				<label>Informations sur les v&eacute;los  pr&eacute;sent &agrave; une station donn&eacute;e  --  Id station :</label>
				<input type="text" name="id_station1" />
				<input type="submit" class = 'button' value="?" name="help_station"/>
            </p>
        </form>
        
		
		<!-- Classement des vélos a une station par batterie -->
		
		
		
		<form method = "post">
            <p>
				<input type="submit" class = 'button' value=""  />
				<label>Classement des v&eacute;los &agrave; une station donn&eacute;e en fonction de leur batterie  --  Id station : </label>
				<input type="text" name="id_station2" />
				<input type="submit" class = 'button' value="?" name="help_station"/>
            </p>
        </form>
        
        
        
        <!-- Distance entre deux stations -->
		
		<form method = "post">
            <p>
				<input type="submit" class = 'button' value=""  />
				<label>Distance entre deux stations -- Id station 1 : </label>
				<input type="text" name="station1" />
				<label> -- Id station 2 : </label>
				<input type="text" name="station2" />
				<input type="submit" class = 'button' value="?" name="help_station"/>
            </p>
        </form>
        

        
		
    <!-- Aide -->
    
    
	<?php
	if (!empty($_POST['help_commune'])) {

			echo "<h3>Listes des communes possibles</h3>";
			?>
			<table>
				<thead>
				<tr>
					<th>Commune</th>
				</tr>
				</thead>
    <tbody>

			<?php
			echo "<b>Communes</b><br>";
			include "connect.php"; 	
            $requete = "SELECT DISTINCT commune from stations GROUP BY commune; ";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($var =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$var['commune'].'</td>';
					echo '</tr>'."\n";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
		}
		
		 ?> </tbody>
 </table>
 <?php
        
    
    
    
    if (!empty($_POST['help_station'])) {

			echo "<h3>Listes des stations possibles</h3>";
			?>
			<table>
				<thead>
				<tr>
					<th>Id station</th>
					<th>Adresse</th>
					<th>Commune</th>
				</tr>
				</thead>
    <tbody>

			<?php
			include "connect.php"; 	
            $requete = "SELECT * FROM stations;";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($var =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$var['id_station'].'</td>';
					echo '<td>'.$var['adresse'].'</td>';
					echo '<td>'.$var['commune'].'</td>';
					echo '</tr>'."\n";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
		}

 ?> </tbody>
 </table>
 
    <!-- Requete -->
    <?php
    if (!empty($_POST['id_station1'])) 
        {
			echo "<h3>V&eacute;los  pr&eacute;sent &agrave; la station num&eacute;ro ".$_POST['id_station1']." :\n</h3>";
		?>
		<table>
			<thead>
			<tr>
		        <th>ID</th>
		        <th>Marque</th>
		        <th>Etat</th>
			</tr>
			</thead>
    <tbody>

		<?php
			include "connect.php"; 	
            $requete = "SELECT velos.* FROM velos INNER JOIN stations on velos.id_station = stations.id_station WHERE stations.id_station=".$_POST['id_station1'].";";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($velo =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$velo['id_velo'].'</td>';
					echo '<td>'.$velo['marque'].'</td>';
					echo '<td>'.$velo['etat'].'</td>';
					echo '</tr>'."\n";
                }
		
             //fermeture de la connexion avec la base
             $connection->close();
        } 
        
         ?>
         </tbody>
         </table>
         <br>
         <?php 
        
        if (!empty($_POST['id_station2'])) 
        {
			echo "<h3>Classement des v&eacute;los les plus charg&eacute;s &agrave; la station num&eacute;ro ".$_POST['id_station2']." :\n</h3>";
		?>
		<table>
			<thead>
			<tr>
		        <th>ID</th>
		        <th>Batterie</th>
			</tr>
			</thead>
    <tbody>

		<?php
			include "connect.php"; 	
            $requete = "SELECT id_velo, batterie FROM velos INNER JOIN stations on velos.id_station = stations.id_station WHERE stations.id_station=".$_POST['id_station2']." ORDER BY batterie DESC;";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($velo =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$velo['id_velo'].'</td>';
					echo '<td>'.$velo['batterie'].'</td>';
					echo '</tr>'."\n";
                }
		
             //fermeture de la connexion avec la base
             $connection->close();
        } 
        
         ?>
         </tbody>
         </table>
         <?php
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
        
     if (!empty($_POST['commune1'])) 
        {
			echo "<h3>Station pr&eacute;sentes &agrave; ".$_POST['commune1']." : </h3>";
		?>
		<table>
			<thead>
			<tr>
		        <th>id_station</th>
		        <th>adresse</th>
		        <th>Nombres de bornes</th>
			</tr>
			</thead>
    <tbody>

		<?php
			include "connect.php"; 	
            $requete = "SELECT * FROM stations WHERE commune = '".$_POST['commune1']."';";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($station =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$station['id_station'].'</td>';
					echo '<td>'.$station['adresse'].'</td>';
					echo '<td>'.$station['nombre_bornes'].'</td>';
					echo '</tr>'."\n";
                }
		
             //fermeture de la connexion avec la base
             $connection->close();
        } 
        ?>
        </tbody>
        </table>
        <?php
        
    if (!empty($_POST['commune2'])) 
        {
			echo "<h3>Classement des stations par nombre de v&eacute;los disponibles dans ".$_POST['commune2']."</h3>";
		?>
		<table>
			<thead>
			<tr>
		        <th>Id_station</th>
		        <th>Nombre de v&eacute;lo</th>

			</tr>
			</thead>
    <tbody>

		<?php
			include "connect.php"; 	
            $requete = "CALL rank_station_commune('".$_POST['commune2']."');";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($station =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$station['id_station'].'</td>';
					echo '<td>'.$station['nbr_velos'].'</td>';
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
