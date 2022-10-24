<?php
if(isset($_POST['usuario'])) {
   require("testregistro.php");

    // recupera los datos del formulario
    $usuario = $_POST["usuario"];
    $contraseña = $_POST["contraseña"];
   
    // prepara la sentencia SQL. Le doy un nombre a cada dato del formulario 
    $sql = "SELECT * FROM usuario WHERE nombre = :usuario AND contraseña = :contraseña";
    // asocia valores a esos nombres
    $datos = array("usuario" => $usuario,
                   "contraseña" => $contraseña
                  );
    // comprueba que la sentencia SQL preparada está bien 
    $stmt = $conn->prepare($sql);
    // ejecuta la sentencia usando los valores
    $stmt->execute($datos);
    if($stmt->rowCount() == 1) {
        session_start();
        $_SESSION["usuario"] = $usuario;
        session_write_close();
        header("Location: index.php");
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
    <title>Protectora de animales RAfaNO - Login</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <label for="usuario">Usuario: </label>
    <input type="text" name="usuario" id="usuario">
    <label for="password">Password: </label>
    <input type="password" name="password" id="password">
    <input type="submit" value="Login">
</form>    
</body>
</html>