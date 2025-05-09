<?php

    include("db.php");
    $query = "Select * from categories;";
    $result = mysqli_query($connection, $query);

    if(!$result){
        die("Query failed. ". mysqli_error($connection));
    }
    $json = [];
    while($row= mysqli_fetch_array($result)){
        $json[]= array(
            'id' => $row['id'],
            'name' => ucfirst(($row['name'])),
            'description' => ($row['description'])
        );
    }
    $jsonString = json_encode($json);
    echo $jsonString;
?>