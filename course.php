<?php
include_once(__DIR__ . "/inc/session.inc.php");
include_once(__DIR__ . "/classes/Course.php");

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
    <h1 class="w-2/3 ml-10 text-2xl mb-14 form_title md:text-2xl"><?php echo $course['coursename'] ?></h1>
    <a class="bg-secondary" href="question.php">Bekijk quizzen</a>
    <a class="block w-64 h-12 py-2 mb-2 ml-10 text-center text-white shadow-md bg-secondary-button md:w-72 rounded-2xl" href="teams.php?id=<?php echo $course['id'] ?>">Bekijk teams</a>
</body>
</html>