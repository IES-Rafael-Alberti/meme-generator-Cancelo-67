<?php
    require("testregistro.php");
    //url for meme list
    $url = 'https://api.imgflip.com/get_memes';

    //open connection
    $ch = curl_init();

    //set the url
    curl_setopt($ch,CURLOPT_URL, $url);

    //So that curl_exec returns the contents of the cURL; rather than echoing it
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

    //receive url content 
    $result = curl_exec($ch);

    //decode content (assoc array)
    $data = json_decode($result, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <title>Listado de Memes</title>
</head>
<body>
    <a href="logout.php"><span>Cerrar Sesion</span></a>
    <?php
        if($data["success"]) {
            //iterates over memes array
            foreach($data["data"]["memes"] as $meme) {
                //show meme image 
                echo "<a href='editarmeme.php?id=". $meme['id']."&url=".$meme['url']."&cajas=".$meme['box_count']."&nombrememe=".$meme['name']."'><img width='100px' src='" . $meme["url"] ."'>";
            }
    }
    ?>
</body>
</html>