<?php
include_once(__DIR__ . "/inc/session.inc.php");
include_once(__DIR__ . "/classes/Question.php");
include_once(__DIR__ . "/classes/Course.php");

$fetchPData = new User();
$fetchPData->setUserID($userID);
$PData = $fetchPData->fetchPData($userID);


$question = new Question();

if (!empty($_POST)) {

    if (!empty($_POST['vraag'])) {
        $vraag = $_POST['vraag'];
    }

    if (!isset($error)) {
        try {
            $question->setOnderwerp(htmlspecialchars($_POST['onderwerp']));
            $question->setVraag(htmlspecialchars($_POST['vraag']));
            $question->setAntwoord1(htmlspecialchars($_POST['antwoord1']));
            $question->setAntwoord2(htmlspecialchars($_POST['antwoord2']));
            // methode
            $question->saveQuestion();
            //var_dump($question);
        } catch (\Throwable $th) {
            $error = $th->getMessage();
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="build/tailwind.css">
    <title>Meerkeuzevraag | peerhood</title>
</head>

<body>
    <div class="px-5 py-5 mb-10 gradient rounded-b-xl">
        <h1 class="text-3xl text-center text-white form_title">Dag <?php echo $PData['firstname'] ?></h1>
    </div>

    <h2 class="mb-5 text-2xl text-center form_title md:text-2xl">Meerkeuzevraag maken</h2>
    <form action="" method="POST">

        <?php if (isset($error)) : ?>
            <div class="mb-5 text-center form_error">
                <p>
                    <?php echo $error; ?>
                </p>
            </div>
        <?php endif; ?>

        <div>
            <input class="block mb-8 ml-auto mr-auto bg-transparent border-b border-black w-52 form_field sm:w-64 md:w-72" type="text" name="onderwerp" id="onderwerp" placeholder="Wat is het onderwerp?">
        </div>
        <div>
            <input class="block mb-8 ml-auto mr-auto bg-transparent border-b border-black w-52 form_field sm:w-64 md:w-72" type="text" name="vraag" id="vraag" placeholder="Wat is de vraag?">
        </div>
        <div>
            <input class="block mb-8 ml-auto mr-auto bg-transparent border-b border-black w-52 form_field sm:w-64 md:w-72" type="text" name="antwoord1" id="antwoord1" placeholder="Antwoord 1">
        </div>
        <div>
            <input class="block mb-8 ml-auto mr-auto bg-transparent border-b border-black w-52 form_field sm:w-64 md:w-72" type="text" name="antwoord2" id="antwoord2" placeholder="Antwoord 2">
        </div>
        <div>
            <input class="block h-12 mb-2 ml-auto mr-auto text-white shadow-md form_field w-52 sm:w-64 bg_secondary_btn md:w-72 rounded-2xl" type="submit" value="Voeg antwoord toe">
        </div>
        <div>
            <input class="block h-12 mb-2 ml-auto mr-auto text-white shadow-md w-52 sm:w-64 form_btn md:w-72 rounded-2xl" type="submit" value="Volgende stap">
        </div>
    </form>
</body>

<footer>
    <?php include_once('nav.inc.php'); ?>
</footer>

</html>