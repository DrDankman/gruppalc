<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST">
		<p>
			<label for="oldPass">Gammalt lösenord</label>
			<input type="password" name="oldPass" id="oldPass" required>
		</p>
		<p>
			<label for="newPass">Nytt lösenord</label>
			<input type="password" name="newPass" id="newPass" required>
		</p>
		<p>
			<label for="newPassC">Upprepa nytt lösenord</label>
			<input type="password" name="newPassC" id="newPassC" required>
		</p>
		<p>
			<input type="submit" name="submit" value="Klar" required>
		</p>
	</form>

	<?php 

		if(isset($_POST["submit"])){
			include "pdo.php";

			$statement = $pdo -> query('SELECT password FROM login WHERE username = "' . $_SESSION["loginUser"] .'"');
		 	$row = $statement -> fetch(PDO::FETCH_ASSOC);
		 	$password = $row['password'];


		 	if(password_verify($_POST["oldPass"],$password)){

				$stmt = $pdo->prepare('UPDATE login SET password=? WHERE id=' . $_SESSION["loginId"]);
				if($_POST["newPass"] == $_POST["newPassC"])
					$pass = password_hash($_POST["newPass"], PASSWORD_DEFAULT);
				else{
					$message = "Lösenorden matchade ej";
					echo "<script type='text/javascript'>alert('$message');</script>";
					unset($_POST["register"]);
					return;
				}

				$stmt->execute([$pass]);

				header("Location:/gruppalc/loggedIn.php");
    			exit;
			}
		}

	 ?>
</body>
</html>