<?php

include("./config.php");
$emailCorrecto = "";
$passwordCorrecta = "";
$passwordCoinciden = "";
$password = "";

function emailCoinciden($email,$email2){
    if ($email === $email2) {
        return true;
    }
    return false;
}

function emailEnUso($email,$con){
    $sql = "SELECT Usuario_email FROM usuarios WHERE Usuario_email = '$email'";
    if (mysqli_num_rows(mysqli_query($con,$sql))>0) {
        return true;
    }
    return false;
}

function passwordLongitud($password){
    if (strlen($password)<8) {
        return false;
    }
    return true;
}

function passwordCompleja($password){
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
      return false; 
    } else {
      return true;
    }
}

function passwordValida($pass,$pass2){
    if ($pass === $pass2) {
        $password = $pass;
        return true;
    }else{
        return false;
    }
}


function desinfectarUsuario($usuario){
    $usuario = strip_tags($usuario);
    $usuario = str_replace(" ","",$usuario);
    return $usuario;
}





if ($_SERVER["REQUEST_METHOD"] == "POST") {

$ok = true;
$pass = $_POST['password'];
$pass2 = $_POST['password2'];


if (passwordValida($pass,$pass2)) {
    $password = $pass;
}

if (passwordValida($pass,$pass2)) {
    if (passwordCompleja($pass)) {
        $password = md5($password);
        
    }else {
        $ok = false;
        $passwordCorrecta = "La contraseña debe contener al menos 8 caracteres y debe incluir al menos una mayuscula,un numero y un caracter especial.";
    }
}else{  
    $ok = false;
    $passwordCoinciden = "Las contraseñas no coinciden";
}

$usuarioCom = $_POST['usuario'];
$usuarioCom = desinfectarUsuario($usuarioCom);
$usuario = $usuarioCom;


$nombre = "";
$apellido1 = "";
$apellido2 = "";
$email = $_POST['email'];
$email2 = $_POST['email2'];


if (!emailCoinciden($email,$email2)) {
    $ok = false;
    $emailCorrecto = "El email no coincide";
}

if(emailEnUso($email,$con)){
   $ok = false;
   $emailCorrecto = "Email ya en uso";
}
/*
$dni = $_POST["dni"];
$telefono = $_POST["telefono"];
$direccion = $_POST["direccion"];
$poblacion = $_POST["poblacion"];
$foto = $_POST["foto"];
*/
$usuario_token_aleatorio = md5($password);


$date = date("Y/m/d");


if ($ok) {
    $sql = "INSERT INTO usuarios (Usuario_nombre,Usuario_apellido1,Usuario_apellido2,Usuario_nick,Usuario_clave,Usuario_fecha_alta,Usuario_email,Usuario_bloqueado,Usuario_numero_intentos,Usuario_token_aleatorio) 
    VALUES ('$nombre','$apellido1','$apellido2','$usuario','$password','$date','$email',1,5,'$usuario_token_aleatorio')";
    if (mysqli_query($con,$sql)) {
        echo "Entrada creada con éxito";
        $to      = $email; // Email que va a recibir el mensaje.
        $subject = 'Verificación | Registro'; //Concepto 
        $message = '

        Gracias por registrarte!
        Su cuenta ha sido creada, puede iniciar sesión con las siguientes credenciales después de haber activado su cuenta presionando la URL a continuación.

        ------------------------
        Username: ' . $usuario . '
        Password: ' . $password . '
        ------------------------

        Haga click en este enlace para activar su cuenta:
        http://adrian.hermanosramos.net/proyectophp/verificacion.php?usuario_email=' . $email . '&usuario_token_aleatorio=' . $usuario_token_aleatorio . ''; // Mensaje con enlace.

        $headers = 'From:soporte@hermanosramos.net' . "\r\n";
        mail($to, $subject, $message, $headers); // Mandar el email

//FIN MAIL
    }


    
  
}else{
    echo "Registro no válido";
}





}//fin post










?>