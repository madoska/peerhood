<?php

include_once(__DIR__ . "/classes/Question.php");

$question = new Question();

if(!empty($_POST)) {

    if(!empty($_POST['vraag'])) {
        $vraag = $_POST['vraag'];
    }

    if(!isset($error)) {
        try {
            $question->setOnderwerp(htmlspecialchars($_POST['onderwerp']));
            $question->setVraag(htmlspecialchars($_POST['vraag']));
            $question->setAntwoord1(htmlspecialchars($_POST['antwoord1']));
            $question->setAntwoord2(htmlspecialchars($_POST['antwoord2']));
            // methode
            $question->saveQuestion();
            header('Location: index.php');
        }
        catch (\Throwable $th) {
            $error = $th->getMessage();
        }
    }

}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meerkeuzevraag | peerhood</title>
</head>
<body>

<h2>Meerkeuzevraag maken</h2>
<form action="" method="POST">

<?php if(isset($error)) : ?>
    <div class="form__error">
		<p>
		    <?php echo $error; ?>
		</p>
	</div>
<?php endif; ?>

<div>
    <input type="text" name="onderwerp" id="onderwerp" placeholder="Wat is het onderwerp?">
</div>
<div>
    <input type="text" name="vraag" id="vraag" placeholder="Wat is de vraag?">
</div>
<div>
    <input type="text" name="antwoord1" id="antwoord1" placeholder="Antwoord 1">
</div>
<div>
    <input type="text" name="antwoord2" id="antwoord2" placeholder="Antwoord 2">
</div>
<div>
    <input type="submit" value="Volgende stap">
</div>
</form>
</body>
</html>
