<?php
    //comments.js hace peticiones a este archivo.
    include('db.php');

    //variables 
    $place = mysqli_real_escape_string($connection, ($_POST['place']));

    //Creación de query para obtener los comentarios del sitio
    $query = "SELECT * from comentarios where place = '$place' ORDER BY id ASC;";
    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result) > 0){
        $json = [];
        while($row = mysqli_fetch_array($result)){
            $json[]= array(
                'id' => $row['id'],
                'username' => ($row['username']),
                'comment' => ($row['comment']),
                'date' => $row['date'],
                'place' => ($row['place'])
            );
        }
        $jsonString = json_encode($json);
        echo $jsonString;
    }else{
        $errormsg = "Lo sentimos. No se encontraron comentarios sobre este sitio.";
        echo $errormsg;
    }

?>