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
	
	<h1> Gestion des ad&eacute;rents</h1>
	
	<h2> Mettre fin &agrave; l'abonnement d'un adh&eacute;rent</h2> 

	<form method = "post">
		<p>
			<label>Num&eacute;ro de l'adh&eacute;rent :</label>
			<input type="text" name="id_utilisateur1" />
            <input type="submit" class = 'button' value="D&eacute;sabonner" />
            <input type="submit" class = 'button' value="?" name="id"/>
		</p>
    </form>
	
	<?php

	
	if (!empty($_POST['id_utilisateur1'])) 
        {	
			include "connect.php";
			$requete = "CALL fin_adhesion(".$_POST['id_utilisateur1'].");";
			if($res = $connection->query($requete)){
				echo "<h3>D&eacute;sabonnement effectu&eacute;</h3>";
				$connection->close();
			}
			else{
				echo "<h3>$connection->error</h3>";
				$connection->close();
			}	
			

        } 
        
     if (!empty($_POST['id'])) {
			echo "<h3>Listes des adh&eacute;rents possibles</h3>";
			?>
			<table>
				<thead>
				<tr>
					<th>Id adh&eacute;rent</th>
			</tr>
			</thead>
    <tbody>
			<?php
			include "connect.php"; 	
            $requete = "SELECT * FROM adherents;";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($station =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$station['id_adherent'].'</td>';
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
     
     <h2>_______________________________________</h2>
	 <h2>Supprimer un adh&eacute;rent</h2>
	 
	 <form method = "post">
		<p>
			<label>Num&eacute;ro de l'adh&eacute;rent :</label>
			<input type="text" name="id_utilisateur2" />
            <input type="submit" class = 'button' value="Supprimer" />
            <input type="submit" class = 'button' value="?" name="id2"/>
		</p>
    </form>
	
	<?php
	if (!empty($_POST['id2'])) {
			echo "<h3>Listes des adh&eacute;rents possibles</h3>";
			?>
			<table>
				<thead>
				<tr>
					<th>Id adh&eacute;rent</th>
			</tr>
			</thead>
    <tbody>
			<?php
			include "connect.php"; 	
            $requete = "SELECT * FROM adherents;";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($station =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$station['id_adherent'].'</td>';
					echo '</tr>'."\n";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
		}
		?>
		</tbody>
</table>
<?php
	
	if (!empty($_POST['id_utilisateur2'])) 
        {	
			include "connect.php";
			$requete = "CALL delete_adherent(".$_POST['id_utilisateur2'].");";
			if($res = $connection->query($requete)){
				echo "<h3>Suppression effectu&eacute;e</h3>";
				$connection->close();
			}
			else{
				echo "<h3>$connection->error</h3>";
				$connection->close();
			}
        
	}
     ?>


</body>
</html>
