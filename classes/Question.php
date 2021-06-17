<?php

include_once(__DIR__ . "/Db.php");

class Question {
    private $onderwerp;
    private $vraag;
    private $correctantwoord;
    private $foutantwoord1;
    private $foutantwoord2;  
    private $course_id;
    private $solution_id;

    public function getOnderwerp() {
        return $this->onderwerp;
    }

    public function setOnderwerp($onderwerp) {

        if(empty($onderwerp)) {
            throw new Exception("Het onderwerp mag niet leeg zijn!");
        }

        $this->onderwerp = $onderwerp;

        return $this;
    }

    public function getVraag() {
        return $this->vraag;
    }

    public function setVraag($vraag) {

        if(empty($vraag)) {
            throw new Exception("De vraag mag niet leeg zijn!");
        }

        $this->vraag = $vraag;

        return $this;
    }

    public function getFoutantwoord1() {

        return $this->foutantwoord1;
    }
 
    public function setFoutantwoord1($foutantwoord1) {

        if(empty($foutantwoord1)) {
            throw new Exception("Het antwoord mag niet leeg zijn!");
        }

        $this->foutantwoord1 = $foutantwoord1;

        return $this;
    }

    public function getFoutantwoord2() {
        return $this->foutantwoord2;
    }

    public function setFoutantwoord2($foutantwoord2) {

        if(empty($foutantwoord2)) {
            throw new Exception("Het foutantwoord mag niet leeg zijn!");
        }

        $this->foutantwoord2 = $foutantwoord2;

        return $this;
    }

    public function saveQuestion($course_id, $vraag, $correctantwoord, $foutantwoord1, $foutantwoord2) {
        $conn = Db::connect();
        $statement = $conn->prepare("insert into questions (course_id, question, correct_answer, false_answer1, false_answer2) values (:courseID, :question, :correct_answer, :false_answer1, :false_answer2)");
        $statement->bindParam(":courseID", $course_id);
        $statement->bindParam(":question", $vraag);
        $statement->bindParam(":correct_answer", $correctantwoord);
        $statement->bindParam(":false_answer1", $foutantwoord1);
        $statement->bindParam(":false_answer2", $foutantwoord2);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
}

    public function getCourse_id() {
        return $this->course_id;
    }

    public function setCourse_id($course_id) {
        $this->course_id = $course_id;

        return $this;
    }

    public function getSolution_id() {
        return $this->solution_id;
    }

    public function setSolution_id($solution_id) {
        $this->solution_id = $solution_id;

        return $this;
    }

    public function fetchLatestQuizByTeam($course_id){
        $conn = Db::connect();
        $statement = $conn->prepare("SELECT * FROM questions WHERE questions.course_id = :courseID ORDER BY questions.id DESC LIMIT 1");
        $statement->bindParam(":courseID", $course_id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function fetchQuestions($course_id){
        $conn = Db::connect();
        $statement = $conn->prepare("SELECT correct_answer, false_answer1, false_answer2 FROM questions WHERE questions.course_id = :courseID ORDER BY questions.id DESC LIMIT 1");
        $statement->bindParam(":courseID", $course_id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Get the value of correctantwoord
     */
    public function getCorrectantwoord()
    {
        return $this->correctantwoord;
    }

    /**
     * Set the value of correctantwoord
     */
    public function setCorrectantwoord($correctantwoord)
    {
        if(empty($correctantwoord)) {
            throw new Exception("Het antwoord mag niet leeg zijn!");
        }

        $this->correctantwoord = $correctantwoord;

        return $this;
    }
}