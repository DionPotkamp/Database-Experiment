<!DOCTYPE HTML>
<html lang="nl">
	<head>
		<link rel="stylesheet" href="../css/style.css">
		<title>Schiphol | Meldpunt Melden</title>
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
				<h1>Melding aanmaken</h1>
				
				<form class="addNotify" action="process.php" method="post">
					<label for="name">Naam</label>
						<input type="text" name="name" maxlength="50" required>
						<br><br>
					<label for="postcode">Postcode</label>
						<select name="postcode" required>
							<option value=""></option>
							<?php
							include_once('../php/functions.php');
							meldenPostcode();
							?>
						</select>
						<br><br>
					
					<label for="gender">Geslacht</label>
						<select name="gender" required>
							<option value=""></option>
							<option value="m">Man</option>
							<option value="v">Vrouw</option>
						</select>
						<br><br>
					
					<label for="bday">Geboortedatum</label>
						<input type="date" name="bday" required>
						<br><br>
					
					<label for="email">Email</label>
						<input type="email" name="email" maxlength="50" required>
						<br><br>
					
					<label for="klact">Klacht</label>
						<select name="klacht" required>
							<option value=""></option>
							<?php
							include_once('../php/functions.php');
							meldenKlachtsoort();
							?>
						</select>
						<br><br>
					
					<input type="submit" name="submit" value="Verzenden">
					<br>
				</form>				
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