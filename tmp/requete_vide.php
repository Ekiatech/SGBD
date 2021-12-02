<html>
   <head>
      <title>Page exemple</title>
   </head>
   <body>

        <!-- Bouton retour -->
        <div>
            <input type="button" onclick="window.location.href = 'https://cdeplanne001.vvvpedago.enseirb-matmeca.fr/tmp/menu_utilisateur.php';" value="Retour"/> 
            <!-- <input type="button" onclick="href = 'menu.php'" value="Retour"/>-->
        </div>  
        
        <!-- Type de la requete -->
        <div>
            <h1>Nom de la requete</h1>
        </div>
        
        <!-- Récupération des données -->
        <div>
            <p>
                <input type="text" name="prenom" />
                <input type="submit" value="Valider" />
            </p>
        </div>

        <?php echo $_POST['prenom']; ?>
        
        <!-- Requete -->
        <div>
            <?php
                $requete = "select * from ACTEUR";
                /* Si l'execution est reussie... */
                if($res = $connection->query($requete))
                /* ... on récupère un tableau stockant le résultat */
                    while ($acteur =  $res->fetch_assoc()) {
                    echo "\t".'<tr><td>'.$acteur['NOM'].'</td>';
                    echo '<td>'.$acteur['PRENOM'].'</td>';
                    echo '</tr>'."\n";
                    }
                /*liberation de l'objet requete:*/
                //$res->free();
                /*fermeture de la connexion avec la base*/
                $connection->close();
            ?>
        </div>    
   </body>
</html>

