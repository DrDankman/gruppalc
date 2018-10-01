<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Josefin+Slab" rel="stylesheet" type="text/css">
	<link href="style.css" rel="stylesheet" type="text/css">
	<meta charset="utf-8">
	<title>Login</title>
</head>
<body>
		<fieldset>
			<legend>Logga in</legend>
			<form action="index.php" method="POST">
				<p>
					<label for="username">Användarnamn: </label>
					<input type="text" name="username" id="username" required>
				</p>
				<p>
					<label for="password">Lösenord: </label>
					<input type="password" name="password" id="password" required>
				</p>
				<p>
					<input type="submit" name="login" id="submit" value="Logga in">
				</p>
			</form>
				<button onclick="" id="registerbutton">Registrera</button>
		</fieldset>
		<div id="register">   
			<fieldset>
				<legend>Registrera</legend>
				<form action="index.php" method="POST">
					<p>
						<label for="username">Användarnamn: </label>
						<input type="text" name="username" id="username" required>
					</p>
					<p>
						<label for="password">Lösenord: </label>
						<input type="password" name="password" id="password" required>
					</p>
					<p>
						<label for="password2">Bekräfta Lösenord: </label>
						<input type="password" name="password2" id="password2" required>
					</p>
					<p>
						<label for="email">E-postadress: </label>
						<input type="text" name="email" id="email" required>
					</p>
					<p>
						<input type="submit" name="register" id="submit" value="Slutför">
					</p>
				</form>
			</fieldset>
		</div>
	<script src="script.js"></script>

	<?php
	if(isset($_POST['login']))
		login();
	else if(isset($_POST['register']))
		register();


	function login(){
		// tänk på att få upp en pdo_example.php utan uppgifterna på git
		include 'pdo.php';
		// skulle kunna använda filter_val regexp här med?
		$username = preg_replace("/[^a-zA-Z0-9]+/", "", $_POST["username"]);
	 	$statement = $pdo -> query('SELECT * FROM login WHERE username = "' . $username .'"');
	 	$row = $statement -> fetch(PDO::FETCH_ASSOC);
	 	$password = $row['password'];
		if(isset($_POST['password']) && isset($password)){
			if(password_verify($_POST['password'],$password)){
				$_SESSION["loginId"] = $row["id"];
				$_SESSION["loginUser"] = $row["username"];
				header("Location: loggedIn.php");
    			exit;
			} else{
				echo "Wrong password or username";
			}
		}
		else{
			echo "Wrong password or username";
		}
		
	}

	function register(){

		if($_POST["password"] == $_POST["password2"])
			$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
		else{
			$message = "Lösenorden matchade ej";
			echo "<script type='text/javascript'>alert('$message');</script>";
			unset($_POST["register"]);
			return;
		}

		if(filter_var($_POST["username"], FILTER_VALIDATE_REGEXP,
		   array("options"=>array("regexp"=>"/[^a-zA-Z0-9]+/")))){
			$message = "Okorekt användarnamn"; // otillåtet, använd enbart xyz123
			echo "<script type='text/javascript'>alert('$message');</script>";
			unset($_POST["register"]);
			return;
		}
		// kanske inte den mest läsbara koden då du kör return för att avsluta funktionen och sen kör den vidare.
		// men det har lite med funktions/metod -design att göra, de bör bara göra en sak
		$username = $_POST["username"];

		if($email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL));
		else{
			$message = "Okorekt email";
			echo "<script type='text/javascript'>alert('$message');</script>";
			unset($_POST["register"]);
			return;
		}
		// sql delen kan lika gärna flyttas till efter validering
		include "pdo.php";

		$stmt = $pdo->prepare("INSERT INTO login (username, email, password) VALUES (:username, :email, :password)");
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':password', $password);
		$stmt->execute();

	}
?>
</body>
</html>
