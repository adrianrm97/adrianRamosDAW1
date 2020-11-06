<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Verificación | Registro</title>

</head>

<body>
  <!-- main div -->
  <div class="main">
    <h1>Verificación | Registro</h1>



    <!-- container div -->
    <div class="containerPHP">

      <?php
      include("./config.php");


      if (isset($_GET['usuario_email']) && !empty($_GET['usuario_email']) and isset($_GET['usuario_token_aleatorio']) && !empty($_GET['usuario_token_aleatorio'])) {
        // verificación de datos
        $email = $_GET['usuario_email']; //almacenamos los datos recogidos en variables.
        $usuario_token_aleatorio = $_GET['usuario_token_aleatorio'];

        //Busca en la tabla Usuarios el email y el Usuario_bloqueado
        $search = $con->query("SELECT Usuario_email, Usuario_token_aleatorio,
        Usuario_bloqueado FROM usuarios WHERE Usuario_email='" . $email . "' AND
        Usuario_token_aleatorio='" . $usuario_token_aleatorio . "' AND
        Usuario_bloqueado='1'") or die(mysqli_error($con));
        $match =
          mysqli_num_rows($search);
        if ($match > 0) { // Si recibe algo
          $con->query("UPDATE usuarios SET Usuario_bloqueado='0'
        WHERE Usuario_email='" . $email . "' AND Usuario_token_aleatorio='" .
            $usuario_token_aleatorio . "' AND Usuario_bloqueado='1'") or
            die(mysqli_error($con));
          echo '
        <div class="estado">
          Su cuenta ha sido activada, ahora puede iniciar sesión.
        </div>
        ';
        } else { // Si no recibe nada
          echo '
        <div class="estado">
        La URL no es válida o ya ha activado su cuenta.
        </div>
        ';
        }
      } else {
        echo '
        <div class="estado">
        Error, utilice el enlace que se ha enviado a su correo electrónico.         
        </div>
        ';
      } ?>

    </div>
    <!-- fin container div -->
  </div>
  <!-- fin main div -->
</body>

</html>