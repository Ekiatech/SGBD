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
				<input type="submit" value="Retour"  />
            </p>
        </form>
        
        <?php
        if (!empty($_POST['return'])) {
			header("Location: https://cdeplanne001.vvvpedago.enseirb-matmeca.fr/tmp/menu_utilisateur.php?id=".$_GET['id']);
			exit();
		}
        ?>
        
   </body>
</html> 
