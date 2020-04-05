<!DOCTYPE HTML>
<html lang="nl">
	<head>
		<link rel="stylesheet" href="../css/style.css">
		<title>Schiphol | Meldpunt Overzicht</title>
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
				<h1>Overzicht Schiphol Meldpunt</h1>
				<p>
					Hier vind u een overzicht met de tot nu toe ingediende meldingen.<br>
					<i>Gerangschikt op postcode, datum en tijd.</i>
				</p>
				<span class="overzichtTabel">
					<table>
						<?php
						include_once("../php/functions.php");
						overzichtTabel();
						?>
					</table>
					<p id="total">
						<?php
						include_once('../php/functions.php');
						overzichtTotaal();
						?>
					</p>
				</span>
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
							Een melding kun u hier achterlaten
						</div>
					</li>
				</a>
			</ul>
		</main>
		<footer>
		</footer>
	</body>
</html>