<?php
include_once(__DIR__ . "/inc/session.inc.php");
include_once(__DIR__ . "/classes/Team.php");
include_once(__DIR__ . "/classes/Course.php");

if (isset($_GET['id'])) {
    $courseID = $_GET['id'];
    $fetchCoursesById = new Course();
    $course = $fetchCoursesById->fetchCoursesById($courseID);
    
    if (isset($_POST['submit'])) {
        if (!empty($_POST['teamname'])) {
            $teamname = $_POST['teamname'];

            $team = new Team();
            $team->setCourseID($courseID);
            $team->setTeamname($teamname);
            $result = $team->createTeam($courseID, $teamname);
            if ($result === true) {
                echo('success');
            } else if ($result == false) {
                echo('stalled');
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PEERHOOD | Nieuwe teams</title>
</head>

<body>
    <?php if ($role == 1) { ?>
        <form class="form" action="" method="post">
            <label for="">Naam groep</label>
            <br>
            <input type="text" name="teamname">
            <br>
            <input type="submit" value="Maak nieuwe team" name="submit">
        </form>
    <?php } else { ?>
        <p>Alleen docenten kunnen teams aanmaken!</p>
    <?php } ?>
    <a href="index.php">terug</a>
</body>

</html>