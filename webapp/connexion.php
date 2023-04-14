<!DOCTYPE html>
<html>
  <head>
    <title>CTF - Connexion</title>
    <link rel="stylesheet" href="connexion.css">
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                            session_start(); // Démarre la session
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
        <div class="title">FORMULAIRE</div>
        <div class="img"><img src="media/mask.jpg"></div>
      </section>
      
      <section class="form">
        <div class="form-title">
          FORMULAIRE DE CONNEXION
          <hr width="80%" size="2,5" color="#7C1520"/>
        </div>
        <?php
          require('config.php');

          if (isset($_POST['email'])){

            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($conn, $password);

            $email = stripslashes($_REQUEST['email']);
            $email = mysqli_real_escape_string($conn, $email);
            $_SESSION['email'] = $email;


            $query = "SELECT * FROM `users` WHERE email='$email' and password='".hash('sha256', $password)."'";
            $result = mysqli_query($conn,$query);

          
            
            if (mysqli_num_rows($result) == 1) {
              $user = mysqli_fetch_assoc($result);

              // vérifier si l'utilisateur est un administrateur ou un utilisateur
              if ($user['type'] == 'administrateur') {
                header('location: admin/compteAdmin');		  
              }else{
                header('location: compte');
              }
            }else{
              $message = "Impossible de se connecter : le nom d'utilisateur ou le mot de passe est incorrect.";
            }
          }
          ?>

          <form class="box" action="" method="post" name="login">
          <div class="div-form">
              <h1 class="box-title">Se connecter</h1>
              <?php if (! empty($message)) { ?>
                <p class="errorMessage"><?php echo $message; ?>
                </p>
              <?php } ?>
              <input type="email" class="box-input" name="email" placeholder="E-mail" required />
              <input type="password" class="box-input" name="password" placeholder="Mot de passe">
              <input type="submit" value="Connexion" name="submit" class="box-button">
              <p class="box-register">Vous êtes nouveau? <a href="inscription.php"> Inscrivez-vous!</a></p>
            </div>
          </form>
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