<?php

include('database.php');

$search = $_POST['search'];
if(!empty($search)) {
  $query = "SELECT * FROM tblproductos WHERE Nombre LIKE '$search%'";
  $result = mysqli_query($connection, $query);
  
  if(!$result) {
    die('Query Error' . mysqli_error($connection));
  }
  
  $json = array();
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
      'name' => ($row['Nombre']),
      'id' => $row['ID']
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}

?>