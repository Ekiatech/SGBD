 <html>
 <head>
  <title>PHP Test</title>
  <link href="style/bouttons.css" rel="stylesheet" type="text/css">
 </head>
 <body>

     <?php
     
     echo "<h2>Suppression de la base</h2>";
     
     include "base_donnees/supp_procedures.php";
     echo "Triggers, vues et procedures supprim&eacute;es<br>";
	 include "base_donnees/supp_tables.php";
     echo "Tables supprim&eacute;e<br>";
   
  ?>
  
 </body>
</html>
