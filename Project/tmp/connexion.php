<html>
<head>
<title>Page avec du PHP</title>
<link href="style/bouttons.css" rel="stylesheet" type="text/css">
</head>
<body>

	<div>
		<input type="button" class = 'button' onclick="window.location.href = 'https://cdeplanne001.vvvpedago.enseirb-matmeca.fr/tmp/interface.php';" value="Retour"/> 
    </div>  

	<br>
	
	<h2>Se connecter</h2> 

	<form method = "post">
		<p>
			<label>Entrez votre num&eacute;ro d'adh&eacute;rent :</label>
			<input type="text" name="id_utilisateur" />
            <input type="submit" class = 'button' value="Se connecter" />
            <input type="submit" class = 'button' value="?" name="id"/>
		</p>
    </form>
	
	<?php
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
	
	if (!empty($_POST['id_utilisateur'])) 
        {	
			include "connect.php";
			$requete = "CALL exist_adherent(".$_POST['id_utilisateur'].");";
			if($res = $connection->query($requete)){
				
				header("Location: https://cdeplanne001.vvvpedago.enseirb-matmeca.fr/tmp/menu_adherent.php?id=".$_POST['id_utilisateur']);
				$connection->close();
				exit();
			}
			else{
				echo "<h3>$connection->error</h3>";
			}
			$connection->close();
				
			

        } 
        
     ?>
     
     <h2>_______________________________________</h2>
	 <h2>S'abonner pour 6 mois</h2>
	 
	 <form method = "post">
		<p>
			<label>Nom :</label>
            <input type="text" name="nom" />
        </p>
        <p>
			<label>Pr&eacute;nom :</label>
            <input type="text" name="prenom" />
        </p>
        <p>
			<label>Adresse :</label>
            <input type="text" name="adresse" />
        </p>
        <p>
			<label>Commune :</label>
            <input type="text" name="commune" />
        </p>
        <p>
            <input type="submit" class = 'button' value="S'abonner" />
        </p>
        
     </form>
     
      <?php
	 if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['adresse']) && !empty($_POST['commune'])) 
        {	
			include "connect.php";
			$requete = "CALL ajout_personne('".$_POST['nom']."', '".$_POST['prenom']."', '".$_POST['adresse']."', '".$_POST['commune']."');";
			if($res = $connection->query($requete)){
				$id = $res->fetch_assoc();
				header("Location: https://cdeplanne001.vvvpedago.enseirb-matmeca.fr/tmp/menu_adherent.php?id=".$id['new_id_adherent']);
				$connection->close();
				exit();
			}
					
			else{
				echo "<h3>$connection->error</h3>";
				$connection->close();
			}

        } 
	?>
	 


</body>
</html>
