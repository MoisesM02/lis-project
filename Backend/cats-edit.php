<?php

    include("db.php");
    $id = htmlspecialchars($_POST['id']);
    $name= mysqli_real_escape_string($connection, ($_POST['name']));
    $description = mysqli_real_escape_string($connection, ($_POST['description']));

    $query = "UPDATE categories set name='$name', description='$description' where id='$id';";
    $result= mysqli_query($connection, $query);
    
    if(!$result){
        die("Query failed". mysqli_error($connection));
    }else
    echo "Categorie updated successfully";

?>