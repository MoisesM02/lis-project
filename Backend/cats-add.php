<?php

include("db.php");

    if(isset($_POST['name'])){

        $name = strtolower((mysqli_real_escape_string($connection, $_POST['name'])));
        $description = (mysqli_real_escape_string($connection,$_POST['description']));
        $query ="INSERT INTO categories (name, description, imagen) VALUES ('$name', '$description', '');";

        $result= mysqli_query($connection, $query);
        if(!$result){
            var_dump($result);
            die("Query failed");
        }
        echo "Task added successfully";
    }

?>