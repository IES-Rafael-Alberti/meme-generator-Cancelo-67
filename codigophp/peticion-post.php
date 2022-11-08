<?php
require("conecta.php");
session_start();
//url for meme creation
$url = 'https://api.imgflip.com/caption_image';
$id = $_POST['id'];
$box = $_GET['box'];
$idusuario = $_SESSION["id"];
$textos = array();


for($i=1;$i<=$box;$i++){
      array_push($textos, array("text"=> $_POST["text$i"]));
}
//The data you want to send via POST
$fields = array(
        "template_id" => $id,
        "username" => "fjortegan",
        "password" => "pestillo",
        "boxes" => $textos);

//url-ify the data for the POST
$fields_string = http_build_query($fields);

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

//So that curl_exec returns the contents of the cURL; rather than echoing it
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

//execute post
$result = curl_exec($ch);

//decode response
$data = json_decode($result, true);
$nombreMeme = $idusuario.date("dmyHis").".jpg";
file_put_contents("memesregistrados/$nombreMeme",file_get_contents($data["data"]["url"]));

$sql = "INSERT INTO meme (ruta,id_usuario) VALUES (:ruta,:id_usuario)";

$datos = array("ruta" => $nombreMeme,
            "id_usuario" => $idusuario
);

$stmt = $conn->prepare($sql);

if($stmt->execute($datos) !=1){
    print("No se pudo subir el meme");
    exit(0);
}
//if success show image
if($data["success"]) {
    echo "<img src='" . $data["data"]["url"] . "'>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meme - Visualizacion</title>
</head>
<body>
    <a href="index.php"><input type="submit" value="Guardar"></a>
</body>
</html>