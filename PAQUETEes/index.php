<?php
   session_start();
   if(!isset($_SESSION["usuario"]) || $_SESSION["rolid"] != "1"){
       header('Location: ../index.php');
   }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App</title>
    <!-- BOOTSTRAP 4  -->
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="icon" type="image/png" href="LoginPTC/images/logoicono.png">
  </head>
  <style>
    .line-clamp p, .line-clamp{
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
table{
  max-width: 100vw;
}
  </style>
  <body>

    <!-- NAVIGATION  -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
      <a class="navbar-brand" href="../index.php">TripsSV</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <form class="form-inline my-2 my-lg-0">
            <input name="search" id="search" class="form-control mr-sm-2" type="search" placeholder="Buscar paquete" aria-label="Search">
            <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
          </form>
      </div>
    </nav>

    <div class="container">
      <div class="row p-4">
        <div class="col-md-5">
          <div class="card">
            <div class="card-body">
              <!-- FORM TO ADD TASKS -->
              <form id="task-form">
                <div class="form-group">
                  <input type="text" id="name" placeholder="Nombre del paquete" class="form-control">
                </div>
                <div class="form-group">
                  <textarea id="description" cols="30" rows="5" class="form-control" placeholder="Descripción del paquete"></textarea>
                </div>
                <div class="form-group">
                  <div class="row">
                      <div class="col-sm-6">
                      <input type="text" id="price" placeholder="Precio" class="form-control">
                    </div>
                    <div class="col-sm-6">
                      <input type="text" id="place" placeholder="Lugar" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-10">
                      <input type="date" id="date" class="form-control">
                    </div>
                  </div>                 
                </div>
                <div class="form-group">
                  <div class="row">
                  <div class="col-sm-12">
                      <input type="file" id="image" class="form-control" aria-label="Insertar foto">
                  </div>
                </div>
                </div>
                
                <div class="row">
                  <div class="col-sm-12" id="foto">
                   </div>
                </div>
                <br>
                <input type="hidden" id="taskId">
                <button type="submit" class="btn btn-primary btn-block text-center ">
                  Guardar paquete
                </button>
              </form>
            </div>
          </div>   
        </div>
        <!-- TABLE  -->
        <div class="col-sm-7">
          <div class="card my-4" id="task-result">
            <div class="card-body">
              <!-- SEARCH -->
              <ul id="container"></ul>
            </div>
          </div>

          <table class="table table-bordered table-sm">
            <thead>
              <tr>
                <td>Id</td>
                <td>Nombre</td>
                <td>Descripción</td>
              </tr>
            </thead>
            <tbody id="tasks"></tbody>
          </table>
        </div>
      </div>
    </div>

    <script
      src="../js/jquery-3.4.1.min.js"></script>
    <!-- Frontend Logic -->
    <script src="crud.js"></script>
  </body>

</html>