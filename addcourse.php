<?php
include_once(__DIR__ . "/inc/session.inc.php");
include_once(__DIR__ . "/classes/Course.php");

if (isset($_POST['submit'])) {
    if (!empty($_POST['coursename'])) {
        $coursename = $_POST['coursename'];
        $code = substr(md5(uniqid(mt_rand(), true)), 0, 6);

        $course = new Course();
        $course->setUserID($userID);
        $course->setCoursename($coursename);
        $course->setCode($code);
        $result = $course->createCourse($userID, $coursename, $code);
        if ($result === true) {
            $error = "De cursus is succesvol opgeslagen";
        } else if ($result == false) {
            $error = "Er ging iets mis, probeer nog eens";
        }
    } else {
        $error = "Naam van cursus mag niet leeg zijn";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="build/tailwind.css">
    <title>Document</title>
</head>

<body>
    <div class="px-5 py-5 mb-10 ml-auto mr-auto gradient rounded-b-xl">
        <h2 class="text-2xl text-center text-white form_title">Welk vak geef jij?</h2>
    </div>
    <h2 class="text-2xl text-center mb-14 form_title md:text-2xl">Nieuwe cursus</h2>

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
        <p>Alleen docenten kunnen cursussen aanmaken!</p>
    <?php } ?>
</body>

<footer>
    <?php include_once('nav.inc.php'); ?>
</footer>

</html>