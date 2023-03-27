<?php
	// Initialiser la session
	session_start();
	// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
	if(!isset($_SESSION["email"])){
		header("Location: login.php");
		exit(); 
	}
?>
<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="../style.css" />
	</head>
	<body>
		<div class="sucess">
		<h1>Bienvenue 	
		<?php 
			require('../config.php');
			$email = $_SESSION['email'];
			$queryUsername = "SELECT `username` FROM `users` WHERE email='$email'";
			$result = mysqli_query($conn, $queryUsername);
			$row = mysqli_fetch_assoc($result);
			$username = $row['username'];
			echo $username;
		?>!</h1>
		<p>C'est votre espace admin.</p>
		<a href="add_user.php">Add user</a> | 
		<a href="#">Update user</a> | 
		<a href="#">Delete user</a> | 
		<a href="../logout.php">Déconnexion</a>
		</ul>
		</div>
	</body>
</html>