<?php
include_once(__DIR__ . "/inc/session.inc.php");
include_once(__DIR__ . "/classes/User.php");

if ($role = 1) {
    $fetchPData = new User();
    $fetchPData->setUserID($userID);
    $PData = $fetchPData->fetchPData($userID);
    
} else {
}
var_dump($PData);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PEERHOOD | Home</title>
</head>

<body>
    <h1>Jouw cursussen</h1>
   
</body>

</html>