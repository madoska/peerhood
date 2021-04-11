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
    <title>PEERHOOD | <?php echo $course['coursename'] ?></title>
</head>
<body>
    <h1><?php echo $course['coursename'] ?></h1>
    <a href="question.php">Bekijk quizzen</a>
    <a href="teams.php?id=<?php echo $course['id'] ?>">Bekijk teams</a>
</body>
</html>