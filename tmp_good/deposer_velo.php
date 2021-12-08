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
			header("Location: https://cdeplanne001.vvvpedago.enseirb-matmeca.fr/tmp/menu_utilisateur.php?id=".$_GET['id']);
			exit();
		}
        ?>
        <h
        
        
        <div>
            <h1>D&eacute;poser un v&eacute;lo</h1>
        </div>
        
        
        
        <form method = "post">
            <p>	
				<label>Station de retour :</label> 
				<input type="text" name="station">
				<input type="submit" class = 'button' value="D&eacute;poser"  />
            </p>
        </form>
        
        <?php
        
        if (!empty($_POST['station'])){
			include "connect.php";
			$requete = "CALL ajout_fin_utilisation(".$_GET['id'].",".$_POST['station'].");";
			if($res = $connection->query($requete)){
				echo "<h3>v&eacute;lo d&eacute;pos&eacute; avec succ&egrave;s</h3>";
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
