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
	
	<h1> Gestion des v&eacute;los</h1>
	
	<h2> Recharger un v&eacute;lo</h2> 

	<form method = "post">
		<p>
			<label>Num&eacute;ro du v&eacute;lo :</label>
			<input type="text" name="id_utilisateur1" />
        </p>
        <p>
			<label>Pourcentage de batterie &agrave; ajouter :</label>
			<input type="text" name="batterie" />
        </p>
        <p>
            <input type="submit" class = 'button' value="Recharger" />
            <input type="submit" class = 'button' value="?" name="id"/>
		</p>
    </form>
	
	<?php

	
	if (!empty($_POST['id_utilisateur1']) && !empty($_POST['batterie'])) 
        {	
			include "connect.php";
			$requete = "CALL recharge_batterie(".$_POST['id_utilisateur1'].",".$_POST['batterie'].");";
			if($res = $connection->query($requete)){
				echo "<h3>Batterie recharg&eacute;e</h3>";
				$connection->close();
			}
			else{
				echo "<h3>$connection->error</h3>";
				$connection->close();
			}
			
				
			

        }
        
      if (!empty($_POST['id'])) {
		  echo "<h3>Listes des v&eacute;los possibles</h3>";
		  ?>
		  <table>
			  <thead>
				<tr>
					<th>ID v&eacute;lo</th>
					<th>Batterie</th>
				</tr>
				</thead>
				<tbody>
			<?php
			include "connect.php"; 	
            $requete = "SELECT * FROM velos;";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($var =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$var['id_velo'].'</td>';
					echo '<td>'.$var['batterie'].'</td>';
					echo '</tr>'."\n";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
		} 
        
     ?>
     </tbody>
     </table>
     <h2>_______________________________________</h2>
	 <h2>D&eacute;placer un v&eacute;lo</h2>
	 
	 <form method = "post">
		<p>
			<label>Num&eacute;ro du v&eacute;lo :</label>
			<input type="text" name="id_utilisateur2" />
        </p>
        <p>
			<label>Id station :</label>
			<input type="text" name="id_station" />
        </p>
        <p>
            <input type="submit" class = 'button' value="D&eacute;placer" />
            <input type="submit" class = 'button' value="?" name="id2"/>
		</p>
    </form>
	
	<?php

	
	if (!empty($_POST['id_utilisateur2']) && !empty($_POST['id_station'])) 
        {	
			include "connect.php";
			$requete = "CALL deplacement_velo(".$_POST['id_utilisateur2'].",".$_POST['id_station'].");";
			if($res = $connection->query($requete)){
				echo "<h3>Deplacement effectu&eacute;</h3>";
				$connection->close();
			}
			else{
				echo "<h3>$connection->error</h3>";
				$connection->close();
			}	
			

        } 
      if (!empty($_POST['id2'])) {
		  echo "<h3>Listes des v&eacute;los possibles</h3>";
		  ?>
		  <table>
			  <thead>
				<tr>
					<th>ID v&eacute;lo</th>
					<th>ID station</th>
				</tr>
				</thead>
				<tbody>
			<?php
			include "connect.php"; 	
            $requete = "SELECT * FROM velos;";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($var =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$var['id_velo'].'</td>';
					echo '<td>'.$var['id_station'].'</td>';
					echo '</tr>'."\n";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
		}
        
     ?>
     </tbody>
  </table>
	
	<h2>_______________________________________</h2>
	 <h2>Supprimer un v&eacute;lo</h2>
	 
	 <form method = "post">
		<p>
			<label>Num&eacute;ro du v&eacute;lo :</label>
			<input type="text" name="id_utilisateur3" />
            <input type="submit" class = 'button' value="Supprimer" />
            <input type="submit" class = 'button' value="?" name="id3"/>
		</p>
    </form>
	
	<?php
	if (!empty($_POST['id3'])) {
		  echo "<h3>Listes des v&eacute;los possibles</h3>";
		  ?>
		  <table>
			  <thead>
				<tr>
					<th>ID v&eacute;lo</th>
					<th>Etat</th>
					<th>Station</th>
				</tr>
				</thead>
			<tbody>
			<?php
			include "connect.php"; 	
            $requete = "SELECT * FROM velos;";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($var =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$var['id_velo'].'</td>';
					echo '<td>'.$var['etat'].'</td>';
					echo '<td>'.$var['id_station'].'</td>';
					echo '</tr>'."\n";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
		}
	 
	 if (!empty($_POST['id_utilisateur3'])) 
        {	
			include "connect.php";
			$requete = "CALL suppression_velo(".$_POST['id_utilisateur3'].");";
			if($res = $connection->query($requete)){
				echo "<h3>Suppression effectu&eacute;</h3>";
				$connection->close();
			}
			else{
				echo "<h3>$connection->error</h3>";
				$connection->close();
			}	
			

        } 

?>
</tbody>
</table>
   
     <h2>_______________________________________</h2>
	 <h2>Ajouter un v&eacute;lo</h2>
	 
	 <form method = "post">
		<p>
			<label>R&eacute;f&eacute;rence :</label>
            <input type="text" name="reference" />
        </p>
        <p>
			<label>Marque :</label>
            <input type="text" name="marque" />
        </p>
        <p>
			<label>Kilometrage :</label>
            <input type="text" name="kilometrage" />
        </p>
        <p>
			<label>Etat :</label>
            <input type="text" name="etat" />
        </p>
         <p>
			<label>Batterie :</label>
            <input type="text" name="batterie" />
        </p>
        <p>
			<label>Id station :</label>
            <input type="text" name="station" />
        </p>
        <p>
            <input type="submit" class = 'button' value="Ajouter" />
        </p>
        
     </form>
     
      <?php
	 if (!empty($_POST['reference']) && !empty($_POST['marque']) && !empty($_POST['kilometrage']) && !empty($_POST['etat']) && !empty($_POST['batterie']) && !empty($_POST['station'])) 
        {	
			include "connect.php";
			$requete = "CALL ajout_velo('".$_POST['reference']."', '".$_POST['marque']."', ".$_POST['kilometrage'].", '".$_POST['etat']."', ".$_POST['batterie'].", ".$_POST['station'].");";
			if($res = $connection->query($requete)){
				echo "<h3>V&eacute;lo ajout&eacute; avec succ&egrave;s</h3>";
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
