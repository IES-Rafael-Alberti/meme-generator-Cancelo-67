<?php
  require("testregistro.php");
  
  
  $id = $_GET["id"];
  $url = $_GET["url"];
  $cajas = $_GET["cajas"];
  $nombrememe = $_GET["nombrememe"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Meme</title>
</head>
<body>
<?php
  echo "<form action='peticion-post.php?box=".$cajas."nombrememe=".$nombrememe."'  method='post' enctype='multipart/form-data'>";
  
    echo "<img width='250px' src='" . $url . "'>";
    for($i = 1; $i<=$cajas;$i++){
      echo "<label for='Name'>Texto $i</label>";
      echo "<input type='text' name='text".$i."'>";
    }
    echo "<input type='hidden' value= '". $id ."' name= 'id' >";
    echo "<input type='submit' value='Enviar'>";
  echo "</form>"
?>

</body>
</html>
