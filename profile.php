<?php
include_once(__DIR__ . "/inc/session.inc.php");
include_once(__DIR__ . "/classes/User.php");

//test
if ($role = 1) {
    $fetchPData = new User();
    $fetchPData->setUserID($userID);
    $PData = $fetchPData->fetchPData($userID);
    
} else {
}
var_dump($PData);
$id= $PData["id"];

$user = new User();
if(isset($_POST['emailOpslaan'])){
    if(!empty($_POST)){
        $email = htmlspecialchars($_POST['email']);
        echo $_POST['email'];
        if(!empty($email)){
            $result=$user->emailAvailable($email);
            if($result==true){
                echo "goed";
                $user->setEmail($email);
                $userID = $id;
				$user->setuserID($userID);
				var_dump($email, $userID);
				$result = $user->changeEmail($email, $userID);
                echo $result;
				if ($result==true){
                    echo"query gelukt";
                    header('Location:index.php');
                }
                else if($result==false){
                    echo"query gefaald";
                }
            else{
                echo "email al in gebruik";
            }
        }
        else{ $error="speciaal teken niet ondersteund";}
    }
    else{$error="mag niet leeg zijn";}
}
}

$user = new User();
if(isset($_POST['WWOpslaan'])){
    if(!empty($_POST)){
        $password = htmlspecialchars($_POST['password']);
        echo $_POST['password'];
        if(!empty($password)){
            
                
                $user->setPassword($password);
                $userID = $id;
				$user->setuserID($userID);
				var_dump($password, $userID);
				$result = $user->changePass($password, $userID);
                echo $result;
				if ($result==true){
                    echo"query gelukt";
                    header('Location:index.php');
                }
                else if($result==false){
                    echo"query gefaald";
                }
        }
        else{ $error="speciaal teken niet ondersteund";}
    }
    else{$error="mag niet leeg zijn";}
}


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
    <h2>Jouw profiel</h2>
        <p>Naam</p>
        <span><?php echo $PData["firstname"].' '.$PData["lastname"] ?></span>
        <br>
        <?php if(isset($error)) : ?>
				<div class="form_error text-center mb-5">
					<p class="form_error">
						<?php echo $error; ?>
					</p>
				</div>
				<?php endif; ?>
        <form action="" method="post">
        <p>Email</p>
        <input value="<?php echo $PData["email"] ?>" name="email"/>
        <input type="submit" value="Opslaan" name="emailOpslaan" class="form_btn w-64 md:w-72 h-12 shadow-md rounded-2xl text-white mb-2 ml-auto mr-auto block">
        </form>
        <form action="" method="post">
        <p>Wachtwoord</p>
        <input type= "password" value="" name="password"/>
        <input type="submit" value="Opslaan" name="WWOpslaan" class="form_btn w-64 md:w-72 h-12 shadow-md rounded-2xl text-white mb-2 ml-auto mr-auto block">
        </form>
   
</body>

</html>