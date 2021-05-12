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

if (!empty($_POST['addstudent'])) {
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="build/tailwind.css">
    <title>PEERHOOD | Studenten toevoegen</title>
</head>

<body>
    <div class="px-5 py-5 mb-10 gradient rounded-b-xl">
        <h1 class="text-3xl text-center text-white form_title">Dag</h1>
    </div>

    <h1 class="mb-10 text-2xl text-center form_title md:text-2xl">Voeg studenten toe</h1>
    <form action="" method="post">
        <?php foreach ($students as $student) : ?>
            <input type="checkbox" id="student" name="student" value="<?php echo $student['student_id'] ?>">
            <label for="student"><?php echo $student['firstname'] . " " . $student['lastname'] ?></label><br>
        <?php endforeach ?>
        <input class="block h-12 mb-2 ml-auto mr-auto text-center text-white shadow-md w-52 sm:w-64 form_btn md:w-72 rounded-2xl" type="submit" value="Voeg studenten toe" name="addstudent">
    </form>
</body>

<footer>
    <?php include_once('nav.inc.php'); ?>
</footer>

</html>