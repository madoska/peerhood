<?php
include_once(__DIR__ . "/inc/session.inc.php");
include_once(__DIR__ . "/classes/Question.php");

$fetchPData = new User();
$fetchPData->setUserID($userID);
$PData = $fetchPData->fetchPData($userID);

if ($role === "2") {
    $course_id = $_GET['courseid'];
    $fetchQuestion = new Question();
    $fetchQuestion->setCourse_id($course_id);
    $q = $fetchQuestion->fetchLatestQuizByTeam($course_id);

    $question_id = $q['id'];
    $checkAnswer = new Question();
    $checkAnswer->setQuestionId($question_id);
    $checkAnswer->setUserId($userID);
    $c = $checkAnswer->checkIfAnswered($userID, $question_id);

    $fetchAnswers = new Question();
    $fetchAnswers->setCourse_id($course_id);
    $a = $fetchAnswers->fetchQuestions($course_id);
    shuffle($a);

    if (isset($_POST['submitAnswer'])) {
        $question_id = $q['id'];
        $answer = $_POST['radio'];
        $submitAnswer = new Question();
        $submitAnswer->setQuestionId($question_id);
        $submitAnswer->setUserId($userID);
        $submitAnswer->setAnswer($answer);
        $submit = $submitAnswer->submitAnswer($question_id, $userID, $answer);
    }
}



$question = new Question();

if (!empty($_POST['submitQuestion'])) {
    $vraag = $_POST['vraag'];

    try {
        $vraag = $_POST['vraag'];
        $correctantwoord = $_POST['correctantwoord'];
        $foutantwoord1 = $_POST['foutantwoord1'];
        $foutantwoord2 = $_POST['foutantwoord2'];
        $course_id = $_GET['id'];

        $question->setCourse_id($course_id);
        $question->setVraag($vraag);
        $question->setCorrectantwoord($correctantwoord);
        $question->setFoutantwoord1($foutantwoord1);
        $question->setFoutantwoord2($foutantwoord2);
        // methode
        $question->saveQuestion($course_id, $vraag, $correctantwoord, $foutantwoord1, $foutantwoord2);
    } catch (\Throwable $th) {
        $error = $th->getMessage();
    }
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
    <title>PEERHOOD | Quiz</title>
</head>

<body>
    <div class="px-5 py-5 mb-10 gradient rounded-b-xl">
        <h1 class="text-3xl text-center text-white form_title">Dag <?php echo $PData['firstname'] ?></h1>
    </div>

    <?php if ($role === "1") : ?>
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
                <input class="block mb-8 ml-auto mr-auto bg-transparent border-b border-black w-52 form_field sm:w-64 md:w-72" type="text" name="vraag" id="vraag" placeholder="Wat is de vraag?">
            </div>
            <div>
                <input class="block mb-8 ml-auto mr-auto bg-transparent border-b border-black w-52 form_field sm:w-64 md:w-72" type="text" name="correctantwoord" id="correctantwoord" placeholder="Correct antwoord">
            </div>
            <div>
                <input class="block mb-8 ml-auto mr-auto bg-transparent border-b border-black w-52 form_field sm:w-64 md:w-72" type="text" name="foutantwoord1" id="foutantwoord1" placeholder="Fout antwoord 1">
            </div>
            <div>
                <input class="block mb-8 ml-auto mr-auto bg-transparent border-b border-black w-52 form_field sm:w-64 md:w-72" type="text" name="foutantwoord2" id="foutantwoord2" placeholder="Fout antwoord 2">
            </div>
            <div>
                <input class="block h-12 mb-2 ml-auto mr-auto text-white shadow-md w-52 sm:w-64 form_btn md:w-72 rounded-2xl" type="submit" name="submitQuestion" value="Post quiz">
            </div>
        </form>

    <?php else : ?>
        <?php if (isset($error)) : ?>
            <div class="mb-5 text-center form_error">
                <p class="form_error">
                    <?php echo $error; ?>
                </p>
            </div>
        <?php endif; ?>

        <?php if ($c == false) : ?>
            <h2><?php echo $q['question'] ?></h2>

            <form action="" method="POST">
                <input type="radio" id="answer1" name="radio" value="<?php echo $randomA = $a[0];  ?>">
                <label for="answer1"><?php echo $randomA = $a[0]; ?></label><br>
                <input type="radio" id="answer2" name="radio" value="<?php echo $randomA = $a[1];  ?>">
                <label for="answer2"><?php echo $randomA = $a[1]; ?></label><br>
                <input type="radio" id="answer3" name="radio" value="<?php echo $randomA = $a[2];  ?>">
                <label for="answer3"><?php echo $randomA = $a[2]; ?></label><br>
                <div>
                    <input class="block h-12 mb-2 ml-auto mr-auto text-white shadow-md w-52 sm:w-64 form_btn md:w-72 rounded-2xl submitAnswer" name="submitAnswer" type="submit" value="Indienen">
                </div>
            </form>
        <?php endif ?>
    <?php endif ?>
</body>

<footer>
    <?php include_once('nav.inc.php'); ?>
</footer>

</html>