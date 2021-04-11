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
    <title>Register</title>
</head>
<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div>
        <label for="firstname">First name</label>
        <input type="text" name="firstname" id="firstname">
    </div>
    <div>
        <label for="lastname">Last name</label>
        <input type="text" name="lastname" id="lastname">
    </div>
    <div>
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>
    <div>
        <label for="verifyPassword">Verify password</label>
        <input type="password" name="verifyPassword" id="verifyPassword">
    </div>
    <div>
        <label for="role">Ik ben een...</label>
        <input type="radio" id="student" name="role" value="2">
            <label for="student">Student</label>
        <input type="radio" id="docent" name="role" value="1">
            <label for="docent">Docent</label>
    </div>
    <div>
        <input type="submit" value="Sign up" name="register" id="register">
    </div>
</form>
</body>
</html> 