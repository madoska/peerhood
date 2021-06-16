<?php

include_once(__DIR__ . "/Db.php");

class Question {
    private $onderwerp;
    private $vraag;
    private $antwoord1;
    private $antwoord2;  
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

    public function getAntwoord1() {

        return $this->antwoord1;
    }
 
    public function setAntwoord1($antwoord1) {

        if(empty($antwoord1)) {
            throw new Exception("Het antwoord mag niet leeg zijn!");
        }

        $this->antwoord1 = $antwoord1;

        return $this;
    }

    public function getAntwoord2() {
        return $this->antwoord2;
    }

    public function setAntwoord2($antwoord2) {

        if(empty($antwoord2)) {
            throw new Exception("Het antwoord mag niet leeg zijn!");
        }

        $this->antwoord2 = $antwoord2;

        return $this;
    }

    public function saveQuestion() {
        // connectie
        $conn = Db::connect();

        // query
        $statement = $conn->prepare("insert into questions (course_id, question, antwoord1, antwoord2, solution_id) values (1, :vraag, :antwoord1, :antwoord2, 1)");
        
        // variabelen klaarzetten om te binden
        $vraag = $this->getVraag();
        $antwoord1 = $this->getAntwoord1();
        $antwoord2 = $this->getAntwoord2();
        
        // uitlezen wat er in de variabele zit en die zal op een veilige manier gekleefd worden
        $statement->bindParam(":vraag", $vraag);
        $statement->bindParam(":antwoord1", $antwoord1);
        $statement->bindParam(":antwoord2", $antwoord2);
       

        // als je geen execute doet dan wordt die query niet uitgevoerd
        $result = $statement->execute();
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
}