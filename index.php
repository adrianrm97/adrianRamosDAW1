<?php
$errorMensaje = "";
$usuarioInvalido = "";
if (isset ($_GET['errorMensaje'])) {
  $errorMensaje = $_GET['errorMensaje'];
}
include("./insertValido.php");
include("./emailconfirma.php");

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./estilosform.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet" />
    <title>Formulario</title>
  </head>
  <body>
  <script>
  
  </script>
    <div id="registro">
      <div class="fondoForm">
        <!--FORMULARIO DE LOGIN -->
        <div id="login">
        <form method="POST" action="login.php"  id="formLog">
        <span class="errorMensaje"> <?php echo $errorMensaje; ?></span>
       
        <input type="text" name="usuario" placeholder="Usuario">
        <input type="text" name="password" placeholder="Contraseña">
        <input type="submit" value="Iniciar sesión">
        <a class="registro2" >¿No tienes cuenta? Regístrate</a>
        </form>
        </div>

      <!--FORMULARIO DE REGISTRO -->
        <form method="POST" action="index.php" id="formReg" >
        <span class="errorMensaje"><?php echo $usuarioInvalido?></span>
        <input type="text" name="usuario" placeholder="Usuario">

          <span class="errorMensaje"></span>
          <input type="email" name="email" placeholder="Email" />

         <span class="errorMensaje"><?php echo $emailCorrecto ?></span>
          <input type="email2" name="email2" placeholder="Confirma email" />

          <span class="errorMensaje"><?php echo $passwordCorrecta ?></span>
          <input type="password" name="password" placeholder="Contraseña" />
          
          <span class="errorMensaje"><?php echo $passwordCoinciden ?></span>
          <span class="errorMensaje"></span>
          <input type="password" name="password2" placeholder="Repite contraseña" />

          <input type="submit" value="Registrarse" >
          <div id="login"><a class="logina">¿Ya tienes cuenta? inicia sesión</a></div>
        </form>

      
    </div>
  </body>
  <script type="text/javascript" language="JavaScript">
  let registerClick = document.querySelector(".registro2");
  let loginClick = document.querySelector(".logina");
  let registro = document.querySelector("#formReg");
  let login = document.querySelector("#formLog");
  let divLogin = document.querySelector("#login");

  registro.style.display = "none";

loginClick.addEventListener("click",function () {

  registro.style.display = "none";
  divLogin.style.display = "flex";



});

 registerClick.addEventListener("click",function(){

  registro.style.display = "flex";
  divLogin.style.display = "none";

  });
  
  

  </script>
</html>
