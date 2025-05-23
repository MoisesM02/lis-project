<?php 
	ob_start();
	session_start();

if (isset($_SESSION['usuario'])) {
	header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
	$correo = filter_var($_POST['correo'], FILTER_SANITIZE_STRING);
	$correo = filter_var($correo, FILTER_VALIDATE_EMAIL);
	$password = $_POST['password'];
	$password2 = $_POST['password2'];

	$errores = '';

	if (empty($usuario) or empty($password) or empty($password2)) {
		$errores .= '<li> Fill the data correctly </li>';
	} else {
		try {
			$conexion = new PDO('mysql:host=db;dbname=test', 'moisesm', 'Mdvlinux23');
		} catch (PDOException $e) {
			
		}

		$statement = $conexion->prepare('SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1');
		$statement->execute(array(':usuario' => $usuario));
		$resultado = $statement->fetch();

		if ($resultado != false) {
			$errores .= '<li> El usuario ya existe, prueba con otro</li>';
		}

		$password = hash('sha512', $password);
		$password2 = hash('sha512', $password2);

		if ($password != $password2) {
			$errores .= '<li>Las contraseñas no coinciden</li>';
		}
		if($correo == false){
			$errores .= '<li>Ingresó un correo no válido.</li>';
		}
	}

	if ($errores == '') {
		$statement = $conexion->prepare('INSERT INTO usuarios (id, usuario, correo, pass, privilegio) VALUES (null, :usuario, :correo, :pass, 0)');
		$statement->execute(array(
			':usuario' => $usuario,
			':correo' => $correo,
			':pass' => $password
		));

		header('Location: login.php');
	}
}
ob_end_flush();
?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<meta name="description" content="User register page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
	<title>Registro</title>
	<link rel="icon" type="image/png" href="LoginPTC/images/logoicono.png">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/traductor.js"></script>
	<!-- <script>

	function validarEmail(elemento){
	  var texto = document.getElementById(elemento.id).value;
	  var regex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

	  if (!regex.test(texto)) {
	      document.getElementById("resultado").innerHTML = "Correo invalido";
	  } else {
	    document.getElementById("resultado").innerHTML = "Perfecto";
	  }
	}

	</script> -->
</head>
<body oncopy="return false" onpaste="return false" ondragstart="return false" ondrop="return false">
<?php include 'Tienda/templates/cabecera2.php'; ?>
	<div>
	<br>
	<br>
	<img src="LoginPTC/images/logo.jpg" class="rounded float-left" alt="Logo TRIPS SV" style="width: 850px">
	<style type="text/css">
		img{
			max-width: 100%;
		}
	</style>
	<style type="text/css">
  body{
    top: 0  !important;
    }
    .goog-te-banner-frame{
      display: none;
        }
</style> 
		<div>
		<center>
				<br>
				<br>
				<center>
				<h4 class="header green lighter bigger">
				   Ingresa tus datos: 
				</h4>
				</center>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" >
			<fieldset>
			<center>	

						<br>
			<!--<input type="text" id="inputs" class="form-control"  name="nombre" placeholder="Nombre" minlength="3" maxlength="35" onkeypress="return check(event)" oninput="validar(this)" autofocus="" required />	
			<script type="text/javascript">
				    const validar = function(campo) {
                      let valor = campo.value;
                      
                      // Verifica si el valor del campo (input) contiene numeros.
                      if(/\d/.test(valor)) {
                      
                        /* 
                         * Remueve los numeros que contiene el valor y lo establece
                         * en el valor del campo (input).
                         */
                        campo.value = valor.replace(/\d/g,'');
                      }
                      
                    };
            </script>        
			<script type="text/javascript">	
            function check(e) {
                tecla = (document.all) ? e.keyCode : e.which;
            
                //Tecla de retroceso para borrar, siempre la permite
                if (tecla == 8) {
                    return true;
                }
                //Tecla espacio
                if (tecla == 32) {
                    return true;
                }
            
                // Patron de entrada, en este caso solo acepta numeros y letras
                patron = /[A-Za-zá-ó]/;
                tecla_final = String.fromCharCode(tecla);
                return patron.test(tecla_final);
            }
			</script> -->
			<br>
			<input type="text" id="inputs" class="form-control" name="usuario" placeholder="Usuario" minlength="4" maxlength="24" autofocus="" required />
			<br>	       
		    <input type="email" id="inputs" class="form-control" name="correo" placeholder="Correo" 
		     onkeyup="validarEmail(this)" minlength="8" maxlength="40" required/>
            <br>   
           	<a id='resultado'></a>
           	<br><br>                          					
		    <input type="password" id="inputs" class="form-control" name="password" placeholder="Contraseña" minlength="8" maxlength="35" required />
			<br>
			<input type="password" id="inputs" class="form-control" name="password2" placeholder="Repetir contraseña" minlength="8" maxlength="35" required />

			<style type="text/css">
				#inputs{
					max-height: 90%;
					max-width: 90%;
					border-radius: 9px 9px 9px 9px;
					position: relative;
				}
				#botonRegistro{
					max-width: 90%;
				}
			</style>

			<br>
			<br>
			<br>
		    <button type="submit" name="registrar" id="botonRegistro" class="width-65 pull-right btn btn-sm btn-danger">
					<style type="text/css">
						#botonRegistro{
							width: 450px;
							height: 50px;
							font-size: 12px;
						}
					</style>	
						<span>Registrarse</span>
						<br>							
					</button>
					 </div>
					</center>
			</fieldset>
		</form>
		<?php if(!empty($errores)): ?>
				<div class="error">
					<ul>
						<?php echo $errores; ?>
					</ul>
				</div>
			<?php endif; ?>
		<br>
		<br>
		<center>
			<div class="regresar">
				<a class="backlogin" href="login.php">
						Regresar al Login
				</a>
				 <style type="text/css">
				.backlogin{
					color: #008FFF;
				}
			</style>
			<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		</div>
	</center>	
	</center>		
	</div>		
	<script>googleTranslateElementInit()</script> 
<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>

