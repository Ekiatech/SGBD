<html>
   <head>
      <title>Page exemple</title>
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
        
        <!-- Type de la requete -->
        <div>
            <?php echo "<h1>Mes statistiques -- Adh&eacute;rent n&deg;".$_GET['id']." </h1>"; ?>
        </div>
        
        <br>
        <!-- Récupération des données -->
        
  
        <form method = "post">
            <p>
				<input type="hidden" name="kilometres" value="1">
				<input type="submit" value="" />
				<label>Nombre de kilometres r&eacute;alis&eacute; par semaine </label>
            </p>
        </form>
		
		
		<form method = "post">
            <p>
				<input type="hidden" name="heures" value="1">
				<input type="submit" value=""  />
				<label>Nombre d'heures r&eacute;alis&eacute; par semaine </label>
            </p>
        </form>
        
        <form method = "post">
            <p>
				<input type="hidden" name="stations" value="1">
				<input type="submit" value=""  />
				<label>Classement des stations les plus utilis&eacute;es </label>
            </p>
        </form>
		
		 <form method = "post">
            <p>
				<input type="hidden" name="abonnement" value="1">
				<input type="submit" value=""  />
				<label>Temps depuis votre d&eacute;but d'abonnement </label>
            </p>
        </form>
        
        <br>
		
		<!-- Requete -->



        <?php 
        
		
		if (!empty($_POST['kilometres'])) {

			echo "<h3>Distance parcouru par semaine :</h3>";
			/*
			?>
			<table>
				<tr>
					<th>ID</th>
					<th>Marque</th>
					<th>Etat</th>
				</tr>

			<?php
			include "connect.php"; 	
            $requete = "SELECT * FROM stations;";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($station =  $res->fetch_assoc()) {
					echo $station['id_station']."<br>";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
			<\table>
		*/
		}
	
		if (!empty($_POST['heures'])) {

			echo "<h3>Heures de v&eacute;los effectu&eacute;es par semaine :</h3>";
			/*
			?>
			<table>
				<tr>
					<th>ID</th>
					<th>Marque</th>
					<th>Etat</th>
				</tr>

			<?php
			include "connect.php"; 	
            $requete = "SELECT * FROM stations;";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($station =  $res->fetch_assoc()) {
					echo $station['id_station']."<br>";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
			<\table>
		*/
		}
	
	
		if (!empty($_POST['stations'])) {

			echo "<h3>Stations les plus utilis&eacute;es :</h3>";
			/*
			?>
			<table>
				<tr>
					<th>ID</th>
					<th>Marque</th>
					<th>Etat</th>
				</tr>

			<?php
			include "connect.php"; 	
            $requete = "SELECT * FROM stations;";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($station =  $res->fetch_assoc()) {
					echo $station['id_station']."<br>";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
			<\table>
		*/
		}
		
		
		if (!empty($_POST['abonnement'])) {

			echo "<h3>Dur&eacute;e de l'abonnement :</h3>";
			/*
			?>
			<table>
				<tr>
					<th>ID</th>
					<th>Marque</th>
					<th>Etat</th>
				</tr>

			<?php
			include "connect.php"; 	
            $requete = "SELECT * FROM stations;";
            // Si l'execution est reussie... 
            if($res = $connection->query($requete))
            // ... on récupère un tableau stockant le résultat 
				while ($station =  $res->fetch_assoc()) {
					echo $station['id_station']."<br>";
				}
		
             //fermeture de la connexion avec la base
             $connection->close();
			<\table>
		*/
		}
		?>
         
   </body>
</html>

