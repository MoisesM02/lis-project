<?php
//Arreglar validaciones para que funcione sin foto

include('database.php');
if(empty($_FILES["imagen"])){
  if(isset($_POST['id'])) {
    $name = mysqli_real_escape_string($connection, ($_POST['name']));
    $description = mysqli_real_escape_string($connection,($_POST['description']));
    $price = mysqli_real_escape_string($connection,$_POST['price']);
    $place = mysqli_real_escape_string($connection, ($_POST['place']));
    $date = mysqli_real_escape_string($connection, ($_POST['date']));

      $id = $_POST['id'];
      $query = "UPDATE tblproductos SET Nombre = '$name', Descripcion = '$description',  Precio = $price, Lugar = '$place', Fecha = '$date' WHERE ID = '$id'";
      $result = mysqli_query($connection, $query);
    
      if (!$result) {
        die('Query Failed.'. mysqli_error($connection));
      }
        echo "Paquete actualizado satisfactoriamente";  
      }
}else{
   $image = $_FILES["imagen"];
//Validar el tamaño de la imagen
   $maxSize = 1*10e6;
   if($image["size"] > $maxSize){
       echo "The image size is more than 1MB";
   }else{
//Validar la imagen
       $imageData = getimagesize($image["tmp_name"]);
       if(!$imageData){
           echo "imagen no válida";
       }else{
//Validar formato de imagen
           $mimeType = $image['type'];
           $allowedMimeTypes = ["image/jpg", "image/png", "image/jpeg"];
           if(!in_array($mimeType, $allowedMimeTypes)){
               echo "Solo se admiten archivos .jpg y .png (su archivo es formato $mimeType)";
           }else{
//Preparar las variables para ejecutar sql
                  if(isset($_POST['id'])) {
                  $img = addslashes(file_get_contents($image["tmp_name"]));
                  $name = mysqli_real_escape_string($connection, ($_POST['name']));
                  $description = mysqli_real_escape_string($connection,($_POST['description']));
                  $price = mysqli_real_escape_string($connection,$_POST['price']);
                  $place = mysqli_real_escape_string($connection, ($_POST['place']));
                  $date = mysqli_real_escape_string($connection, ($_POST['date']));
                  
                    $id = $_POST['id'];
                    $query = "UPDATE tblproductos SET Nombre = '$name', Descripcion = '$description', Imagen = '$img', Precio = $price, Lugar = '$place', Fecha = '$date' WHERE ID = '$id'";
                    $result = mysqli_query($connection, $query);
                  
                    if (!$result) {
                      die('Query Failed.'. mysqli_error($connection));
                    }
                      echo "Paquete actualizado satisfactoriamente";  
                    }
           }                    
       }
   }
}









?>