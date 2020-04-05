<?php
//maak connectie met de schiphol database
function connect() {
	
	$host = "localhost";
	$name = "schiphol";
	$user = "root";
	$password = "";
	try{
		$database = new PDO("mysql:host=$host;dbname=$name", $user, $password);
		$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $database;
	} catch(PDOExeption $e) {
		echo $e->getMessage();
	}
}
function formAction($name, $postcode, $gender, $bday, $email, $klacht) {
	$database = connect();
	//vergelijken of naam uniek is
	$query = "SELECT ID FROM gebruiker WHERE naam = :naam";
	$testname = $database->prepare($query);
	try {
		$testname->execute(array("naam"=>"$name"));
		$testname->setFetchMode(PDO::FETCH_ASSOC);
		$num_rows = $testname->fetchColumn();
		if($num_rows == 0) {
			$query = "INSERT INTO gebruiker(naam, ID_postcode, geslacht, geboortedatum, email) 
			VALUES(:naam, :ID_postcode, :geslacht, :geboortedatum, :email)";
			$insert = $database->prepare($query);
			$data = array("naam"=>"$name", "ID_postcode"=>"$postcode", "geslacht"=>"$gender", "geboortedatum"=>"$bday", "email"=>"$email");	
			try {
				$insert->execute($data);
				$succeedklant = true;
			}catch(PDOExeption $e) {
				$succeedklant = false;
			}
			if($succeedklant) {
				$last_id = $database->lastInsertId();
				$query = "INSERT INTO klacht(ID_gebruiker, ID_klachtsoort, ID_postcode) 
				VALUES(:ID_gebruiker, :ID_klachtsoort, :ID_postcode)";
				$insert = $database->prepare($query);
				$data = array("ID_gebruiker"=>"$last_id", "ID_klachtsoort"=>"$klacht", "ID_postcode"=>"$postcode");	
				try {
					$insert->execute($data);
					if($insert) {
						echo "	
							<script>
								alert('Uw melding is toegevoegd. U word doorgestuurd naar de overzicht pagina.');
								location.href=index.php					</script>";
					}
				}catch(PDOExeption $e) {
					echo $e;
				}
			}
		} elseif($num_rows > 0) {
			$id = $num_rows;
			$query = "INSERT INTO klacht(ID_gebruiker, ID_klachtsoort, ID_postcode) 
			VALUES(:ID_gebruiker, :ID_klachtsoort, :ID_postcode)";
			$insert = $database->prepare($query);
			$data = array("ID_gebruiker"=>"$id", "ID_klachtsoort"=>"$klacht", "ID_postcode"=>"$postcode");	
			try {
				$insert->execute($data);
				echo "	
					<script>
						alert('Uw melding is toegevoegd. U word doorgestuurd naar de overzicht pagina.');
						location.href='index.php';
					</script>";
			}catch(PDOExeption $e) {
				echo $e;
			}
		} else {
			echo "Ongeldig ID";
		}
	} catch(PDOExeption $e) {
		echo $e;
	}
	$database = NULL;
}
function overzichtTabel() {
	$database = connect();
	$query = "SELECT * FROM overzicht_tabel";
	$overzicht = $database->prepare($query);
		try {
			$overzicht->execute(array());
			$overzicht->setFetchMode(PDO::FETCH_ASSOC);
			echo '
			<tr>
				<th>Nr</th>
				<th>Postcode</th> 
				<th>Datum</th>
				<th>Tijd</th>
				<th>Soort</th>
			</tr>
			';
			foreach($overzicht as $overzicht) {
				$date= date_create($overzicht["Datum"]);
				$datum = date_format($date,"Y - m - d");
				$tijd = date_format($date," H:i ");
				echo '
				<tr>
					<td>' . $overzicht["Nr"] . '</td>
					<td>' . $overzicht["Postcode"] . '</td> 
					<td>' . $datum . '</td>
					<td>' . $tijd . '</td>
					<td>' . $overzicht["Soort"] . '</td>
				</tr>';
			}
		} catch(PDOExeption $e) {
			echo $e->getMessage();
		}
	$database = NULL;
}
function overzichtTotaal() {
	$database = connect();
	$query = "CALL overzicht_totaal";
	$totaal = $database->prepare($query);
		try {
			$totaal->execute(array());
			$totaal->setFetchMode(PDO::FETCH_ASSOC);
			foreach($totaal as $totaal) {
				echo 'Totaal aantal klachten over ' . $totaal["klacht"] . ' : ' . $totaal["aantal"] . '<br>';
			}
		} catch(PDOExeption $e) {
			echo $e->getMessage();
		}
	$database = NULL;
}
function overOnsPostcode() {
	$database = connect();
	$query = "CALL over_ons_postcode()";
	$overzicht = $database->prepare($query);
		try {
			$overzicht->execute(array());
			$overzicht->setFetchMode(PDO::FETCH_ASSOC);
			foreach($overzicht as $postcode) {
				echo strtoupper($postcode["postcode"]) . '<br>';
			}
		} catch(PDOExeption $e) {
			echo $e->getMessage();
		}
	$database = NULL;
}
function meldenPostcode() {
	$database = connect();
	$query = "CALL melden_postcode";
	$postcode = $database->prepare($query);
		try {
			$postcode->execute(array());
			$postcode->setFetchMode(PDO::FETCH_ASSOC);
			$index = 1;
			foreach($postcode as $postcode) {
				echo '
				<option value="' . $index . '">' . strtoupper($postcode["postcode"]) . '</option>';
				$index++;
			}
		} catch(PDOExeption $e) {
			echo $e->getMessage();
		}
	$database = NULL;
}
function meldenKlachtsoort() {
	$database = connect();
	$query = "CALL melden_klachtsoort";
	$klacht = $database->prepare($query);
		try {
			$klacht->execute(array());
			$klacht->setFetchMode(PDO::FETCH_ASSOC);
			$index = 1;
			foreach($klacht as $klacht) {
				echo '
				<option value="' . $index . '">' . ucwords($klacht["klachtsoort"]) . '</option>';
				$index++;
			}
		} catch(PDOExeption $e) {
			echo $e->getMessage();
		}
	$database = NULL;
}
?>