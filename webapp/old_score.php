<!DOCTYPE html>
<html>
  <head>
    <title>CTF - Score</title>
    <link rel="stylesheet" href="score.css">
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="scores.js"></script>
  </head>

  <body>

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
          GRAPHIQUE DES POINTS
          <hr width="80%" size="2,5" color="#7C1520"/>
        </div>
        <div class="chart-container">
          <canvas id="Graph"></canvas>
        </div>
      </section>
    </article>

    <div class="clasM">
      <?php include("tab.php"); ?>
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