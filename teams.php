<?php
include_once(__DIR__ . "/inc/session.inc.php");
include_once(__DIR__ . "/classes/Course.php");
include_once(__DIR__ . "/classes/Team.php");

$fetchPData = new User();
$fetchPData->setUserID($userID);
$PData = $fetchPData->fetchPData($userID);

if (isset($_GET['id'])) {
    $courseID = $_GET['id'];
    $fetchCoursesById = new Course();
    $course = $fetchCoursesById->fetchCoursesById($courseID);

    $fetchTeamsByCourse = new Team();
    $fetchTeamsByCourse->setCourseID($courseID);
    $teams = $fetchTeamsByCourse->fetchTeamsByCourse($courseID);
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
    <title>PEERHOOD | <?php echo $course['coursename'] ?> Groups</title>
</head>

<body>
    <div class="px-5 py-5 mb-10 gradient rounded-b-xl">
        <h1 class="text-3xl text-center text-white form_title">Dag <?php echo $PData['firstname'] ?></h1>
    </div>

    <h1 class="text-2xl text-center mb-14 form_title md:text-2xl"><?php echo $course['coursename'] ?></h1>
    <?php foreach ($teams as $team) : ?>
        <a class="block w-64 h-12 py-2 ml-auto mr-auto text-center shadow-md form_field hover:opacity-90 dark_text bg-secondary-button md:w-72 rounded-2xl" href="team.php?id=<?php echo $team['id'] ?>">
            <?php echo $team['teamname']; ?>
        </a>
        <br>
    <?php endforeach; ?>
    <a class="block w-64 h-12 py-2 ml-auto mr-auto text-center text-white shadow-md hover:opacity-90 form_btn md:w-72 rounded-2xl" href="addteam.php?id=<?php echo $course['id'] ?>">Nieuw team</a>
</body>

<footer>
    <?php include_once('nav.inc.php'); ?>
</footer>

</html>