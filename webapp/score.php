<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>CTF - Score</title>
        <link rel="stylesheet" href="score.css">
        <script src="https://cdn.jsdelivr.net/npm/moment@2.29.0/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="scores.js"></script>
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

        <article class="corpus">
            <section class="pic">
                <div class="title">SCORE</div>
                <div class="img"><img src="media/mask.jpg"></div>
            </section>
            <section class="msg">
                <div class="msg-title">
                    GRAPHIQUE DE VOS POINTS
                    <hr width="80%" size="2,5" color="#7C1520"/>
                </div>
                
                <script>
                    //Chart.defaults.global.title.display = true;
                    //Chart.defaults.global.title.text = "TITRE";
                    
                </script>

                <div class="chart-container">
                    <canvas id="Graph"></canvas>
                </div>
            </section>
        </article>

        <div class="clasM">
            <?php include("tab.php");
            
            echo " 
            <div class='msg-title'><div class='msg2'>Classement des joueurs
            <hr width='80%' size='2,5' color='#7C1520'/></div></div>
            <table border-radius='20px' align='center'>
                <tr>
                    <th>NUMERO</th>
                    <th>NOM D'UTILISATEUR</th>
                    <th>POINTS</th>
                </tr>
            ";
            
            $users = getTopTenUsers($conn);
            $rank = 1;
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td align='center'>" . $rank . "</td>";
                echo "<td align='center'>" . $user['username'] . "</td>";
                echo "<td align='center'>" . $user['points'] . "</td>";
                echo "</tr>";
                $rank++;
            }
            
          echo "</table>";
            ?>
        
        </div>

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
