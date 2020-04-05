<?php
	if(isset($_POST["submit"])){
		function validateForm($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		$name 		= validateForm($_POST["name"]);
		$postcode 	= validateForm($_POST["postcode"]);
		$gender 	= validateForm($_POST["gender"]);
		$bday 		= validateForm($_POST["bday"]);
		$email 		= validateForm($_POST["email"]);
		$klacht 	= validateForm($_POST["klacht"]);
		include_once("../php/functions.php");
		formAction($name, $postcode, $gender, $bday, $email, $klacht);
	}
?>