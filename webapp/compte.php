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
        <meta charset="utf-8">
        <title>CTF - Compte</title>
        <link rel="stylesheet" href="compte.css">
    </head>

    <body>
        <script>
            function showResponsiveMenu() {
                var menu = document.getElementById("topnav_responsive_menu");
                var icon = document.getElementById("topnav_hamburger_icon");
                var root = document.getElementById("root");
                if (menu.className === "") {
                  menu.className = "open";
                  icon.className = "open";
                  root.style.overflowY = "hidden";
                } else {
                  menu.className = "";                    
                  icon.className = "";
                  root.style.overflowY = "";
                }
              }
        </script>

        <header>  
            <div id="root">
                <div id="topnav" class="topnav">
                    <div class="logo">
                    <a id="home_link" href="accueil.php"> <img src="media/logo.png" class="logo"> </a>
                    </div>
                    
                    <?php
                        function is_connected() {
                            if(isset($_SESSION['email']) && isset($_SESSION['password'])) { // Vérifie si l'email de l'utilisateur est présent dans la session
                                return true;
                            }
                            else {
                                return false;
                            }
                        }
                        
                        if(is_connected()) { ?>
                            <!-- Classic Menu -->
                            <nav role="navigation" id="topnav_menu">
                                <ul>
                                    <li><a class="topnav_link" href="accueil.php">ACCUEIL</a></li>
                                    <li><a class="topnav_link" href="challenge.php">CHALLENGE</a></li>
                                    <li><a class="topnav_link" href="score.php">SCORE</a></li>
                                    <li class="cpt"><a class="topnav_link" href="compte.php">
                                        <?php
                                            require('config.php');
                                            $email = $_SESSION['email'];
                                            $queryUsername = "SELECT `username` FROM `users` WHERE email='$email'";
                                            $result = mysqli_query($conn, $queryUsername);
                                            $row = mysqli_fetch_assoc($result);
                                            $username = $row['username'];
                                            echo $username;
                                        ?> </a></li>
                                </ul>
                            </nav>

                            <a id="topnav_hamburger_icon" href="javascript:void(0);" onclick="showResponsiveMenu()">
                            <!-- Some spans to act as a hamburger -->
                            <span></span>
                            <span></span>
                            <span></span>
                            </a>

                            <!-- Responsive Menu -->
                            <nav role="navigation" id="topnav_responsive_menu">
                                <ul>
                                    <li><a class="topnav_link" href="accueil.php">ACCUEIL</a></li>
                                    <li><a class="topnav_link" href="challenge.php">CHALLENGE</a></li>
                                    <li><a class="topnav_link" href="score.php">SCORE</a></li>
                                    <li class="cpt"><a class="topnav_link" href="compte.php">
                                        <?php echo $username; ?> </a></li>
                                </ul>
                            </nav>
                        <?php }
                        else{ ?>
                            <!-- Classic Menu -->
                            <nav role="navigation" id="topnav_menu">
                                <ul>
                                    <li><a class="topnav_link" href="accueil.php">ACCUEIL</a></li>
                                    <li><a class="topnav_link" href="challenge.php">CHALLENGE</a></li>
                                    <li><a class="topnav_link" href="score.php">SCORE</a></li>
                                    <li class="login"><a class="topnav_link" href="connexion.php">SE CONNECTER</a></li>
                                </ul>
                            </nav>

                            <a id="topnav_hamburger_icon" href="javascript:void(0);" onclick="showResponsiveMenu()">
                            <!-- Some spans to act as a hamburger -->
                            <span></span>
                            <span></span>
                            <span></span>
                            </a>

                            <!-- Responsive Menu -->
                            <nav role="navigation" id="topnav_responsive_menu">
                                <ul>
                                    <li><a class="topnav_link" href="accueil.php">ACCUEIL</a></li>
                                    <li><a class="topnav_link" href="challenge.php">CHALLENGE</a></li>
                                    <li><a class="topnav_link" href="score.php">SCORE</a></li>
                                    <li class="login"><a class="topnav_link" href="connexion.php">SE CONNECTER</a></li>
                                </ul>
                            </nav>
                        <?php }
                    ?>
                </div>
            </div>
        </header>

        <article class="corpus">
            <section class="pic">
                <div class="img"><img src="media/mask.jpg"></div>
            </section>
            <section class="msg">
                <div class="msg-title">
                    MON COMPTE
                    <hr width="80%" size="2,5" color="#7C1520"/>
                </div>

                <div class="box">
					<h1>Bienvenue <?php
                    require('config.php');
                    $email = $_SESSION['email'];
                    $queryUsername = "SELECT `username` FROM `users` WHERE email='$email'";
                    $result = mysqli_query($conn, $queryUsername);
                    $row = mysqli_fetch_assoc($result);
                    $username = $row['username'];
                    echo $username; ?>!</h1>
					<p>Voici votre espace utilisateur.</p>
					<br><a href="logout.php">Déconnexion</a>
					<a href="score.php">Score</a>
				</div>
            
            </section>
        </article>

        <footer>
            <section class="ft">
                <div class="info">
                <div class="t-info">
                    <div class="f-title">Lien rapide</div>
                    <div class="f-txt">
                    <a href="accueil.php">accueil</a>
                    <br><a href="challenge.php">challenge</a>
                    <br>github
                    </div>
                </div>
                <div class="t-info">
                    <div class="f-title">Information</div>
                    <div class="f-txt"></div>
                </div>
                <div class="t-info">
                    <div class="f-title">Contact</div>
                    <div class="f-txt">
                    E-mail : créer mail
                    </div>
                </div>
                </div>
                <div class="f-txt2">
                Copyright © 2023 - ESAIP - Tout droit réservé.
                </div>
            </section>
        </footer>
    </body>
</html>