<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CTF - Challenge</title>
    <link rel="stylesheet" href="challenge.css">
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
            <a id="home_link" href="accueil.php">
              <img src="media/logo.png" class="logo">
            </a>
          </div> <?php
                        session_start();
                        if(!isset($_SESSION["email"])) { ?>
          <!-- Classic Menu -->
          <nav role="navigation" id="topnav_menu">
            <ul>
              <li>
                <a class="topnav_link" href="accueil.php">ACCUEIL</a>
              </li>
              <li>
                <a class="topnav_link" href="challenge.php">CHALLENGE</a>
              </li>
              <li>
                <a class="topnav_link" href="score.php">SCORE</a>
              </li>
              <li class="login">
                <a class="topnav_link" href="connexion.php">SE CONNECTER</a>
              </li>
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
              <li>
                <a class="topnav_link" href="accueil.php">ACCUEIL</a>
              </li>
              <li>
                <a class="topnav_link" href="challenge.php">CHALLENGE</a>
              </li>
              <li>
                <a class="topnav_link" href="score.php">SCORE</a>
              </li>
              <li class="login">
                <a class="topnav_link" href="connexion.php">SE CONNECTER</a>
              </li>
              </a>
              </li>
            </ul>
          </nav> <?php }
                        else{ ?>
          <!-- Classic Menu -->
          <nav role="navigation" id="topnav_menu">
            <ul>
              <li>
                <a class="topnav_link" href="accueil.php">ACCUEIL</a>
              </li>
              <li>
                <a class="topnav_link" href="challenge.php">CHALLENGE</a>
              </li>
              <li>
                <a class="topnav_link" href="score.php">SCORE</a>
              </li>
              <li class="cpt">
                <a class="topnav_link" href="compte.php">
                    <?php
                        require('config.php');
                        $email = $_SESSION['email'];
                        $queryUsername = "SELECT `username` FROM `users` WHERE email='$email'";
                        $result = mysqli_query($conn, $queryUsername);
                        $row = mysqli_fetch_assoc($result);
                        $username = $row['username'];
                        echo $username;
                    ?> </a>
              </li>
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
              <li>
                <a class="topnav_link" href="accueil.php">ACCUEIL</a>
              </li>
              <li>
                <a class="topnav_link" href="challenge.php">CHALLENGE</a>
              </li>
              <li>
                <a class="topnav_link" href="score.php">SCORE</a>
              </li>
              <li class="cpt">
                <a class="topnav_link" href="compte.php"> <?php echo $username; ?> </a>
              </li>
            </ul>
          </nav> <?php }
                    ?>
        </div>
      </div>
    </header>


    <!--Recuperation de l'id du user-->
    <?php
        $queryuser= "SELECT `id_user` FROM `users` WHERE `username` = '$username'";
        $resultuser = mysqli_query($conn, $queryuser);
        $rowuser = mysqli_fetch_assoc($resultuser); // Fetch the result as an associative array
        $user_id = $rowuser['id_user'];
    ?>

    <!--les articles entourent un bloc de contenu (une unité)-->
    <!--les sections servent à contenir une partie isolée de la page (une fonctionnalité)-->
    <article class="corpus">
      <section class="pic">
        <div class="title">CHALLENGE</div>
        <div class="img">
          <img src="media/mask.jpg">
        </div>
      </section>
      <section class="msg">
        <div class="msg-title"> Cryptanalyse
          <hr width="80%" size="2,5" color="#7C1520" />
        </div>
        <div class="c-box">
          <a href="Challenge1.php" class="link">
            <div id="c-article">
              <div class="num">01</div>
              <div class="c-title">Trop Haché</div>
                <?php
                    $querycheckchallenge = "SELECT `status` FROM `submissions`
                    LEFT JOIN `users` ON user_id =`id_user`
                    LEFT JOIN `challenges` ON `challenge_id`=`id_challenge`
                    WHERE `name` ='Trop hache' AND `user_id`='$user_id';";
                    $resultcheckchallenge = mysqli_query($conn, $querycheckchallenge);
                    $rowcheckchallenge = mysqli_fetch_assoc($resultcheckchallenge);
                    $nombreligne = mysqli_num_rows($resultcheckchallenge);
                    if ($nombreligne == 0) {
                        echo '
                        <img class="etat" src="media/faux.png">';
                        echo 'Statut : Non validé';
                    }
                    else {
                        echo '
                            <img class="etat" src="media/vrai.png">';
                        echo 'Statut : Validé';
                    }
                ?> <br>
              <centre> 20 Points</centre>
              <div class="c-txt">Le département de la Sécurité de l'ESAIP a reçu une alerte signalant qu'un pirate informatique avait réussi à  pénétrer dans leur système et avait volé une grande quantité de données confidentielles. Les enquêteurs ont pu récupérer un fichier contenant 22 hash de différents types, mais ils ne savent pas comment les décrypter. Les experts en sécurité ont analysé les hash et ont réalisé qu'ils avaient tous été générés à  partir d'un seul et unique caractère.<br></div>
            </div>
          </a>
          <a href="Challenge2.php" class="link">
            <div id="c-article">
              <div class="num">02</div>
              <div class="c-title">To be XOR or not to be</div>
                <?php
                    $querycheckchallenge = "SELECT `status` FROM `submissions`
                    LEFT JOIN `users` ON user_id =`id_user`
                    LEFT JOIN `challenges` ON `challenge_id`=`id_challenge`
                    WHERE `name` ='To be XOR or not to be' AND `user_id`='$user_id';";
                    $resultcheckchallenge = mysqli_query($conn, $querycheckchallenge);
                    $rowcheckchallenge = mysqli_fetch_assoc($resultcheckchallenge);
                    $nombreligne = mysqli_num_rows($resultcheckchallenge);
                    if ($nombreligne == 0) {
                        echo '
                        <img class="etat" src="media/faux.png">';
                        echo 'Statut : Non validé';
                    }
                    else {
                        echo '
                            <img class="etat" src="media/vrai.png">';
                        echo 'Statut : Validé';
                    }
                ?> <br>
              <centre> 20 Points</centre>
              <div class="c-txt">Le département de la Sécurité de l'ESAIP a reçu une alerte signalant qu'un pirate informatique avait réussi à  pénétrer dans leur système et avait volé une grande quantité de données confidentielles. Les enquêteurs ont pu récupérer un fichier contenant 22 hash de différents types, mais ils ne savent pas comment les décrypter. Les experts en sécurité ont analysé les hash et ont réalisé qu'ils avaient tous été générés à  partir d'un seul et unique caractère.<br></div>
            </div>
          </a>
          <a href="Challenge3.php" class="link">
            <div id="c-article">
              <div class="num">03</div>
              <div class="c-title">Crack ZIP</div>
                <?php
                    $querycheckchallenge = "SELECT `status` FROM `submissions`
                    LEFT JOIN `users` ON user_id =`id_user`
                    LEFT JOIN `challenges` ON `challenge_id`=`id_challenge`
                    WHERE `name` ='Crack ZIP' AND `user_id`='$user_id';";
                    $resultcheckchallenge = mysqli_query($conn, $querycheckchallenge);
                    $rowcheckchallenge = mysqli_fetch_assoc($resultcheckchallenge);
                    $nombreligne = mysqli_num_rows($resultcheckchallenge);
                    if ($nombreligne == 0) {
                        echo '
                        <img class="etat" src="media/faux.png">';
                        echo 'Statut : Non validé';
                    }
                    else {
                        echo '
                            <img class="etat" src="media/vrai.png">';
                        echo 'Statut : Validé';
                    }
                ?> <br>
              <centre> 50 Points</centre>
              <div class="c-txt">Le département de la Sécurité de l'ESAIP a reçu une alerte signalant qu'un pirate informatique avait réussi à  pénétrer dans leur système et avait volé une grande quantité de données confidentielles. Les enquêteurs ont pu récupérer un fichier contenant 22 hash de différents types, mais ils ne savent pas comment les décrypter. Les experts en sécurité ont analysé les hash et ont réalisé qu'ils avaient tous été générés à  partir d'un seul et unique caractère.<br></div>
            </div>
          </a>
         </br>         
      </section>

      <section class="msg">
        <div class="msg-title"> Stéganographie
          <hr width="80%" size="2,5" color="#7C1520" />
        </div>
        <div class="c-box">
          <a href="Challenge4.php" class="link">
            <div id="c-article">
              <div class="num">04</div>
              <div class="c-title">Steg'audio</div>
                <?php
                    $querycheckchallenge = "SELECT `status` FROM `submissions`
                    LEFT JOIN `users` ON user_id =`id_user`
                    LEFT JOIN `challenges` ON `challenge_id`=`id_challenge`
                    WHERE `name` ='Steg audio' AND `user_id`='$user_id';";
                    $resultcheckchallenge = mysqli_query($conn, $querycheckchallenge);
                    $rowcheckchallenge = mysqli_fetch_assoc($resultcheckchallenge);
                    $nombreligne = mysqli_num_rows($resultcheckchallenge);
                    if ($nombreligne == 0) {
                        echo '
                        <img class="etat" src="media/faux.png">';
                        echo 'Statut : Non validé';
                    }
                    else {
                        echo '
                            <img class="etat" src="media/vrai.png">';
                        echo 'Statut : Validé';
                    }
                ?> <br>
              <centre> 20 Points</centre>
              <div class="c-txt">Le département de la Sécurité de l'ESAIP a reçu une alerte signalant qu'un pirate informatique avait réussi à  pénétrer dans leur système et avait volé une grande quantité de données confidentielles. Les enquêteurs ont pu récupérer un fichier contenant 22 hash de différents types, mais ils ne savent pas comment les décrypter. Les experts en sécurité ont analysé les hash et ont réalisé qu'ils avaient tous été générés à  partir d'un seul et unique caractère.<br></div>
            </div>
          </a>
          <a href="Challenge5.php" class="link">
            <div id="c-article">
              <div class="num">05</div>
              <div class="c-title">CPT</div>
                <?php
                    $querycheckchallenge = "SELECT `status` FROM `submissions`
                    LEFT JOIN `users` ON user_id =`id_user`
                    LEFT JOIN `challenges` ON `challenge_id`=`id_challenge`
                    WHERE `name` ='CPT' AND `user_id`='$user_id';";
                    $resultcheckchallenge = mysqli_query($conn, $querycheckchallenge);
                    $rowcheckchallenge = mysqli_fetch_assoc($resultcheckchallenge);
                    $nombreligne = mysqli_num_rows($resultcheckchallenge);
                    if ($nombreligne == 0) {
                        echo '
                        <img class="etat" src="media/faux.png">';
                        echo 'Statut : Non validé';
                    }
                    else {
                        echo '
                            <img class="etat" src="media/vrai.png">';
                        echo 'Statut : Validé';
                    }
                ?> <br>
              <centre> 100 Points</centre>
              <div class="c-txt">Le département de la Sécurité de l'ESAIP a reçu une alerte signalant qu'un pirate informatique avait réussi à  pénétrer dans leur système et avait volé une grande quantité de données confidentielles. Les enquêteurs ont pu récupérer un fichier contenant 22 hash de différents types, mais ils ne savent pas comment les décrypter. Les experts en sécurité ont analysé les hash et ont réalisé qu'ils avaient tous été générés à  partir d'un seul et unique caractère.<br></div>
            </div>
          </a>
         </br>         
      </section>

      <section class="msg">
        <div class="msg-title"> OSINT
          <hr width="80%" size="2,5" color="#7C1520" />
        </div>
        <div class="c-box">
          <a href="Challenge6.php" class="link">
            <div id="c-article">
              <div class="num">06</div>
              <div class="c-title">Je me souviens plus</div>
                <?php
                    $querycheckchallenge = "SELECT `status` FROM `submissions`
                    LEFT JOIN `users` ON user_id =`id_user`
                    LEFT JOIN `challenges` ON `challenge_id`=`id_challenge`
                    WHERE `name` ='Je me souviens plus' AND `user_id`='$user_id';";
                    $resultcheckchallenge = mysqli_query($conn, $querycheckchallenge);
                    $rowcheckchallenge = mysqli_fetch_assoc($resultcheckchallenge);
                    $nombreligne = mysqli_num_rows($resultcheckchallenge);
                    if ($nombreligne == 0) {
                        echo '
                        <img class="etat" src="media/faux.png">';
                        echo 'Statut : Non validé';
                    }
                    else {
                        echo '
                            <img class="etat" src="media/vrai.png">';
                        echo 'Statut : Validé';
                    }
                ?> <br>
              <centre> 20 Points</centre>
              <div class="c-txt">Le département de la Sécurité de l'ESAIP a reçu une alerte signalant qu'un pirate informatique avait réussi à  pénétrer dans leur système et avait volé une grande quantité de données confidentielles. Les enquêteurs ont pu récupérer un fichier contenant 22 hash de différents types, mais ils ne savent pas comment les décrypter. Les experts en sécurité ont analysé les hash et ont réalisé qu'ils avaient tous été générés à  partir d'un seul et unique caractère.<br></div>
            </div>
          </a>
         </br>         
      </section>

      <section class="msg">
        <div class="msg-title"> Réseau
          <hr width="80%" size="2,5" color="#7C1520" />
        </div>
        <div class="c-box">
          <a href="Challenge7.php" class="link">
            <div id="c-article">
              <div class="num">07</div>
              <div class="c-title">Je suis caché dans le chapitre 7</div>
                <?php
                    $querycheckchallenge = "SELECT `status` FROM `submissions`
                    LEFT JOIN `users` ON user_id =`id_user`
                    LEFT JOIN `challenges` ON `challenge_id`=`id_challenge`
                    WHERE `name` ='Je suis cache dans le chapitre 7' AND `user_id`='$user_id';";
                    $resultcheckchallenge = mysqli_query($conn, $querycheckchallenge);
                    $rowcheckchallenge = mysqli_fetch_assoc($resultcheckchallenge);
                    $nombreligne = mysqli_num_rows($resultcheckchallenge);
                    if ($nombreligne == 0) {
                        echo '
                        <img class="etat" src="media/faux.png">';
                        echo 'Statut : Non validé';
                    }
                    else {
                        echo '
                            <img class="etat" src="media/vrai.png">';
                        echo 'Statut : Validé';
                    }
                ?> <br>
              <centre> 50 Points</centre>
              <div class="c-txt">Le département de la Sécurité de l'ESAIP a reçu une alerte signalant qu'un pirate informatique avait réussi à  pénétrer dans leur système et avait volé une grande quantité de données confidentielles. Les enquêteurs ont pu récupérer un fichier contenant 22 hash de différents types, mais ils ne savent pas comment les décrypter. Les experts en sécurité ont analysé les hash et ont réalisé qu'ils avaient tous été générés à  partir d'un seul et unique caractère.<br></div>
            </div>
          </a>
         </br>         
      </section>

      <section class="msg">
        <div class="msg-title"> Forensics
          <hr width="80%" size="2,5" color="#7C1520" />
        </div>
        <div class="c-box">
          <a href="Challenge8.php" class="link">
            <div id="c-article">
              <div class="num">08</div>
              <div class="c-title">Breaking my DB</div>
                <?php
                    $querycheckchallenge = "SELECT `status` FROM `submissions`
                    LEFT JOIN `users` ON user_id =`id_user`
                    LEFT JOIN `challenges` ON `challenge_id`=`id_challenge`
                    WHERE `name` ='Breaking my DB' AND `user_id`='$user_id';";
                    $resultcheckchallenge = mysqli_query($conn, $querycheckchallenge);
                    $rowcheckchallenge = mysqli_fetch_assoc($resultcheckchallenge);
                    $nombreligne = mysqli_num_rows($resultcheckchallenge);
                    if ($nombreligne == 0) {
                        echo '
                        <img class="etat" src="media/faux.png">';
                        echo 'Statut : Non validé';
                    }
                    else {
                        echo '
                            <img class="etat" src="media/vrai.png">';
                        echo 'Statut : Validé';
                    }
                ?> <br>
              <centre> 50 Points</centre>
              <div class="c-txt">Le département de la Sécurité de l'ESAIP a reçu une alerte signalant qu'un pirate informatique avait réussi à  pénétrer dans leur système et avait volé une grande quantité de données confidentielles. Les enquêteurs ont pu récupérer un fichier contenant 22 hash de différents types, mais ils ne savent pas comment les décrypter. Les experts en sécurité ont analysé les hash et ont réalisé qu'ils avaient tous été générés à  partir d'un seul et unique caractère.<br></div>
            </div>
          </a>
         </br>         
      </section>


    </article>
    <footer>
      <section class="ft">
        <div class="info">
          <div class="t-info">
            <div class="f-title">Lien rapide</div>
            <div class="f-txt">
              <a href="accueil.php">accueil</a>
              <br>
              <a href="challenge.php">challenge</a>
              <br>github
            </div>
          </div>
          <div class="t-info">
            <div class="f-title">Information</div>
            <div class="f-txt"></div>
          </div>
          <div class="t-info">
            <div class="f-title">Contact</div>
            <div class="f-txt"> E-mail : créer mail </div>
          </div>
        </div>
        <div class="f-txt2"> Copyright © 2023 - ESAIP - Tout droit réservé. </div>
      </section>
    </footer>
  </body>
</html>
