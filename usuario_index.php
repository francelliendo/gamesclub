<?php
    session_start();
    $nombreUsu = $_SESSION["user"];

    if ($nombreUsu){

        include ("cnx.php");
        include ("header.php");


?>
<body>
<?php
include ("menu_usuario.php");
?>




<div class="informativo"><h2>Bienvenido <?php echo $nombreUsu?> <br> Actualmente estamos desarrollando nuestra plataforma <br> sera informado cuando pueda realizar operaciones</h2></div>

<?php     
//--------------- FIN DEL IF DE LA SESION................
}else{     
session_destroy();    
header("location:index.php");  
}
?>
</body>
</html>