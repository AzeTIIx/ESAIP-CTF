<!DOCTYPE html>
<html>
  <head>
    <title>CTF - Inscription</title>
    <link rel="stylesheet" href="inscription.css">
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
                    <a id="home_link" href="accueil"> <img src="media/logo.png" class="logo"> </a>
                    </div>
                    <!-- Classic Menu -->
                    <nav role="navigation" id="topnav_menu">
                    <?php
                        session_start();
                        if(!isset($_SESSION["email"])) { ?>
                            <ul>
                                <li><a class="topnav_link" href="accueil">ACCUEIL</a></li>
                                <li><a class="topnav_link" href="challenge">CHALLENGE</a></li>
                                <li><a class="topnav_link" href="score">SCORE</a></li>
                                <li class="login"><a class="topnav_link" href="connexion">SE CONNECTER</a></li>
                                </a></li>
                            </ul>
                        <?php }
                        else{ ?>
                            <ul>
                                <li><a class="topnav_link" href="accueil">ACCUEIL</a></li>
                                <li><a class="topnav_link" href="challenge">CHALLENGE</a></li>
                                <li><a class="topnav_link" href="score">SCORE</a></li>
                                <li class="cpt"><a class="topnav_link" href="compte">
                                    <?php
                                        require('config.php');
                                        $email = $_SESSION['email'];
                                        $queryUsername = "SELECT `username` FROM `users` WHERE email='$email'";
                                        $result = mysqli_query($conn, $queryUsername);
                                        $row = mysqli_fetch_assoc($result);
                                        $username = $row['username'];
                                        echo $username;
                                    ?>
                                </a></li>
                            </ul>
                        </nav>
                        <?php }
                    ?>
                
                    <a id="topnav_hamburger_icon" href="javascript:void(0);" onclick="showResponsiveMenu()">
                    <!-- Some spans to act as a hamburger -->
                    <span></span>
                    <span></span>
                    <span></span>
                    </a>
                
                    <!-- Responsive Menu -->
                    <nav role="navigation" id="topnav_responsive_menu">
            
                    <?php
                        if(!isset($_SESSION["email"])) { ?>
                            <ul>
                                <li><a class="topnav_link" href="accueil">ACCUEIL</a></li>
                                <li><a class="topnav_link" href="challenge">CHALLENGE</a></li>
                                <li><a class="topnav_link" href="score">SCORE</a></li>
                                <li class="login"><a class="topnav_link" href="connexion">SE CONNECTER</a></li>
                                </a></li>
                            </ul>
                        <?php }
                        else{ ?>
                            <ul>
                                <li><a class="topnav_link" href="accueil">ACCUEIL</a></li>
                                <li><a class="topnav_link" href="challenge">CHALLENGE</a></li>
                                <li><a class="topnav_link" href="score">SCORE</a></li>
                                <li class="cpt"><a class="topnav_link" href="compte">
                                    <?php
                                        echo $username;
                                    ?>
                                </a></li>
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
          FORMULAIRE D'INSCRIPTION
          <hr width="80%" size="2,5" color="#7C1520"/>
        </div>
        <?php
            require('config.php');

            if (isset($_REQUEST['username'], $_REQUEST['password'], $_REQUEST['email'])){
                // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
                $username = stripslashes($_REQUEST['username']);
                $username = mysqli_real_escape_string($conn, $username); 
                
                // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
                $password = stripslashes($_REQUEST['password']);
                $password = mysqli_real_escape_string($conn, $password);
            
                // récupérer l'email 
                $email = stripslashes($_REQUEST['email']);
                $email = mysqli_real_escape_string($conn, $email);

                // Vérifiez si le nom d'utilisateur existe déjà dans la base de données
                $check_query_name = "SELECT * FROM `users` WHERE `username` = '$username'";
                $check_result_name = mysqli_query($conn, $check_query_name);
                
                $check_query_email = "SELECT * FROM `users` WHERE `email` = '$email'";
                $check_result_email = mysqli_query($conn, $check_query_email);

                if (mysqli_num_rows($check_result_name) > 0) {

                    echo "
                    <form class='box' action='' method='post'>
                      <div class='div-form'>
                        <h1 class='box-title'>S'inscrire</h1>
                        <p class='errorMessage'>Impossible de s'inscrire : le nom d'utilisateur est déjà pris.</p>
                        <input type='email' class='box-input' name='email' placeholder='E-mail' required />
                        <input type='text' class='box-input' name='username' placeholder='Nom d utilisateur' required />
                        <input type='password' class='box-input' name='password' placeholder='Mot de passe' required />
                        <input type='submit' name='submit' value='Inscription' class='box-button' />
                        <p class='box-register'>Vous êtes déjà inscrit? <a href='login.php'>Connectez-vous!</a></p>
                      </div>
                    </form> ";

                            
                } elseif(mysqli_num_rows($check_result_email) > 0){
                    echo "
                    <form class='box' action='' method='post'>
                      <div class='div-form'>
                        <h1 class='box-title'>S'inscrire</h1>
                        <p class='errorMessage'>Impossible de s'inscrire : l'e-mail est déjà pris.</p>
                        <input type='email' class='box-input' name='email' placeholder='E-mail' required />
                        <input type='text' class='box-input' name='username' placeholder='Nom d utilisateur' required />
                        <input type='password' class='box-input' name='password' placeholder='Mot de passe' required />
                        <input type='submit' name='submit' value='Inscription' class='box-button' />
                        <p class='box-register'>Vous êtes déjà inscrit? <a href='login.php'>Connectez-vous!</a></p>
                      </div>
                    </form> ";
                }
                
                else {
                    // Insérez les données dans la base de données
                    $query = "INSERT INTO `users`(`email`,`username`, `password`, `type`) VALUES ('$email','$username','".hash('sha256', $password)."','user')";
                    $res = mysqli_query($conn, $query);
                    if($res){
                        echo "<div class='box'>
                              <h3>Vous êtes inscrit avec succès ! </h3>
                              <p>Cliquez <b><a href='connexion'>ici</a></b> pour vous connecter.</p>
                            </div>";
                    }
                }
            }else{
            ?>
            <form class="box" action="" method="post">
              <div class="div-form">
                <h1 class="box-title">S'inscrire</h1>
                <input type="email" class="box-input" name="email" placeholder="E-mail" required />
                <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur" required />
                <input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
                <input type="submit" name="submit" value="Inscription" class="box-button" />
                <p class="box-register">Vous êtes déjà inscrit? <a href="connexion">Connectez-vous!</a></p>
              </div>
            </form>
            <?php } ?>
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
              <a href="accueil">accueil</a>
              <br><a href="challenge">challenge</a>
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