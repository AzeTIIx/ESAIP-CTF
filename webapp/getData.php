<?php
header('Content-Type: application/json');

include "config.php";

$query = sprintf("SELECT * FROM tableaupoints");
$result = mysqli_query($conn, $query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
  $data[] = $row;
}



//close connection
mysqli_close($conn);

//now print the data
print json_encode($data);

?>
