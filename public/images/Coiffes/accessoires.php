<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="iso-8859-1" />
	<meta name="author" content="Patrick FAUCHEUX">
	<meta name="description" content="Karura est spécialisée dans les tenues de sport artistique :maillot de bain , justaucorps , jupette , léotard.
	Natation synchronisée , gymnastique rythmique/GRS , patinage/roller ,  gym , cirque , twirling/majorette...nous créons votre modèle adapté à vos envies./>
	<meta name="keywords" content="jupette, justaucorps, académique, vêtement, costume, sur mesure, création, maillots de bain, robe, sport, grs, gymnastique, 
	natation synchronisée, patinage, valse, cirque, twirling, marjorette, spectacle, strass, paillette, confection, fabrication, couleur, original, danse, accessoires, chair, 
	opaque, France, compétition" />
	<meta name="robots" content="index, follow" />


	<title>KARURA - Catalogue Synchro compétition</title>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="style00.css" type="text/css" />
	<link rel="stylesheet" href="cat00.css" type="text/css" />
	<script src="generique.js"></script>
	<script src="cat00.js"></script>
</head>

<body id="bdgen">
	<?php include 'catzoom.inc'; ?>
	<div id="map">
		<?php 
			$affmenu = array(2,2,3,2,2,2);
			include 'menu.inc';
			include 'fond.inc';
		?>
		<script>affNav('Mod&egrave;les & cr&eacute;ations > Coiffes'); var page='accessoires'; </script>
		<div id="zone_page">
<!-- début de contenu de page -->	
			<?php 
			$noms = array();
			$prix = array();
			
/* =============================================================================================== */
/* === ZONE A PERSONNALISER ====================================================================== */	
/* =============================================================================================== */
	
			$noms[0] = 'Blue';		$prix[0] = 10.5;
			$noms[1] = 'Cheerleader';	$prix[1] = 10.5;
			$noms[2] = 'Electrik';		$prix[2] = 10.5;
			$noms[3] = 'Funny';		$prix[3] = 10.5;
			$noms[4] = 'Kaléïdoscope';	$prix[4] = 10.5;
			$noms[5] = 'Tango';		$prix[5] = 10.5;
			$noms[6] = 'Anastasia';		$prix[6] = 10.5;
			$noms[7] = 'Raiponce';		$prix[7] = 10.5;
			$noms[8] = 'Alice';		$prix[8] = 10.5;
			$noms[9] = 'Epic';		$prix[9] = 10.5;
			$noms[10] = 'Mask';		$prix[10] = 10.5;
			$noms[11] = 'Sister act';	$prix[11] = 10.5;
			$noms[12] = 'Alesha';		$prix[12] = 10.5;
			$noms[13] = 'Cendrillon';	$prix[13] = 10.5;
			$noms[14] = 'Elsa';		$prix[14] = 10.5;
			$noms[15] = 'Explosion';	$prix[15] = 10.5;
			$noms[16] = 'Syrus';		$prix[16] = 10.5;
			$noms[17] = 'Démon';		$prix[17] = 10.5;
			$noms[18] = 'Circus';		$prix[18] = 10.5;
			$noms[19] = 'Vaudou';		$prix[19] = 10.5;
			$noms[20] = 'Modern';		$prix[20] = 10.5;
			$noms[21] = 'Bulle';		$prix[21] = 10.5;
			$noms[22] = 'Paisley';		$prix[22] = 10.5;
			$noms[23] = 'Scorpio';		$prix[23] = 10.5;
			$noms[24] = 'Mako';		$prix[24] = 10.5;
			$noms[25] = 'Sunshine';		$prix[25] = 10.5;
			$noms[26] = 'Divergente';	$prix[26] = 10.5;
			$noms[27] = 'Anna';		$prix[27] = 10.5;
			$noms[28] = 'Blue/2';		$prix[28] = 10.5;


			
			$ordre = array(12,21,8,6,27,0,28,13,1,18,17,26,2,14,9,15,3,4,24,10,20,22,7,23,11,25,16,5,19);
			
			$prefixe = 'catalogues/accessoires/accessoire coiffe-';
			$suffixe = '.jpg';
			$accessoires = 'non'; // ('oui' ou 'non')
			
/* =============================================================================================== */
/* === FIN DE PERSONNALISATION =================================================================== */
/* =============================================================================================== */
	
			include 'cat00.inc';
			?>
<!-- fin de contenu de page -->	
		</div>
	</div>
	<script>resize(); <?php if ($noms[0] > '') echo ' initCNav();'; ?> </script>
</body>

</html>