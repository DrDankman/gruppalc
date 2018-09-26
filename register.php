<?php 

	include "pdo.php";

	


	$stmt = $pdo->prepare("INSERT INTO login (username, email, password) VALUES (:username, :email, :password)");
	$stmt->bindParam(':username', $username);
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':password', $password);

	if($_POST["password"] == $_POST["password2"])
		$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
	else
		echo "Öppna register saken med du skrev fel lösen";

	$username = $_POST["username"];
	$email = $_POST["email"];

	$stmt->execute();


	print_r($_POST, 0);


?>