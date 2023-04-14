<?php

function getTopTenUsers() {

 
    // Informations d'identification
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'ctf');
    
    
    // Connexion à la base de données MySQL 
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // Vérifier la connexion
    if($conn === false){
        die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
    }

    $sql = "SELECT username, MAX(points) as points FROM tableaupoints GROUP BY username ORDER BY points DESC";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $users = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
    } else {
        echo "Aucun enregistrement trouvé.";
    }

    mysqli_close($conn);

    // Sort the users by points in descending order
    usort($users, function($a, $b) {
      return $b['points'] - $a['points'];
    });
  
    // Return the top 10 users
    return array_slice($users, 0, 10);
  }




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

  $users = getTopTenUsers();
  $rank = 1;
  foreach ($users as $user) {
      echo "<tr>";
      echo "<td align='center'>" . $rank . "</td>";
      echo "<td align='center'>" . $user['username'] . "</td>";
      echo "<td align='center'>" . $user['points'] . "</td>";
      echo "</tr>";
      $rank++;
  }
  
echo "</table>"
?>

