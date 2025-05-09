<?php

include("db.php");
$id = $_POST['id'];
$query = "SELECT * from categories where id = '$id'";

$result = mysqli_query($connection, $query);
if(!$result){
    die("Query failed". mysqli_error($connection));
}else
$json = [];
    while($row = mysqli_fetch_array($result)){
        $json[]= array(
            'id' => $row['id'],
            'name' => ucfirst(($row['name'])),
            'description' => ($row['description'])
        );
    }
    $jsonString = json_encode($json[0]);
    echo $jsonString;
?>