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
    <div class="px-5 py-5 mb-10 bg-gray-400 rounded-b-xl">
        <h2 class="ml-10 text-2xl text-white form_title">Een overzicht van jouw vakken</h2>
    </div>
    <div class="flex items-center mb-10">
        <h2 class="w-2/3 mb-5 ml-10 text-2xl form_title md:text-2xl">Jouw cursussen</h2>
        <div class="flex items-center justify-center w-1/3">
            <div class="w-12 h-12 text-center bg-plus rounded-2xl">
                <a href="addcourse.php">
                    <span class="text-4xl font-bold text-white">+</span>
                </a>
            </div>
        </div>
    </div>
    <?php foreach ($courses as $course) : ?>
        <a href="course.php?id=<?php echo $course['id'] ?>" class="block w-64 h-12 py-2 mb-2 ml-10 text-center text-white shadow-md form_btn md:w-72 rounded-2xl">
            <?php echo $course['coursename']; ?>
        </a>
        <br>
    <?php endforeach; ?>
</body>

</html>