<?php
include_once(__DIR__ . "/inc/session.inc.php");
include_once(__DIR__ . "/classes/Course.php");

$fetchPData = new User();
$fetchPData->setUserID($userID);
$PData = $fetchPData->fetchPData($userID);

if ($role = 1) {
    $fetchCourses = new Course();
    $fetchCourses->setUserID($userID);
    $courses = $fetchCourses->fetchCoursesByAdmin($userID);
} else {
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
    <title>PEERHOOD | Home</title>
</head>

<body>
    <div class="px-5 py-5 mb-10 ml-auto mr-auto gradient rounded-b-xl">
        <h1 class="mb-5 text-3xl text-center text-white form_title">Dag <?php echo $PData['firstname'] ?></h1>
        <h2 class="text-2xl text-center text-white form_title">Een overzicht van jouw vakken</h2>
    </div>

    <div class="flex items-center justify-center mb-10">
        <h2 class="mb-5 mr-10 text-2xl text-center form_title md:text-2xl">Jouw cursussen</h2>
        <div class="flex items-center justify-center">
            <div class="w-12 h-12 text-center bg-plus rounded-2xl hover:opacity-90">
                <a href="addcourse.php">
                    <span class="text-4xl font-bold text-white">+</span>
                </a>
            </div>
        </div>
    </div>
    <?php foreach ($courses as $course) : ?>
        <a class="block w-64 h-12 py-2 mb-2 ml-auto mr-auto text-center text-white shadow-md hover:opacity-90 md:w-72 rounded-2xl" href="course.php?id=<?php echo $course['id'] ?>" style='background-color:<?php printf("#%06X\n", mt_rand(0, 0x222222)); ?>'>
            <?php echo $course['coursename']; ?>
        </a>
        <br>
    <?php endforeach; ?>

</body>
<footer>
    <?php include_once('nav.inc.php'); ?>
</footer>

</html>