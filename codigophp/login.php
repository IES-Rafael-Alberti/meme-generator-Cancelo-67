<?php
if(isset($_POST['nombre'])) {
   require("conecta.php");
  
    // recupera los datos del formulario
    $nombre = $_POST["nombre"];
    $password = $_POST["password"];

    // prepara la sentencia SQL. Le doy un nombre a cada dato del formulario 
    $sql = "SELECT * FROM usuario WHERE nombre = :nombre AND password = :password";
    // asocia valores a esos nombres
    $datos = array("nombre" => $nombre,
                   "password" => $password
                  );
    // comprueba que la sentencia SQL preparada está bien
    $stmt = $conn->prepare($sql);
    // ejecuta la sentencia usando los valores
    $stmt->execute($datos);
    $basedatos = $stmt -> fetch();
    
    if($stmt->rowCount() == 1) {
        session_start();
        $_SESSION["id"] = $basedatos["id"]; // Saco la id de base de datos y lo guardo en la sesion id para poder llamarla en otros sitios.
        $_SESSION["nombre"] = $nombre;
        session_write_close();
        header("Location: listadomemes.php");
        exit(0);
    }
    header("Location: login.php");
    exit(0);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meme - Login</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <label for="usuario">Nombre: </label>
    <input type="text" name="nombre" id="nombre">
    <label for="password">Password: </label>
    <input type="password" name="password" id="password">
    <input type="submit" value="Login">
</form>    
</body>
</html>