<?php
include_once(__DIR__ . "/inc/session.inc.php");
include_once(__DIR__ . "/classes/Course.php");
include_once(__DIR__ . "/classes/Team.php");

if (isset($_GET['id'])) {
    $teamID = $_GET['id'];
    $fetchTeamById = new Team();
    $fetchTeamById->setTeamID($teamID);
    $team = $fetchTeamById->fetchTeamById($teamID);

    $fetchMembersByTeamId = new Team();
    $fetchMembersByTeamId->setTeamID($teamID);
    $members = $fetchMembersByTeamId->fetchMembersByTeamId($teamID);
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
    <title>PEERHOOD | <?php echo $team['teamname'] ?></title>
</head>

<body>
    <div class="px-5 py-5 mb-10 gradient rounded-b-xl">
        <h1 class="text-3xl text-center text-white form_title">Dag</h1>
    </div>

    <h1 class="mb-10 text-2xl text-center form_title md:text-2xl"><?php echo $team['teamname'] ?></h1>
    <div class="mb-5">
        <?php foreach ($members as $member) : ?>
            <li class="py-2 text-center list-none form_field"><?php echo $member['firstname'] . " " . $member['lastname'] ?></li>
        <?php endforeach; ?>
    </div>
    <a class="block h-12 pt-2 mb-2 ml-auto mr-auto text-center text-white shadow-md w-52 sm:w-64 form_btn md:w-72 rounded-2xl" href="editteam.php?id=<?php echo $team['id'] ?>" class="">
        Voeg studenten toe
    </a>
</body>

<footer>
    <?php include_once('nav.inc.php'); ?>
</footer>

</html>