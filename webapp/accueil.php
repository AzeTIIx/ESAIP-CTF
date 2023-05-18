<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>CTF - Accueil</title>
        <link rel="stylesheet" href="accueil.css">
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
                        session_start();
                        if(!isset($_SESSION["email"])) { ?>
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
                                    </a></li>
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
                    ?>
                </div>
            </div>
        </header>

        <!--les articles entourent un bloc de contenu (une unité)-->
        <!--les sections servent à contenir une partie isolée de la page (une fonctionnalité)-->
        <article class="corpus">
            <section class="pic">
                <div class="img"><img src="media/mask.jpg"></div>
            </section>
            <section class="msg">
                <div class="msg-title">
                    PRESENTATION
                    <hr width="80%" size="2,5" color="#7C1520"/>
                </div>

                <div class="c-box">
                    <div class="c-article">
                        <div class="c-title">L'EXPLICATION</div>
                        <div class="c-txt">Dans le cadre de notre 8ème semestre, nous devons réaliser un projet de majeure.
                            <br><br>
                            Ayant tous les quatre des compétences complémentaires, nous avons décidé de combiner nos savoirs pour la mise en place d'un projet commun.
                        </div>
                    </div>
                    <div class="c-article2">
                        <div class="c-title">LE PROJET</div>
                        <div class="c-txt">Etant amateurs de challenges cybersécurité, nous avons décidé de faire de toute pièce un jeu type CTF.
                            <br><br>
                            Sous forme de challenges classés par catégories, vous devrez trouver les vulnérabilités et les failles présentes.
                            <br><br>
                            Chaque challenge réussi vous fera remporter des points. Vous trouverez votre score ainsi que le classement sur la page prévue à cet effet (<a href="score">ici</a>).
                        </div>
                    </div>
                    <div class="c-article3">
                        <div class="c-title">L'EQUIPE</div>
                        <div class="c-txt">Le projet CTFxESAIP a été réalisé dans son intégralité par un groupe de 4 étudiants esaipiens, en majeure Cybersécurité et Big Data. Les membres sont les suivants : Charles <i>AIMIN</i>, Emma <i>BRIEU</i>, Alessandro <i>GADRAT</i> et Alexandre <i>ROUILLE</i>.
                            <br><br>
                            La création des challenges et leur intégration, le design du site web, la gestion de la base de données, la configuration du serveur sont des sujets qui ont tous été traités par nos soins.
                        </div>
                    </div>
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
