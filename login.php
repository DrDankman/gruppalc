<?php

	if(isset($_POST['submit'])){
	include 'pdo.php';
	$username = preg_replace("/[^a-zA-Z0-9]+/", "", $_POST["username"]);
 	$statement = $pdo -> query('SELECT password FROM login WHERE username = "' . $username .'"');
 	$row = $statement -> fetch(PDO::FETCH_ASSOC);
 	$password = $row['password'];

		if(isset($_POST['password']) && isset($password)){
			if(password_verify($_POST['password'],$password)){
				echo "Welcome";
			} else{
				echo "Wrong password or username";
			}
		}
		else{
				echo "Wrong password or username";
			}
}
?>