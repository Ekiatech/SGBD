<html>
	<head>
		<title>Menu adh&eacute;rent</title>
	</head>
	<body>
		
		
		<div>
            <input type="button" onclick="window.location.href = 'https://cdeplanne001.vvvpedago.enseirb-matmeca.fr/tmp/interface.php';" value="Retour"/> 
        </div>  
		<?php echo "<h1>Adh&eacute;rent  - n&deg;".$_GET['id']." </h1>"; ?>
		
		<!-- Listes des vélos  présent à une station -->
		
		<form method = "post">
            <p>
				<input type="hidden" name="station" value="1">
				<input type="submit" value=""  />
				<label>Informations sur les v&eacute;los  pr&eacute;sent &agrave; une station</label>
            </p>
        </form>
        
        <?php
        if (!empty($_POST['station'])) {
			header("Location: https://cdeplanne001.vvvpedago.enseirb-matmeca.fr/tmp/velos_station.php?id=".$_GET['id']);
			exit();
		}
        ?>
		
		<!-- Listes des stations dans une commune -->
		
		<form method = "post">
            <p>
				<input type="hidden" name="commune" value="1">
				<input type="submit" value=""  />
				<label>Listes des stations  pr&eacute;sentes dans une commune</label>
            </p>
        </form>
        
        <?php
        if (!empty($_POST['commune'])) {
			header("Location: https://cdeplanne001.vvvpedago.enseirb-matmeca.fr/tmp/station_commune.php?id=".$_GET['id']);
			exit();
		}
        ?>
        
        
        <!-- Distance entre deux stations -->
		
		<form method = "post">
            <p>
				<input type="hidden" name="distance" value="1">
				<input type="submit" value=""  />
				<label>Distance entre deux stations</label>
            </p>
        </form>
        
        <?php
        if (!empty($_POST['distance'])) {
			header("Location: https://cdeplanne001.vvvpedago.enseirb-matmeca.fr/tmp/distance.php?id=".$_GET['id']);
			exit();
		}
        ?>
        
        <!-- Emprunter un vélo -->
		
		<form method = "post">
            <p>
				<input type="hidden" name="emprunter" value="1">
				<input type="submit" value=""  />
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
				<input type="submit" value=""  />
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
				<input type="submit" value=""  />
				<label>Statistiques</label>
            </p>
        </form>
        
        <?php
        if (!empty($_POST['stat'])) {
			header("Location: https://cdeplanne001.vvvpedago.enseirb-matmeca.fr/tmp/statistiques.php?id=".$_GET['id']);
			exit();
		}
        ?>
		</body>
</html>
