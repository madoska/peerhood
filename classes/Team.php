<?php

include_once(__DIR__ . "/Db.php");

class Team
{
    private $teamID;
    private $courseID;
    private $teamname;
    private $studentID;

    public function getTeamID()
    {
        return $this->teamID;
    }

    public function setTeamID($teamID)
    {
        $this->teamID = $teamID;

        return $this;
    }

    public function getCourseID()
    {
        return $this->courseID;
    }

    public function setCourseID($courseID)
    {
        $this->courseID = $courseID;

        return $this;
    }

    public function getTeamname()
    {
        return $this->teamname;
    }

    public function setTeamname($teamname)
    {
        $this->teamname = $teamname;

        return $this;
    }

    public function getStudentID()
    {
        return $this->studentID;
    }

    public function setStudentID($studentID)
    {
        $this->studentID = $studentID;

        return $this;
    }

    public function fetchTeamsByCourse($courseID)
    {
        $conn = Db::connect();
        $statement = $conn->prepare("SELECT * FROM teams WHERE course_id = :courseID");
        $statement->bindParam(":courseID", $courseID);

        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function fetchTeamById($teamID){
        $conn = Db::connect();
        $statement = $conn->prepare("SELECT * FROM teams WHERE id = :teamID");
        $statement->bindParam(":teamID", $teamID);

        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function fetchMembersByTeamId($teamID){
        $conn = Db::connect();
        $statement = $conn->prepare("SELECT firstname, lastname FROM members INNER JOIN users ON members.student_id = users.id WHERE team_id = :teamID");
        $statement->bindParam(":teamID", $teamID);

        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function createTeam($courseID, $teamname)
    {
        $conn = Db::connect();
        $statement = $conn->prepare("INSERT INTO teams (course_id, teamname) VALUES(:courseID, :teamname)");
        $statement->bindParam(":courseID", $courseID);
        $statement->bindParam(":teamname", $teamname);
        $result = $statement->execute();
        return $result;
    }

    public function fetchStudentsByCourse($courseID){
        $conn = Db::connect();
        $statement = $conn->prepare("SELECT * FROM students INNER JOIN users ON students.student_id = users.id WHERE course_id = :courseID");
        $statement->bindParam(":courseID", $courseID);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function addStudents($studentID, $teamID){
        $conn = Db::connect();
        $statement = $conn->prepare("INSERT INTO members (student_id, team_id) VALUES(:studentID, :teamID)");
        $statement->bindParam(":studentID", $studentID);
        $statement->bindParam(":teamID", $teamID);
        $result = $statement->execute();
        return $result;
    }
    public function fetchStudentsGroups($courseID){
        $conn = Db::connect();
        $statement = $conn->prepare("SELECT team_id FROM members INNER JOIN teams ON members.team_id = teams.id WHERE course_id = :courseID");
        $statement->bindParam(":courseID", $courseID);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


}
