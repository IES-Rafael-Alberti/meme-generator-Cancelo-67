<?php
require("conecta.php");

session_start();
$idusuario = $_SESSION["id"];
session_write_close();

$sql = "SELECT * FROM meme WHERE id_usuario = :idusuario";

$stmt = $conn->prepare($sql);
$stmt->bindParam(":idusuario",$_SESSION["id"]);
$stmt->execute();
$memes = $stmt -> fetchAll();
foreach ($memes as $meme ){
    echo "<img src='" . $meme["ruta"] . "'>";
}