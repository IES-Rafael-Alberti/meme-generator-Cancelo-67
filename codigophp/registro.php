<?php
if(isset($_POST['nombre'])) {
   require("conecta.php");

    // recupera los datos del formulario
    $nombre = $_POST["nombre"];
    $password = $_POST["password"];
   
    // prepara la sentencia SQL. Le doy un nombre a cada dato del formulario 
    $sql = "INSERT INTO usuario (nombre,password) VALUES (:nombre,:password)";
    // asocia valores a esos nombres
    $datos = array("nombre" => $nombre,
                   "password" => $password,
                  );
    // comprueba que la sentencia SQL preparada está bien 
    $stmt = $conn->prepare($sql);
    // ejecuta la sentencia usando los valores
    if($stmt->execute($datos) != 1) {
        print("No se pudo dar de alta");
        exit(0);
    }
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meme Generator - Register</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <label for="usuario">Nombre: </label>
    <input type="text" name="nombre" id="nombre">
    <label for="password">password: </label>
    <input type="password" name="password" id="password">
    <input type="submit" value="Registrarse">
</form>    
</body>
</html>