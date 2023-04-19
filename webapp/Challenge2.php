<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CTF - Challenge</title>
    <link rel="stylesheet" href="ctf.css">
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
                        require('tab.php');
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
                <a class="topnav_link" href="compte.php"> <?php
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
    <!--les articles entourent un bloc de contenu (une unité)-->
    <!--les sections servent à contenir une partie isolée de la page (une fonctionnalité)-->
    <article class="corpus">
      <section class="pic">
        <div class="img">
          <img src="media/mask.jpg">
        </div>
      </section>
      <section id="msg">
        <div class="msg-title"> Cryptanalyse
          <hr width="80%" size="2,5" color="#7C1520" />
        </div>
        <div class="c-article">
          <div class="c-high">
            <div class="c-info">
              <div class="c-descri">
                <?php
                    $statue ="";
                    $queryuser= "SELECT `id_user` FROM `users` WHERE `username` = '$username'";
                    $resultuser = mysqli_query($conn, $queryuser);
                    $rowuser = mysqli_fetch_assoc($resultuser); // Fetch the result as an associative array
                    $user_id = $rowuser['id_user'];
                    $querycheckchallenge = "SELECT `status` FROM `submissions`
                    LEFT JOIN `users` ON user_id =`id_user`
                    LEFT JOIN `challenges` ON `challenge_id`=`id_challenge`
                    WHERE `name` ='To be XOR or not to be' AND `user_id`='$user_id';";
                    $resultcheckchallenge = mysqli_query($conn, $querycheckchallenge);
                    $rowcheckchallenge = mysqli_fetch_assoc($resultcheckchallenge);
                    $nombreligne = mysqli_num_rows($resultcheckchallenge);

                    if ($nombreligne == 1) { echo '<img class="c-etat" src="media/vrai.png">'; }
                    else { echo '<img class="c-etat" src="media/faux.png">'; }
                ?>
                <div class="num">02</div>
                <a href="/Challenges/Crypto/Trop_haché/To_be_XOR_or_not_to_be.txt" download>
                <img src="https://cdn-icons-png.flaticon.com/512/58/58807.png?w=360" alt="Télécharger le fichier" class="download"></a>
                </a>
                <div class="c-title">To be XOR or not to be</div>
              </div>
              <div class="c-statut"> Valeur des points : <br>
                <centre> 20 Nb points</centre>
              </div>
            </div>
            <a href="challenge.php#c-article" class="croix"></a>
          </div>
          <div class="c-low">Le département de la Sécurité de l'ESAIP a reçu une alerte signalant qu'un pirate informatique avait réussi à pénétrer dans leur système et avait volé une grande quantité de données confidentielles. Les enquêteurs ont pu récupérer un fichier contenant 22 hash de différents types, mais ils ne savent pas comment les décrypter. Les experts en sécurité ont analysé les hash et ont réalisé qu'ils avaient tous été générés à partir d'un seul et unique caractère.<br></div>
        </div>
        <!-- Formulaire du flag -->
        <?php getflag($conn,"To be XOR or not to be",$username); ?>
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
