<?php
include_once(__DIR__ . "/inc/session.inc.php");
include_once(__DIR__ . "/classes/Course.php");

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
    <title>PEERHOOD | Home</title>
</head>

<body>
    <h1>Jouw cursussen</h1>
    <?php foreach ($courses as $course) : ?>
        <a href="course.php?id=<?php echo $course['id'] ?>" class="">
            <?php echo $course['coursename']; ?>
        </a>
        <br>
    <?php endforeach; ?>
</body>

</html>