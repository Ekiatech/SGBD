<html>
   <head>
      <title>Interface</title>
      <meta http-equiv="content-type" content="text/html;charset=utf-8">
		<link href="style/bouttons.css" rel="stylesheet" type="text/css">
   </head>
   <body>

 
   
		<form method = "post">
            <p>
				     <input type="button" class = 'button' onclick="window.location.href = 'https://cdeplanne001.vvvpedago.enseirb-matmeca.fr/tmp/connexion.php';" value="Adh&eacute;rent">
      <input type="button" class = 'button' onclick="window.location.href = 'https://cdeplanne001.vvvpedago.enseirb-matmeca.fr/tmp/menu_administrateur.php';" value="Administrateur">
				<input type="hidden" name="restore" value="1">
				<input type="submit" class = 'button' value="Restaurer la base"  />
            </p>
        </form>
        
        <?php
        if (!empty($_POST['restore'])) {
			include "base_donnees/supp_procedures.php";
			sleep(1);
			include "base_donnees/supp_tables.php";	
			sleep(1);
			include "base_donnees/tables.php";
			sleep(1);
			include "base_donnees/procedures.php";   
			sleep(1);
			include "base_donnees/peuplement.php";
			echo "<h2>Base restaur&eacute;e</h2>";
		}
        ?>
   
   </body>
</html> 

