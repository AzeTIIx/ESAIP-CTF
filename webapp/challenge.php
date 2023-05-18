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
              <div class="c-txt">Le département de la Sécurité de l'ESAIP a reçu une alerte signalant qu'un pirate informatique avait réussi à  pénétrer dans leur système et avait volé une grande quantité de données confidentielles. Les enquêteurs ont pu récupérer un fichier contenant 22 hash de différents types, mais ils ne savent pas comment les décrypter.<br></div>
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
              <div class="c-txt">On a réussi à récupérer un programme de chiffrement, mais il n’est pas complet à vous de jouer vous verrez c’est facile.<br></div>
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
              <div class="c-txt">Des enquêteurs ont récupéré une archive zip suspecte que Matteo a téléchargé sur son ordinateur, à prioris c’est un crack photoshop mais rien n’est sûr.<br></div>
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
              <div class="c-txt">Tom voulait écouter tranquillement le dernier album de Metallica mais tout ne s’est pas passé comme prévu mvoyez.<br><br> Trouver ce qui a pu arriver au morceau de notre pauvre Tom<br></div>
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
              <div class="c-txt">On a récupéré les images sur l’appareil photo de Monsieur Ripoll, cependant l’une d’entre elles semble corrompue ! <br><br> Trouvez un moyen de l’ouvrir.<br></div>
            </div>
          </a>
         <a href="Challenge11.php" class="link">
            <div id="c-article">
              <div class="num">11</div>
              <div class="c-title">le rageux</div>
                <?php
                    $querycheckchallenge = "SELECT `status` FROM `submissions`
                    LEFT JOIN `users` ON user_id =`id_user`
                    LEFT JOIN `challenges` ON `challenge_id`=`id_challenge`
                    WHERE `name` ='rage' AND `user_id`='$user_id';";
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
              <div class="c-txt">Le grand chef suprème de l'empire, Darth AzeTIx, a transférer une image à ses généraux et les rebelles ont réussis à l'intercepter.<br><br>Nous savons qu'il est sur les nerfs en ce moment, sa mimique : "MAIS COMMENT"<br><br>Trouvez les informations cachées dans l'image.<br></div>
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
              <div class="c-txt">En fouillant sur internet, la police a découvert une photo postée par M. Ripoll lors de ses dernières vacances. Sur la photo, on pouvait voir un clocher traditionnel typique de la région, avec une vue sur les montagnes en arrière-plan. <br><br>Retrouve le village où est allé Monsieur Ripoll, le flag est au format : <br><br>ESAIP{nomduvillage}<br></div>
            </div>
          </a>
          <a href="Challenge9.php" class="link">
            <div id="c-article">
              <div class="num">09</div>
              <div class="c-title">Paul Renines</div>
                <?php
                    $querycheckchallenge = "SELECT `status` FROM `submissions`
                    LEFT JOIN `users` ON user_id =`id_user`
                    LEFT JOIN `challenges` ON `challenge_id`=`id_challenge`
                    WHERE `name` ='paul' AND `user_id`='$user_id';";
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
              <div class="c-txt">Monsieur Ripoll est impliqué dans une enquête policière concernant un cambriolage qui a eu lieu dans les locaux de l'école. Soupçonnée par la police, elle souhaite l'interroger rapidement pour résoudre cette affaire.<br>Il serait lié à une personne dénomée “Michelle” possédant un chien nommé “Cocacola”.<br>Pour commencer le chall, on viendra vous chercher.</div>
           </div>
        </a>
      </section>

      <section class="msg">
        <div class="msg-title"> Réseau
          <hr width="80%" size="2,5" color="#7C1520" />
        </div>
        <div class="c-box">
          <a href="Challenge7.php" class="link">
            <div id="c-article">
              <div class="num">07</div>
              <div class="c-title">Je suis dans le chap 7</div>
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
              <div class="c-txt">Alessandro, en bon élève, veut s’avancer sur son cours de pentest et là c’est le drame ! <br><br> Il se trouve que sa connexion n'était pas sécurisée et maintenant son mot de passe est dans la nature.<br></div>
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
              <div class="c-txt">Un enquêteur a retrouvé sur l'ordinateur de Monsieur Ripoll, un fichier chiffré en format Keepass. Le nom du fichier est "database.kdbx". Selon les informations de l'enquêteur, ce fichier pourrait contenir des informations sensibles sur les clients de l'entreprise pour laquelle travaille Monsieur Ripoll.<br></div>
            </div>
          </a>
         </br>
      </section>

   <section class="msg">
        <div class="msg-title"> Web
          <hr width="80%" size="2,5" color="#7C1520" />
        </div>
        <div class="c-box">
          <a href="Challenge10.php" class="link">
            <div id="c-article">
              <div class="num">10</div>
              <div class="c-title">Dans une galaxie lointaine</div>
                <?php
                    $querycheckchallenge = "SELECT `status` FROM `submissions`
                    LEFT JOIN `users` ON user_id =`id_user`
                    LEFT JOIN `challenges` ON `challenge_id`=`id_challenge`
                    WHERE `name` ='star' AND `user_id`='$user_id';";
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
              <div class="c-txt">Vous êtes un enquêteur spatial à la recherche du savoir, certains des plus grands Jedi connus de nos jours possèdent un secret bien gardé… Parmi les 3 plus grands manieurs de sabre de la galaxie, un seul possède un secret lui permettant de cacher sa véritable nature à l'univers !<br></div>
            </div>
          </a>
         </br>
      </section>

      <section class="msg">
        <div class="msg-title"> Misc
          <hr width="80%" size="2,5" color="#7C1520" />
        </div>
        <div class="c-box">
          <a href="ChallengeEnd.php" class="link">
            <div id="c-article">
              <div class="num">The End</div>
              <div class="c-title">Merci !</div>
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
              <centre> 20 Points</centre>
              <div class="c-txt">Merci d'avoir participer à la première édition du Hack n FLag, vous pouvez prendre 5 minutes pour répondre à ce questionnaire pour nous aider à nous améliorer si vous le souhaitez !<br></div>
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
                    <br><a href="challenge.php">challenge</a>
                    <br>github
                    </div>
                </div>
                <div class="t-info">
                    <div class="f-title">Information</div>
                    <div class="f-txt">Vous pouvez voir l'état de vos challenges sur la page prévue à cet effet.</div>
                </div>
                <div class="t-info">
                    <div class="f-title">Contact</div>
                    <div class="f-txt">
                    caimin.ing2024@esaip.org<br>
                    851 Bâtiments B & C, VERT POMONE,<br>Allée de Pomone, 13 090 AIX EN PROVENCE
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
