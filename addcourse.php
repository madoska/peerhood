<?php

if(isset($_POST['submit'])){
    if(!empty($_POST['coursename'])){
        if(!empty($_POST['profname'])){
          
            $str = $_POST['coursename'];
            $newhash = password_hash($str, PASSWORD_DEFAULT);
            echo $newhash;
            $code= substr($newhash, -6);
           var_dump($code);
        } else {echo "geen profnaam";}
    } else {echo "geen cursusnaam";}
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form class="form" action="" method="post">
<label for="">Naam cursus</label>
<br>
<input type="text" name="coursename">
<br>
<label for="">Naam professor</label>
<br>
<input type="text" name="profname">
<input type="submit" value="creeër cursus" name="submit">
</form>
</body>
</html>