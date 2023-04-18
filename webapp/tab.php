<?php

require('config.php');


//error_reporting(0);

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
    return array_slice($users, 0, 100);

  }



   
function getflag($conn, $challenge, $user) {

    //echo $user;
  // Vérifier si la connexion à la base de données est valide
  if (!$conn) {
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
  }


  $queryflag = "SELECT `flag` FROM `challenges` WHERE `name` = '$challenge'";
  $resultflag = mysqli_query($conn, $queryflag);
  $rowflag = mysqli_fetch_assoc($resultflag);
  

  $queryuser= "SELECT `id_user` FROM `users` WHERE `username` = '$user'";
  $resultuser = mysqli_query($conn, $queryuser);
  $rowuser = mysqli_fetch_assoc($resultuser); // Fetch the result as an associative array
  $user_id = $rowuser['id_user']; // Access the value you need from the associative array

  $querychallengeid= "SELECT `id_challenge` FROM `challenges` WHERE `name` = '$challenge'";
  $resultchallengeid = mysqli_query($conn, $querychallengeid);
  $rowchallengeid = mysqli_fetch_assoc($resultchallengeid); // Fetch the result as an associative array
  $idchallenge = $rowchallengeid['id_challenge']; // Access the value you need from the associative array;

  $querycheckchallenge = "SELECT `status` FROM `submissions` 
    LEFT JOIN `users` ON user_id =`id_user`
    LEFT JOIN `challenges` ON `challenge_id`=`id_challenge`
    WHERE `name` ='$challenge' AND `user_id`='$user_id';";
  $resultcheckchallenge = mysqli_query($conn, $querycheckchallenge);
  $rowcheckchallenge = mysqli_fetch_assoc($resultcheckchallenge);

  $nombreligne = mysqli_num_rows($resultcheckchallenge);
  //echo $nombreligne;
 if ($nombreligne==0) {
  echo "<form method='post'>
  <input type='input' class='box-input' name='flag' id='flag' placeholder='flag' required />
  <input type='submit' class='box-input' name='envoyer' placeholder='envoyer'  />
  </form>";
 } else{
  //echo $row['status'];
  if ($rowcheckchallenge['status'] == 'valid') {
    echo "Vous avez déjà réussi ce challenge";
    return true;
  }
 }
  //echo mysqli_num_rows($resultcheckchallenge);


  // Vérifier si la requête s'est exécutée avec succès
  if ($resultflag) {
    // Extraire la valeur de la colonne 'flag' du résultat de la requête
    $flagFromDB = $rowflag['flag'];
    //echo $flagFromDB;

    // Vérifier si la clé 'flag' existe dans le tableau $_POST
    if (isset($_POST['flag'])) {
      // Récupérer la valeur soumise dans le champ de texte
      $flag = $_POST['flag'];
      $flaghashed  = hash('sha256', $flag);


      // Vérifier si la valeur correspond à la valeur stockée dans la base de données
      if ($flaghashed === $flagFromDB && mysqli_num_rows($resultcheckchallenge) == 0) {
        //echo $user_id;
         //echo $challenge;
        $queryvalid = "INSERT INTO `submissions`(`id_submission`, `status`, `timestamp`, `user_id`, `challenge_id`) 
                       VALUES (DEFAULT,'valid',CURRENT_TIMESTAMP(),'$user_id','$idchallenge')";
        $resultvalid = mysqli_query($conn, $queryvalid);
        $nombreligne=1;
        echo 'Challenge réussi !';
        ?><script>location.reload();</script><?php
      }
      else if(mysqli_num_rows($resultcheckchallenge) == 0) {
        echo 'Mauvaise réponse !';
       
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



?>
