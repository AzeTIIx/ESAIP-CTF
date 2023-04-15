<?php

require('config.php');


error_reporting(0);

function getTopTenUsers($conn) {

  
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
  
echo "</table>";


   
function getflag($conn) {
  // Vérifier si la connexion à la base de données est valide
  if (!$conn) {
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
  }

  $query = "SELECT `flag` FROM `challenges` WHERE `flag` = 'flag1'";
  $result = mysqli_query($conn, $query);

  // Vérifier si la requête s'est exécutée avec succès
  if ($result) {
    // Extraire la valeur de la colonne 'flag' du résultat de la requête
    $row = mysqli_fetch_assoc($result);
    $flagFromDB = $row['flag'];

    // Vérifier si la clé 'flag' existe dans le tableau $_POST
    if (isset($_POST['flag'])) {
      // Récupérer la valeur soumise dans le champ de texte
      $flag = $_POST['flag'];

      // Vérifier si la valeur correspond à la valeur stockée dans la base de données
      if ($flag === $flagFromDB) {
        echo 'Challenge réussi !';

      } else {
        echo 'pas bon';
        echo "<form method='post'>
              <input type='input' class='box-input' name='flag' id='flag' placeholder='flag' required />
              <input type='submit' class='box-input' name='envoyer' placeholder='envoyer'  />
              </form>
            ";
      }
    } else {
      // La clé 'flag' n'est pas définie dans le tableau $_POST
    }
  } else {
    // La requête a échoué
   // echo 'ERREUR : Impossible d\'exécuter la requête. ' . mysqli_error($conn);
  }

  mysqli_close($conn);
}

// Appel de la fonction getflag() en passant la variable $conn en paramètre
getflag($conn);


?>
