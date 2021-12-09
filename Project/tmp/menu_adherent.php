<html>
	<head>
		<title>Menu adh&eacute;rent</title>
		<link href="style/bouttons.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		
		
		<div>
            <input type="button" class = 'button' onclick="window.location.href = 'https://cdeplanne001.vvvpedago.enseirb-matmeca.fr/tmp/interface.php';" value="Retour"/> 
        </div>  
		<?php echo "<h1>Adh&eacute;rent  - n&deg;".$_GET['id']." </h1>"; ?>
		
		<!-- Informations -->
		
		<form method = "post">
            <p>
				<input type="hidden" name="station" value="1">
				<input type="submit" class = 'button' value=""  />
				<label>Informations sur les v&eacute;los  et les stations</label>
            </p>
        </form>
        
        <?php
        if (!empty($_POST['station'])) {
			header("Location: https://cdeplanne001.vvvpedago.enseirb-matmeca.fr/tmp/information_adherent.php?id=".$_GET['id']);
			exit();
		}
        ?>
	
        
        <!-- Emprunter un vélo -->
		
		<form method = "post">
            <p>
				<input type="hidden" name="emprunter" value="1">
				<input type="submit" class = 'button' value=""  />
				<label>Emprunter un v&eacute;lo</label>
            </p>
        </form>
        
        <?php
        if (!empty($_POST['emprunter'])) {
			header("Location: https://cdeplanne001.vvvpedago.enseirb-matmeca.fr/tmp/emprunter_velo.php?id=".$_GET['id']);
			exit();
		}
        ?>
        
        <!-- Déposer un vélo -->
		
		<form method = "post">
            <p>
				<input type="hidden" name="deposer" value="1">
				<input type="submit" class = 'button' value=""  />
				<label>D&eacute;poser un v&eacute;lo</label>
            </p>
        </form>
        
        <?php
        if (!empty($_POST['deposer'])) {
			header("Location: https://cdeplanne001.vvvpedago.enseirb-matmeca.fr/tmp/deposer_velo.php?id=".$_GET['id']);
			exit();
		}
        ?>
        
		
		<!-- Statistiques -->
		
		<form method = "post">
            <p>
				<input type="hidden" name="stat" value="1">
				<input type="submit" class = 'button' value=""  />
				<label>Statistiques</label>
            </p>
        </form>
        
        <?php
        if (!empty($_POST['stat'])) {
			header("Location: https://cdeplanne001.vvvpedago.enseirb-matmeca.fr/tmp/statistiques.php?id=".$_GET['id']);
			exit();
		}
        ?>
        
        <!-- Profil -->
		
		<form method = "post">
            <p>
				<input type="hidden" name="distance" value="1">
				<input type="submit" class = 'button' value=""  />
				<label>Profil</label>
            </p>
        </form>
        
        <?php
        if (!empty($_POST['distance'])) {
			header("Location: https://cdeplanne001.vvvpedago.enseirb-matmeca.fr/tmp/profil.php?id=".$_GET['id']);
			exit();
		}
        ?>
        
		</body>
</html>
