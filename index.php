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
			<form action="login.php" method="POST">
				<p>
					<label for="username">Användarnamn: </label>
					<input type="text" name="username" id="username" required>
				</p>
				<p>
					<label for="password">Lösenord: </label>
					<input type="password" name="password" id="password" required>
				</p>
				<p>
					<input type="submit" name="submit" id="submit" value="Logga in">
					<button onclick="" id="registerbutton">Registrera</button>
				</p>
			</form>
		</fieldset>
		<div id="register">   
			<fieldset>
			<legend>Registrera</legend>
			<p>
				<label for="username">Användarnamn: </label>
				<input type="text" name="username" id="username">
			</p>
			<p>
				<label for="password">Lösenord: </label>
				<input type="password" name="password" id="password">
			</p>
			<p>
				<label for="password2">Bekräfta Lösenord: </label>
				<input type="password" name="password" id="password">
			</p>
			<p>
				<label for="email">E-postadress: </label>
				<input type="text" name="email" id="email">
			</p>
			<p>
				<input type="submit" name="submit" id="submit" value="Slutför">
			</p>
		</fieldset>
		</div>
	<script src="script.js"></script>
</body>
</html>