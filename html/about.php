<!DOCTYPE HTML>
<html lang="nl">
	<head>
		<link rel="stylesheet" href="../css/style.css">
		<title>Schiphol | Meldpunt Over ons</title>
		<meta charset="utf-8">
		<link rel="icon" href="../favicon.ico">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<!--neem eens een kijkje op de site van schiphol zelf...-->
		<nav>
			<ul>
				<li><a class="title" href="../index.php">Schiphol</a></li>
				<li><a class="aUnderline" href="formulier.php">Melden</a></li>
				<li><a class="aUnderline" href="overzicht.php">Overzicht</a></li>
				<li><a class="aUnderline" href="about.php">Over Ons</a></li>
			</ul>
		</nav>
		<main>
			<div class="moo">
				<h1>Over Ons</h1>
				<p>
					We doen elke dag ons uiterste best om van u een tevreden omwonende te maken. <br>
					Heeft u onverhoopt toch een klacht over geluidsoverlast, millieuoverlast of veiligheid? <br> 
					Dan kunt u ons meldpunt gebruiken om uw klacht te melden.<br><br>
					<span class="offset">
						Komt u er niet uit of meld u toch liever uw klacht via de telefoon?<br>
						Bel dan: <a href="tel:0207940800">020 794 0800</a>
					</span>
				</p>
				<p>
					U kunt een melding maken van overlast als u op één van de volgende postcodes woont: <br>
					<?php
					include_once('../php/functions.php');
					overOnsPostcode();
					?>
				</p>
			</div>
			<ul class="wrapper">
				<a class="cardLink" href="overzicht.php">
					<li class="card">
						<img class="cardImg" src="../images/overview.png">
						<div class="cardtext">
							<p class="cardkop under1">Overzicht</p>
							Bekijk hier welke meldingen al gemaakt zijn
						</div>
					</li>
				</a>
				<a class="cardLink" href="about.php">
					<li class="card">
						<img class="cardImg" src="../images/about.png">
						<div class="cardtext">
							<p class="cardkop under2">Over ons</p>
							Lees hier meer over ons
						</div>
					</li>
				</a>
				<a class="cardLink" href="formulier.php">
					<li class="card">
						<img class="cardImg" src="../images/notify.png">
						<div class="cardtext">
							<p class="cardkop under3">Melding aanmaken</p>
							Een melding kunt u hier achterlaten
						</div>
					</li>
				</a>
			</ul>
		</main>
		<footer>
		</footer>
	</body>
</html>