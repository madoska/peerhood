<?php
include_once(__DIR__ . "/classes/User.php");
session_start();
session_destroy();

$user = new User();

if (!empty($_POST)) {
	$email = htmlspecialchars($_POST['email']);
	$password = htmlspecialchars($_POST['password']);
	if (!empty($email) && !empty($password)) {
		if ($user->checkLogin($email, $password)) {
			$user->setEmail($email);
			$userIDArray = $user->userIDFromSession($email);
			$userID = $userIDArray['userID'];
			$user->setuserID($userID);

			session_start();
			$userID = $user->fetchUserID($email);
			$_SESSION["user"] = $userID;

			//redirect to index.php
			header("Location: index.php");
		} else {
			$error = "Wachtwoord en email komen niet overeen";
		}
	} else {
		$error = "Email en wachtwoord zijn verplicht";
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- CSS only -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="build/tailwind.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400&display=swap" rel="stylesheet">
	<title>Login | peerhood</title>
</head>

<body class="h-screen gradient">
	<div class="h-auto pb-10 mx-5 my-10 ml-auto mr-auto bg-white rounded-3xl w-60 sm:w-80 md:w-96">
		<img class="pt-5 mb-2 ml-auto mr-auto logo" src="./images/logo-slogan.png">
		<div class="container">
			<div class="">
				<form action="" method="post">
					<h2 class="text-xl text-center form_title mb-14 md:text-2xl">Inloggen</h2>

					<?php if (isset($error)) : ?>
						<div class="mb-5 text-center form_error">
							<p class="form_error">
								<?php echo $error; ?>
							</p>
						</div>
					<?php endif; ?>

					<div class="form_field">
						<input type="text" class="block mb-8 ml-auto mr-auto bg-transparent border-b border-black w-52 sm:w-64 form_field md:w-72" id="email" name="email" placeholder="Email">
					</div>

					<div class="form_field">
						<input type="password" class="block mb-8 ml-auto mr-auto bg-transparent border-b border-black w-52 sm:w-64 form_field md:w-72" id="password" name="password" placeholder="Wachtwoord">
					</div>

					<div class="form_button">
						<input type="submit" value="Inloggen" class="block h-12 mb-2 ml-auto mr-auto text-white shadow-md w-52 sm:w-64 form_btn md:w-72 rounded-2xl">
					</div>
				</form>
				<div class="text-sm text-center">
					<a class="form_register" href="register.php"> Nog geen account? Registreer je hier</a>
				</div>
			</div>
		</div>
	</div>
</body>

</html>