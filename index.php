<?php
session_start();

  include ("cnx.php");
  include ("header.php");
?>
<body>
<!------------------ VALIDACION DE INICIO DE SESION ------------->
<?php
include ("menu.php");

if (isset($_POST['session'])) {

$user = $_POST['user'];
$pass = $_POST['pass'];

$consultaSesion = "SELECT * FROM registros WHERE Correo ='$user' AND password = '$pass'";
$resultConsulta = $conexion->query($consultaSesion); 
$validacionSesion = mysqli_num_rows($resultConsulta); 

	if ($validacionSesion == 1) {
	  $_SESSION['user'] = $user;
					  ?>
						<script type="text/javascript">
						  window.location.href="usuario_index.php";
						</script>
					  <?php    
	}else{
		  ?>    
						  <h4 class="tituloHError">El usuario o la contraseña son incorrectos!!</h4>
			<?php

	}
}
?>
<div class="contenedorTitulo"><h2>Los Mejores Torneos de Consolas</h2></div>

<!-- VENTANA EMERGENTE DE INICIO DE SESION -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Inicia Sesion y Demuestra Tus Capacidades</h4>
        </div>
        <div class="modal-body">
			<form action="#" method="post">
				<div class="form-group">
				<label for="email">Email:</label>
				<input type="email" class="form-control" id="email" placeholder="Enter email" name="user" required>
				</div>
				<div class="form-group">
				<label for="pwd">Password:</label>
				<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pass" required>
				</div>
				<button type="submit" name="session" class="btn btn-primary cargar">Iniciar</button>
			</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>



<!------------------ CARUSEL DE IMAGENES ------------->
<div class="container" style="width: 100%; padding:0px; margin-top:0px;">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="img/banner1.jpg" alt="Los Angeles" style="width:100%; height:500px;">
      </div>

      <div class="item">
        <img src="img/banner2.jpg" alt="Chicago" style="width:100%; height:500px;">
      </div>
    
      <div class="item">
        <img src="img/banner3.jpg" alt="New york" style="width:100%; height:500px;">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>




<!------------------ REGISTRO DE USUARIOS ------------->
<div id="registro" style=" width:400px; padding:50px; border-radius:10px; margin:0 auto; color:black; background-color:white; height:auto; text-align:center; padding-top:30px; box-sizing: border-box; margin-top:50px;">
	
	<h3>Registrate y Demuestra tus Habilidades</h3>
	<br>
	<div>
	<form action="#" method="post">
		<div class="form-group">
			<input type="text" class="form-control error" placeholder="Nombre" id="nombre" name="nombre" required>
		</div>
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Apellido" id="apellido" name="apellido" required>
		</div>
		<div class="form-group">
			<input type="email" class="form-control" placeholder="Email" id="correo" name="correo" required>
		</div>
		<div class="form-group">
			<input type="password" class="form-control" placeholder="Contraseña" id="password" name="password" required> 
		</div>
		<div class="form-group">
			<input type="int" class="form-control" placeholder="Telefono" id="telefono" name="telefono" required>
		</div>
		<div class="form-group">
		<label for="sel1">Consola:</label>
			<select class="form-control" id="consola" name="consola">
				<option>Pc</option>
				<option>Play Station</option>
				<option>Mobil</option>
				<option>Xbox</option>
			</select>
		</div>
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Pais" id="pais" name="pais" required>
		</div>
		<button type="submit" name="cargar" class="btn btn-primary">Registrar</button>
	</form>
	</div>
</div>


<!------------------ CARGA A LA BASE DE DATOS DE LOS NUEVOS REGISTROS ------------->

<?php

    if(isset($_POST['cargar'])){

         $nombre = $_POST['nombre'];
         $apellido = $_POST['apellido'];
         $correo = $_POST['correo'];
		     $password = $_POST['password'];
         $telefono = $_POST['telefono'];
         $consola = $_POST['consola'];
         $pais = $_POST['pais'];

        $consultassql = "SELECT * FROM registros WHERE Correo='$correo'";
        $respuesta = $conexion->query($consultassql);


            if (mysqli_num_rows($respuesta)>0){ 
                    
                echo "<h4 class='tituloHError'>ERROR el correo ya se encuentra registrado!!</h4>";
				
                echo '<script type="text/javascript">'
                    , 'errorFormulario();'
                  ,'</script>'
                    ;
            }else{
                echo "<h4 class='tituloHSucess'>REGISTRADO!!</h4>";

                                $conexion->query("INSERT INTO registros VALUES (
                                '',
                                '$nombre',
                                '$apellido',
                                '$correo',
								                '$password',
                                '$telefono',
                                '$consola',
                                '$pais'
                                )");
            }
	  }
?>


</body>
</html>