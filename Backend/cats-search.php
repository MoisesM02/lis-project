<?php

    include('db.php');

    $search=strtolower((mysqli_real_escape_string($connection,$_POST['search'])));
    if(!empty($search)){
        $query="SELECT * from categories where name LIKE '%$search%'";
        $result= mysqli_query($connection, $query);
        if(!$result){
            die('Query error'. mysqli_error($connection));
        }
        $json = array();
        while($row=mysqli_fetch_array($result)){
            $json[]= array(
                'id' => $row['id'],
                'name' => ($row['name']),
                'description' => ($row['description'])
            );
        }
        $jsonString = json_encode($json);
        echo $jsonString;
    }

?>