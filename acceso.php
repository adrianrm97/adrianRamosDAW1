<?php
include("./config.php");
session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    
}else{
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina principal</title>
</head>
<body>
    <?php
    // Fecha actual
    $time = time();
    ini_set('date.timezone','Europe/Madrid');
    $timestamp = date("Y-m-d h:i:s",$time);
        echo "Bienvenido " . $usuario . "<br>Ultima conexión: ".$timestamp;
        //
    
        $sql = "SELECT Usuario_fotografia FROM usuarios WHERE Usuario_nick='$usuario'";

        $resultadoQuery1 = mysqli_query($con, $sql); //consulta orientada a objetos.
        
        $CeldaImagen = mysqli_fetch_array($resultadoQuery1);
        
        $foto = $CeldaImagen['Usuario_fotografia'];


        echo '<img src="' . $foto . '" />';
       
    ?>

    <br>
    <a href="cerrarSesion.php">Cerrar sesión</a>
    <a href="modificarDatos.php">Modificar mi datos</a>
</body>
</html>