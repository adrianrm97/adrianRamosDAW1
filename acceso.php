<?php
include("./config.php");
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
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
    ?>
</body>
</html>