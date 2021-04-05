<?php

include_once(__DIR__ . "/Db.php");

class Team
{
    private $teamID;
    private $courseID;
    private $teamname;

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

    public function fetchTeamsByCourse($courseID)
    {
        $conn = Db::connect();
        $statement = $conn->prepare("SELECT * FROM teams WHERE course_id = :courseID");
        $statement->bindParam(":courseID", $courseID);

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
}
