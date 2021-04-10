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
    <title>PEERHOOD | <?php echo $team['teamname'] ?></title>
</head>
<body>
    <h1><?php echo $team['teamname'] ?></h1>
    <?php foreach($members as $member): ?>
        <li><?php echo $member['firstname'] . " " . $member['lastname'] ?></li>
    <?php endforeach; ?>
    <a href="editteam.php?id=<?php echo $team['id'] ?>" class="">
        Voeg studenten toe
    </a>
</body>
</html>