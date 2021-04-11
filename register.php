<?php
include_once(__DIR__ . "/classes/Db.php");
include_once(__DIR__ . "/classes/User.php");
session_start();
session_destroy();

// if register form is submitted and not empty
if (!empty($_POST['register'])) {
    if(count(array_filter($_POST))==count($_POST)){
        // check if email is filled out
        if (!empty($_POST['email'])) {
            // check for thomas more email
            $verifyEmail = new User();
            $email = $_POST['email'];
            $verifyEmail->setEmail($email);
            $resultEmail = $verifyEmail->validateEmail($email);

            // if thomas more email = ok
            if ($resultEmail == 1) {
                // check if email is not taken
                $emailAvailable = new User();
                $emailAvailable->setEmail($email);
                $available = $emailAvailable->emailAvailable($email);
                if ($available == 1) {
                    // check if password and verifypassword are the same
                    if (!empty($_POST['password']) && $_POST['password'] === $_POST['verifyPassword']) {
                        //check if password length is ok
                        $verifyPassword = new User();
                        $password = $_POST['password'];
                        $verifyPassword->setPassword($password);
                        $resultPassword = $verifyPassword->validatePassword($password);

                        if ($resultPassword == 1) {
                            // register the user
                            $user = new User();
                            $firstname = $_POST['firstname'];
                            $lastname = $_POST['lastname'];
                            $role = $_POST['role'];
                            $email = $_POST['email'];
                            $password = $_POST['password'];
                            $user->setFirstname($firstname);
                            $user->setLastname($lastname);
                            $user->setRole($role);
                            $user->setEmail($email);
                            $user->setPassword($password);
                            $register = $user->register($email, $password, $firstname, $lastname, $role);

                            session_start();
                            $userID = $user->fetchUserID($email);
                            $_SESSION['user'] = $userID;
                            header("Location: index.php");
                        } else {
                            echo "Password too short.";
                            $alert = 5;
                        }
                    } else {
                        echo "Password doesn't match.";
                        $alert = 4;
                    }
                } else {
                    echo "Email taken.";
                    $alert = 3;
                }
            } else {
                echo "Only Thomas More emails please.";
                $alert = 2;
            }
        }
    } else {
        echo "Fill all fields out please.";
        $alert = 1;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="build/tailwind.css">	
    <title>Register</title>
</head>
<body class="bg-gray-200 h-screen mx-5 my-10">
<div class="bg-white h-screen rounded-3xl w-80 md:w-96 ml-auto mr-auto">
<img class="logo ml-auto mr-auto mb-2 pt-5" src="./images/logo-slogan.png">
<div class="container">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

<h2 class="form_title text-center mb-14 text-xl md:text-2xl">Registreren</h2>

    <div class="form_field">
        <input class="form_field bg-transparent border-b border-black w-64 md:w-72 mb-8 ml-auto mr-auto block" placeholder="First name" type="text" name="firstname" id="firstname">
    </div>

    <div class="form_field">
        <input class="form_field bg-transparent border-b border-black w-64 md:w-72 mb-8 ml-auto mr-auto block" placeholder="Last name" type="text" name="lastname" id="lastname">
    </div>

    <div class="form_field">
        <input class="form_field bg-transparent border-b border-black w-64 md:w-72 mb-8 ml-auto mr-auto block" placeholder="Email" type="text" name="email" id="email">
    </div>

    <div class="form_field">
        <input class="form_field bg-transparent border-b border-black w-64 md:w-72 mb-8 ml-auto mr-auto block" placeholder="Password" type="password" name="password" id="password">
    </div>

    <div class="form_field">
        <input class="form_field bg-transparent border-b border-black w-64 md:w-72 mb-8 ml-auto mr-auto block" placeholder="Verify password" type="password" name="verifyPassword" id="verifyPassword">
    </div>

    <div class="radio-item form_field w-64 md:w-72 mb-8 ml-auto mr-auto block">
        <label class="mr-2" for="role">Ik ben een...</label>
        <input type="radio" id="student" name="role" value="2">
            <label class="mr-2" for="student">Student</label>
        <input type="radio" id="docent" name="role" value="1">
            <label for="docent">Docent</label>
    </div>

    <div class="form_button">
        <input class="form_btn w-64 md:w-72 h-12 shadow-md rounded-2xl text-white mb-2 ml-auto mr-auto block" type="submit" value="Registreren" name="register" id="register">
    </div>
</form>
    <div class="text-center text-sm">
		<a class="form_register" href="login.php">Al geen account? Log je hier in</a>
	</div>
</div>
</div>
</body>
</html> 