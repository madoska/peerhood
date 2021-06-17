<?php
include_once(__DIR__ . "/inc/session.inc.php");
include_once(__DIR__ . "/classes/Course.php");
include_once(__DIR__ . "/classes/Team.php");
include_once(__DIR__ . "/classes/User.php");

//rolecheck
if ($role != 1) {
    $fetchPData = new User();
    $fetchPData->setUserID($userID);
    $PData = $fetchPData->fetchPData($userID);
} else {
}

//$id = $PData["id"];


if (isset($_POST['submit']) && $role == 1) {
    if (!empty($_POST['coursename'])) {
        $coursename = $_POST['coursename'];
        $code = substr(md5(uniqid(mt_rand(), true)), 0, 6);

        $course = new Course();
        $course->setUserID($userID);
        $course->setCoursename($coursename);
        $course->setCode($code);
        $result = $course->createCourse($userID, $coursename, $code);
        if ($result === true) {
            $error = "De cursus is succesvol aangemaakt";
        } else if ($result == false) {
            $error = "Er ging iets mis, probeer nog eens";
        }
    } else {
        $error = "Naam van cursus mag niet leeg zijn";
    }
}

if (isset($_POST['controleer'])) {
    $cn = $_POST['CheckName'];
    $cc = $_POST['CheckCode'];
    $course = new Course();
    $result = $course->checkCode($cn);
    //check codes

    foreach ($result as $cr) {
        $code2check = $cr['code'];
        $course_id = $cr['id'];
    }

    //compare

    if ($cc === $code2check) {
        $team = new Team();
        $r = $team->fetchAvailableGroups($course_id);
        shuffle($r);
        $newR = $r[0];
        $newRString = implode(" ", $newR);
        $rnew = (int)$newRString;

        //Add student to groups
        $newly = new Team();
        $newly->setTeamID($newR);
        $newly->setStudentID($userID);
        $n = $newly->addStudents($userID, $rnew);
        //var_dump($id);

        $error = "Je bent aangemeld voor dit vak!";
    } else {
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="build/tailwind.css">
    <title>Cursussen</title>
</head>

<body>
    <?php if ($role == 1) { ?>
        <div class="px-5 py-5 mb-10 ml-auto mr-auto gradient rounded-b-xl">
            <h2 class="text-2xl text-center text-white form_title">Welk vak geef jij?</h2>
        </div>
        <h2 class="text-2xl text-center mb-14 form_title md:text-2xl">Nieuwe cursus</h2>

    <?php } else { ?>
        <div class="px-5 py-5 mb-10 ml-auto mr-auto gradient rounded-b-xl">
            <h2 class="text-2xl text-center text-white form_title">Welk vak volg jij?</h2>
        </div>

        <h2 class="text-2xl text-center mb-14 form_title md:text-2xl">Nieuwe cursus</h2>

    <?php } ?>

    <?php if (isset($error)) : ?>
        <div class="mb-5 text-center form_error">
            <p class="form_error">
                <?php echo $error; ?>
            </p>
        </div>
    <?php endif; ?>

    <?php if ($role == 1) { ?>

        <form class="form" action="" method="post">
            <input class="block w-64 mb-2 ml-auto mr-auto bg-transparent border-b border-black form_field md:w-72" type="text" name="coursename" placeholder="Naam van jouw vak">
            <br>
            <input class="block w-64 h-12 mb-2 ml-auto mr-auto text-white shadow-md form_btn md:w-72 rounded-2xl" type="submit" value="Creeër cursus" name="submit">
        </form>

    <?php } else { ?>

        <form class="form" action="" method="post">
            <input class="block w-64 mb-2 ml-auto mr-auto bg-transparent border-b border-black form_field md:w-72" type="text" name="CheckName" placeholder="Naam van het vak">
            <br>
            <input class="block w-64 mb-2 ml-auto mr-auto bg-transparent border-b border-black form_field md:w-72" type="text" name="CheckCode" placeholder="Code">
            <br>
            <input class="block w-64 h-12 mb-2 ml-auto mr-auto text-white shadow-md form_btn md:w-72 rounded-2xl" type="submit" value="Controleer" name="controleer">
        </form>
    <?php } ?>

    <footer>
        <?php include_once('nav.inc.php'); ?>
    </footer>
</body>

</html>