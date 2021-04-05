<?php
include_once(__DIR__ . "/inc/session.inc.php");
include_once(__DIR__ . "/classes/Course.php");

$fetchRole = new User();
$fetchRole->setUserID($userID);
$role = $fetchRole->fetchRole($userID);

echo ("UserID = " . $userID . " & role = " . $role);

if (isset($_POST['submit'])) {
    if (!empty($_POST['coursename'])) {
        $coursename = $_POST['coursename'];
        $code = substr(md5(uniqid(mt_rand(), true)) , 0, 6);
        echo($code);

        $course = new Course();
        $course->setUserID($userID);
        $course->setCoursename($coursename);
        $course->setCode($code);
        $result = $course->createCourse($userID, $coursename, $code);
        var_dump($course);
        if ($result === true) {
            echo('success');
        } else if ($result == false) {
            echo('stalled');
        }
    } else {
        echo "geen cursusnaam";
    }
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
    <?php if ($role == 1) { ?>
        <form class="form" action="" method="post">
            <label for="">Naam cursus</label>
            <br>
            <input type="text" name="coursename">
            <br>
            <input type="submit" value="creeër cursus" name="submit">
        </form>
    <?php } else { ?>
        <p>Alleen docenten kunnen cursussen aanmaken!</p>
    <?php } ?>
</body>

</html>