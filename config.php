<?php
  
    //empezamos la sesion al principio de todo:
    session_start();
    
    
    $timezone = date_default_timezone_set("Europe/London");

    //$con = mysqli_connect("PMYSQL139.dns-servicio.com:3306", "adrian", "Omeprasol1997ramos", "7912201_proyectophp_adrian");
    $con = mysqli_connect("localhost", "root", "", "formulario");

    if (mysqli_connect_errno()) {
        echo "Error al conectarse a la base de datos" . mysqli_connect_errno();
    }

   // mysqli_close($con);
/*
$pass = $_POST['password'];
$pass2 = $_POST['password2'];

if ($pass === $pass2) {
    $password = $pass;
    echo $password;
}else{
    echo "incorrecto";
}
*/




?>