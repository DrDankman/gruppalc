<?php session_start();
	if(!isset($_SESSION["loginId"])){
		header("Location:/gruppalc/");
    	exit;
	} else if(isset($_GET["l"])){
		if($_GET["l"] == "logout"){
			$_SESSION = array();
		} else if($_GET["l"] == "delete"){
			include "pdo.php";
			$stmt = $pdo->prepare("DELETE FROM `login` WHERE `login`.`id` = ?");
			$stmt->execute([$_SESSION["loginId"]]);
			$_SESSION = array();
		}
		header("Location:/gruppalc/");
    	exit;
	} 
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 
	echo "<h1>Välkommen " . $_SESSION["loginUser"] . "</h1>";
	?>
	<a href="/gruppalc/update.php">Update password</a> <br>
	<a href="loggedIn.php/?l=delete">Delete me</a> <br>
	<a href="loggedIn.php/?l=logout">Log out</a> <br>
</body>
</html>