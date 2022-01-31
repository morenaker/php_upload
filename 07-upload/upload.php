<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<?php


if($_FILES){
    $targetDir="uploads/";
    $targetFile=$targetDir . basename($_FILES['uploadedName']['name']);
    $fileType=strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $uploadSuccess=true;

    if($_FILES['uploadedName']['error']!=0){
        echo"Chyba serveru pri uploadu";
        $uploadSuccess=false;
    }

    //kontrola existence
    if(file_exists($targetFile)){
        echo"soubor existuje";
        $uploadSuccess=false;
    }
    //kontrola velikosti
    if($_FILES['uploadedName']['size']>8000000){
        echo"Soubor je prilis velky";
        $uploadSuccess=false;
    }
    //kontrola typu
    // elseif($fileType!=="jpg" || $fileType!=="jpg" ||$fileType!=="mp4" ){
    //     echo"Soubor neni vhodneho typu";
    // }



    //presun souboru
    if(!$uploadSuccess){
        echo"Došlo k chybe uploadu";
    }else{
        if(move_uploaded_file($_FILES['uploadedName']['tmp_name'], $targetFile)){
            echo"Soubor'". basename($_FILES['uploadedName']['name']) . "'byl uložen";
        }else{
            echo"Došlo k chybe uploadu";
        }
    }

    if($uploadSuccess){
        if($fileType==="jpg"||$fileType==="png"){
            echo"<img width='400px' src={$targetFile}>";
        }
        else if($fileType==="mp4"||$fileType==="avi"){
            echo'<video controls width="250">
            <source src={$targetFile} type="video/webm">
            <source src={$targetFile} type="video/mp4">
            Pardon,chyba prohlížeče
            </video>';
        }
        else if($fileType==="mp3"){
            echo' <audio controls>
            <source src={$targetFile} type="audio/ogg">
            <source src={$targetFile} type="audio/mpeg">
            Your browser does not support the audio element.
            </audio> ';
        }
    }
}

?>
<body class="container">

    <form method="post" action="" enctype="multipart/form-data">
    <div class="mb-3">
    <p class="form-label">Select image to upload:</p>
    <input class="form-control"  type="file" name="uploadedName"/>
    <input   class="btn" type="submit" value="Nahrát" name="submit" />
    </div></form> 

</body>
</html>