<?php
include_once(__DIR__ . "/inc/session.inc.php");
include_once(__DIR__ . "/classes/Course.php");

$fetchPData = new User();
$fetchPData->setUserID($userID);
$PData = $fetchPData->fetchPData($userID);

$fetchCourses = new Course();
$fetchCourses->setUserID($userID);
$courses = $fetchCourses->fetchCoursesByAdmin($userID);

if (isset($_GET['id'])) {
    $courseID = $_GET['id'];
    $fetchCoursesById = new Course();
    $course = $fetchCoursesById->fetchCoursesById($courseID);
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
    <title>PEERHOOD | <?php echo $course['coursename'] ?></title>
</head>

<body>
    <div class="px-5 py-5 mb-10 gradient rounded-b-xl">
        <h1 class="text-3xl text-center text-white form_title">Dag <?php echo $PData['firstname'] ?></h1>
    </div>

    <h1 class="text-2xl text-center mb-14 form_title md:text-2xl"><?php echo $course['coursename'] ?></h1>
    <a class="block w-64 h-12 py-2 mb-2 mb-5 ml-auto mr-auto text-center shadow-md hover:opacity-90 dark_text bg-secondary-button md:w-72 rounded-2xl" href="question.php">Bekijk quizzen</a>
    <a class="block w-64 h-12 py-2 mb-2 ml-auto mr-auto text-center shadow-md hover:opacity-90 dark_text bg-secondary-button md:w-72 rounded-2xl" href="teams.php?id=<?php echo $course['id'] ?>">Bekijk teams</a>
</body>

<footer>
    <?php include_once('nav.inc.php'); ?>
</footer>

</html>