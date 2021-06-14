<?php
include_once(__DIR__ . "/inc/session.inc.php");
include_once(__DIR__ . "/classes/Course.php");

$fetchPData = new User();
$fetchPData->setUserID($userID);
$PData = $fetchPData->fetchPData($userID);

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
    <title>PEERHOOD | Leaderboard</title>
</head>

<body>
    <h2 class="mt-10 text-2xl text-center mb-14 form_title md:text-2xl">Leaderboard</h2>

    <div class="flex items-end justify-center space-x-3">
        <div class="text-center">
            <p class="mb-1">Team 6</p>
            <p class="w-20 h-20 pt-4 text-3xl font-bold text-white bg-green-300 rounded-tl-lg rounded-tr-lg">2</p>
        </div>

        <div class="text-center">
            <p class="mb-1">Wombats</p>
            <p class="w-20 h-24 pt-4 text-3xl font-bold text-white bg-green-400 rounded-tl-lg rounded-tr-lg">1</p>
        </div>

        <div class="text-center">
            <p class="mb-1">Chickens</p>
            <p class="w-20 h-16 pt-4 text-3xl font-bold text-white bg-green-300 rounded-tl-lg rounded-tr-lg">3</p>
        </div>
    </div>

    <div class="h-screen py-5 bg-green-300">
        <div class="flex justify-center">
            <div class="flex justify-center w-64 mb-5 space-x-12">
                <p class="w-10">4</p>
                <p class="w-40">The Winners</p>
                <p class="w-20 font-bold">413</p>
            </div>
        </div>

        <div class="flex justify-center">
            <div class="flex justify-center w-64 mb-5 space-x-12">
                <p class="w-10">5</p>
                <p class="w-40">Quizzers</p>
                <p class="w-20 font-bold">386</p>
            </div>
        </div>

        <div class="flex justify-center">
            <div class="flex justify-center w-64 mb-5 space-x-12">
                <p class="w-10">6</p>
                <p class="w-40">Laura & Jan</p>
                <p class="w-20 font-bold">374</p>
            </div>
        </div>

        <div class="flex justify-center">
            <div class="flex justify-center w-64 mb-5 space-x-12">
                <p class="w-10">7</p>
                <p class="w-40">The Boyz</p>
                <p class="w-20 font-bold">370</p>
            </div>
        </div>

        <div class="flex justify-center">
            <div class="flex justify-center w-64 mb-5 space-x-12">
                <p class="w-10">8</p>
                <p class="w-40">The A Team</p>
                <p class="w-20 font-bold">355</p>
            </div>
        </div>

        <div class="flex justify-center">
            <div class="flex justify-center w-64 mb-5 space-x-12">
                <p class="w-10">9</p>
                <p class="w-40">The Champions</p>
                <p class="w-20 font-bold">324</p>
            </div>
        </div>

        <div class="flex justify-center">
            <div class="flex justify-center w-64 mb-5 space-x-12">
                <p class="w-10">10</p>
                <p class="w-40">FC De Kampioen</p>
                <p class="w-20 font-bold">298</p>
            </div>
        </div>
    </div>

</body>
<footer>
    <?php include_once('nav.inc.php'); ?>
</footer>

</html>