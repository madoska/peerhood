<?php
include_once(__DIR__ . "/inc/session.inc.php");
include_once(__DIR__ . "/classes/Course.php");
include_once(__DIR__ . "/classes/Team.php");

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
    <title>PEERHOOD | <?php echo $course['coursename'] ?> Groups</title>
</head>
<body>
    <h1><?php echo $course['coursename'] ?></h1>
    <?php foreach ($teams as $team) : ?>
        <a href="team.php?id=<?php echo $team['id'] ?>" class="">
            <?php echo $team['teamname']; ?>
        </a>
        <br>
    <?php endforeach; ?>
    <a href="addteam.php?id=<?php echo $course['id'] ?>">Nieuwe team</a>
</body>
</html>