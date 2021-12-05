<html>
   <head>
      <title>Page exemple</title>
   </head>
   <body>

        <!-- Bouton retour -->
        <div>
            <input type="button" onclick="window.location.href = 'https://cdeplanne001.vvvpedago.enseirb-matmeca.fr/tmp/menu_utilisateur.php';" value="Retour"/> 
        </div>  
        
        <!-- Type de la requete -->
        <div>
            <h1>Nom de la requete</h1>
        </div>
        
        <!-- Récupération des données -->
        <form method = "post">
            <p>
				<label>objectif de la requete :</label>
                <input type="text" name="nom_variable" />
                <input type="submit" value="Valider" />
            </p>
        </form>

        
        <!-- Requete -->
        <?php 
        
        if (!empty($_POST['nom_variable'])) 
        {
			echo "nom des donnees retourne";
		?>
		<table>
			<tr>
		        <th>cathegorie1</th>
		        <th>cathegorie2</th>
			</tr>

		<?php
			include "connect.php"; 	
            $requete = "requete";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($var =  $res->fetch_assoc()) {
					echo "\t".'<tr><td>'.$var['cathegorie1'].'</td>';
					echo '<td>'.$var['cathegorie2'].'</td>';
					echo '</tr>'."\n";
                }
		
             //fermeture de la connexion avec la base
             $connection->close();
        } 
        
         ?>
         </table>    
   </body>
</html>

