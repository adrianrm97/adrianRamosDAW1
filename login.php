<?php
include("./config.php");
$errorMensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = md5($_POST['password']);
    
    $sql = "SELECT * FROM usuarios WHERE Usuario_nick = '$usuario' AND Usuario_clave = '$password' AND Usuario_bloqueado = 0";
    $resultado = mysqli_query($con, $sql);
    $devuelto = mysqli_num_rows($resultado);



    //Si devuelve 1 significa que ha encontrado el usuario y la contraseña es correcta.

    //LOGIN CORRECTO
    if ($devuelto == 1) {
        session_start();
        echo "encontrado la cuenta";
      if ($usuario == "admin" && $password == md5("123123Aa.")) {
        $_SESSION["usuario"] = $usuario;
        $cookie_name = "admin";
        $cookie_value = $usuario;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        print_r($_SESSION["usuario"]);
        $sql2 = "UPDATE usuarios SET Usuario_numero_intentos='3' WHERE Usuario_nick='$usuario'";
        $resultado = mysqli_query($con,$sql2);
        header("Location:administracion.php");

      }else{

        $_SESSION["usuario"] = $usuario;
        $cookie_name = "usuario";
        $cookie_value = $usuario;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        print_r($_SESSION["usuario"]);
        $sql2 = "UPDATE usuarios SET Usuario_numero_intentos='3' WHERE Usuario_nick='$usuario'";
        $resultado = mysqli_query($con,$sql2);
        header("Location:acceso.php");
    }
 }else {
        echo "Usuario no encontrado"."<br>";
        echo '<a href="index.php">Volver a la página de inicio de sesión</a>';
    }

  
    //LOGIN INCORRECTO:
    //Si devuelve 0, significa que el usuario o la contraseña son incorrectos. Tenemos que ver si el usuario existe:
    if ($devuelto == 0) {
        $sql2 = "SELECT * FROM usuarios WHERE Usuario_nick = '$usuario'";
        $resultado = mysqli_query($con,$sql2);
        $devuelto = mysqli_num_rows($resultado);

             //Significa que el usuario es correcto pero la contraseña no:
            if ($devuelto>0) {
            //COGER NUMERO DE INTENTOS
            $sqlContador = "SELECT Usuario_numero_intentos FROM usuarios WHERE Usuario_nick = '$usuario'";
            $resultado = mysqli_query($con,$sqlContador);
            $contador = mysqli_fetch_array($resultado);
            $contadorIntentos = $contador['Usuario_numero_intentos'];
            if ($contadorIntentos <= 0) {
                $sqlUPDATE = "UPDATE usuarios SET Usuario_bloqueado = 1 WHERE Usuario_nick='$usuario'";
                $ejecutarUpdate = mysqli_query($con,$sqlUPDATE);
                $errorMensaje = "La cuenta está bloqueada";
                header("Location:index.php?errorMensaje=$errorMensaje");
            }else{
            //Añadimos al mensaje de error los intentos que le quedan
            $errorMensaje = "Número de intentos restantes: ".$contadorIntentos;
                $contadorIntentos--;
                $sql2 = "UPDATE usuarios SET Usuario_numero_intentos='$contadorIntentos' WHERE Usuario_nick='$usuario'";
                $resultado = mysqli_query($con,$sql2);
                header("Location:index.php?errorMensaje=$errorMensaje");
            }
                
        }
    }
    

}


?>