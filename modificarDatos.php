<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar datos</title>
</head>
<body>
    <h1>Cambiar mi foto</h1>
    <form action="perfilUPDATE.php" method="POST" enctype='multipart/form-data'>
        <input type="file" name="image" value="image">
        <br>
        <input type="submit" name="submit">
    </form>
</body>
</html>