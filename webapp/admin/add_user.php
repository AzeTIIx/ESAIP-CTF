<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../style.css" />
</head>
<body>
<?php
require('../config.php');

if (isset($_REQUEST['username'], $_REQUEST['type'], $_REQUEST['password'])){
	// récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($conn, $username); 

	// vérifier si l'utilisateur existe déjà
	$query = "SELECT * FROM `users` WHERE `username` = '$username'";
	$result = mysqli_query($conn, $query);

	if(mysqli_num_rows($result) > 0){
	   echo "<form class='box' action='' method='post'>
	<h1 class='box-logo box-title'><a href=''>ESAIP CTF</a></h1>
    <h1 class='box-title'>Add user</h1>
	<input type='text' class='box-input' name='username' placeholder='Nom d utilisateur' required />
	<div class='input-group'>
	
	<select class='box-input' name='type' id='type' >
	<option value='' disabled selected>Type</option>
	<option value='administrateur'>Admin</option>
	<option value='user'>User</option>
</select>
</div>
<input type='password' class='box-input' name='password' placeholder='Mot de passe' required />
<input type='submit' name='submit' value='+ Add' class='box-button' />
<p class='errorMessage'>L'utilisateur existe déjà</p>
</form>";


	}else{
		// récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($conn, $password);
		// récupérer le type (user | admin)
		$type = stripslashes($_REQUEST['type']);
		$type = mysqli_real_escape_string($conn, $type);

		$query = "INSERT INTO `users`(`username`, `password`, `type`) VALUES ('$username','".hash('sha256', $password)."','$type')";

		$res = mysqli_query($conn, $query);

		if($res){
		   echo "<div class='sucess'>
				 <h3>L'utilisateur a été créée avec succés.</h3>
				 <p>Cliquez <a href='home.php'>ici</a> pour retourner à la page d'accueil</p>
				 </div>";
		}
	}
}else{
?>
<form class="box" action="" method="post">
	<h1 class="box-logo box-title"><a href="">ESAIP CTF</a></h1>
    <h1 class="box-title">Add user</h1>
	<input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur" required />
	<div class="input-group">
	
	<select class="box-input" name="type" id="type" >
	<option value="" disabled selected>Type</option>
	<option value="administrateur">Admin</option>
	<option value="user">User</option>
</select>
</div>
<input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
<input type="submit" name="submit" value="+ Add" class="box-button" />
</form>
<?php } ?>
</body>
</html>