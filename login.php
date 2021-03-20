<?php

include_once(__DIR__ . "/classes/User.php");
	$user = new User();

	if(!empty($_POST)) {
		$email = htmlspecialchars($_POST['email']);
		$password = htmlspecialchars($_POST['password']);
		if(!empty($email) && !empty($password)){
			if($user->checkLogin($email, $password)){
				$user->setEmail($email);
				$idArray = $user->idFromSession($email);
				$id = $idArray['id'];
				$user->setId($id);

				session_start();
				$_SESSION["user"] = $email; 
				$_SESSION["id"] = $id;

				//redirect to index.php
				header("Location: index.php");
			}
            else{
				$error = "Wachtwoord en email komen niet overeen";
			}
		}
        else {
			$error = "Email en wachtwoord zijn verplicht";
		}
	}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="build/tailwind.css">	
    <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400&display=swap" rel="stylesheet">
    <title>Login | peerhood</title>
</head>
<body class="bg-gray-200 h-screen mx-5 my-10">
<div class="bg-white h-screen rounded-3xl w-80 md:w-96 ml-auto mr-auto">
<img class="logo ml-auto mr-auto mb-2 pt-5" src="./images/logo-slogan.png">
<div class="container">
		<div class="">
			<form action="" method="post">
				<h2 class="form_title text-center mb-14 text-xl md:text-2xl">Inloggen</h2>

				<?php if(isset($error)) : ?>
				<div class="form_error text-center mb-5">
					<p class="form_error">
						<?php echo $error; ?>
					</p>
				</div>
				<?php endif; ?>

                <div class="form_field">
                    <input type="text" class="form_field bg-transparent border-b border-black w-64 md:w-72 mb-5 ml-auto mr-auto block" id="email" name="email" placeholder="Email">
				</div>

                <div class="">
                    <input type="password" class="form_field bg-transparent border-b border-black w-64 md:w-72 mb-5 ml-auto mr-auto block" id="password" name="password" placeholder="Wachtwoord">
                </div>

				<div class="form_button">
					<input type="submit" value="Inloggen" class="form_btn w-64 md:w-72 h-12 shadow-md rounded-2xl text-white mb-2 ml-auto mr-auto block">	
				</div>
			</form>
			<div class="text-center text-sm">
			<a class="form_register" href="register.php"> Nog geen account? Registreer je hier</a>
			</div>
		</div>
	</div>
</div>
</body>
</html>