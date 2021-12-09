 <html>
 <head>
  <title>PHP Test</title>
  <link href="style/bouttons.css" rel="stylesheet" type="text/css">
 </head>
 <body>
   <h2>Cr&eacute;ation de la base</h2>
     <?php
     include "base_donnees/tables.php";
     echo "Tables cr&eacute;es<br>";
     include "base_donnees/procedures.php";
     echo "Triggers, vues et procedures cr&eacute;es<br>";
     include "base_donnees/peuplement.php";
     echo "Base peupl&eacute;e";
	?>
 </body>
</html>
