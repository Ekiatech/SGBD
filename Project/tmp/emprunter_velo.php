<html>
   <head>
      <title>Ma première page HTML</title>
      <meta http-equiv="content-type" content="text/html;charset=utf-8">
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
        
        
        
        
         <?php
        if (!empty($_POST['return'])) {
			header("Location: https://cdeplanne001.vvvpedago.enseirb-matmeca.fr/tmp/menu_utilisateur.php?id=".$_GET['id']);
			exit();
		}
        ?>
        <h
        
        
        <div>
            <h1>Emprunter un v&eacute;lo</h1>
        </div>
        
        
        
        <form method = "post">
            <p>	
				<label>Id du v&eacute;lo &agrave; emprunter :</label> 
				<input type="text" name="velo">
				<input type="submit" class = 'button' value="Emprunter"  />
            </p>
        </form>
        
        <?php
        if (!empty($_POST['velo'])){
			include "connect.php";
			$requete = "CALL ajout_debut_utilisation(".$_POST['velo'].", ".$_GET['id'].");";
			if($res = $connection->query($requete)){
				echo "<h3>V&eacute;lo emprunt&eacute; avec succ&egrave;s</h3>";
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
