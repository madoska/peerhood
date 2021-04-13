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
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="build/tailwind.css">
    <title>PEERHOOD | Home</title>
</head>

<body>
    <h1 class="form_title text-2xl ml-10 mb-5 md:text-2xl">Jouw cursussen</h1>
    <div class="bg-plus inline-block px-4 py-1 rounded-2xl">
    <a href="addcourse.php"><img src="./images/+.png"></a>
    </div>
    <?php foreach ($courses as $course) : ?>
        <a href="course.php?id=<?php echo $course['id'] ?>" class="ml-10 text-center form_btn py-2 w-64 md:w-72 h-12 shadow-md rounded-2xl text-white mb-2 block">
            <?php echo $course['coursename']; ?>
        </a>
        <br>
    <?php endforeach; ?>
</body>

</html>