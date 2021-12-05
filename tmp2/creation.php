 <html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
   <h2>Exemple de requ&ecirc;te php MySQL</h2>
     <?php
    include "connect.php"; /* Le fichier connect.php contient les identifiants de connexion */
    /* On crée une table avec des données: */
    $creation="
           create table ACTEUR (
           NOM varchar(20) not null,
           PRENOM varchar(10) not null,
           primary key (NOM)
           );
           
           insert into ACTEUR (NOM, PRENOM) values
           ('Roth', 'Tim'),
           ('Keitel', 'Harvey');
           ";  
    /* Execution d'une requete multiple */
    $connection->multi_query($creation);

     ?>
<table>
	<tr>
		<th>Nom</th>
		<th>Pr&eacute;nom</th>
	</tr>
</table>
 </body>
</html>
