<?php
	
	include "pdo.php";
	print_r($pdo, 0);

	$username = $_POST["username"];

	$statement = $pdo->query('SELECT password FROM login WHERE username = "'$username'"');
	$row = $statement->fetch(PDO::FETCH_ASSOC);

	if(password_match($_POST["password"], $row["password"])){
		echo "string";
	}
	print_r($row , 0);

?>