<?php
include_once(__DIR__ . "/inc/session.inc.php");
include_once(__DIR__ . "/classes/Course.php");
include_once(__DIR__ . "/classes/Team.php");

if (isset($_GET['id'])) {
    $teamID = $_GET['id'];
    $fetchTeamById = new Team();
    $fetchTeamById->setTeamID($teamID);
    $team = $fetchTeamById->fetchTeamById($teamID);

    $courseID = (int)$team['course_id'];

    $fetchStudentsByCourse = new Team();
    $fetchStudentsByCourse->setCourseID($courseID);
    $students = $fetchStudentsByCourse->fetchStudentsByCourse($courseID);
}

if(!empty($_POST['addstudent'])){
    $studentID = $_POST['student'];
    $addStudents = new Team();
    $addStudents->setStudentID($studentID);
    $done = $addStudents->addStudents($studentID, $teamID);

    echo "Student toegevoegd";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PEERHOOD | Studenten toevoegen</title>
</head>
<body>
    <h1>Voeg studenten toe</h1>
    <form action="" method="post">
        <?php foreach($students as $student): ?>
            <input type="checkbox" id="student" name="student" value="<?php echo $student['student_id'] ?>">
            <label for="student"><?php echo $student['firstname'] . " " . $student['lastname']?></label><br>
        <?php endforeach ?>
        <input type="submit" value="Voeg studenten toe" name="addstudent">
    </form>
</body>
</html>