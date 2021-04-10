<?php

include_once(__DIR__ . "/Db.php");

class Course
{

    private $userID;
    private $courseID;
    private $coursename;
    private $code;

    public function getUserID()
    {
        return $this->userID;
    }

    public function setUserID($userID)
    {
        $this->userID = $userID;

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

    public function getCoursename()
    {
        return $this->coursename;
    }

    public function setCoursename($coursename)
    {
        $this->coursename = $coursename;

        return $this;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    public function createCourse($userID, $coursename, $code)
    {
        //db conn
        $conn = Db::connect();
        //insert query
        $statement = $conn->prepare("INSERT INTO courses (admin_id, coursename, code) VALUES(:userID , :coursename , :code)");
        $statement->bindParam(":userID", $userID);
        $statement->bindParam(":coursename", $coursename);
        $statement->bindParam(":code", $code);

        //return result
        $result = $statement->execute();
        return $result;
    }

    public function fetchCoursesByAdmin($userID)
    {
        $conn = Db::connect();
        $statement = $conn->prepare("SELECT id, coursename FROM courses WHERE admin_id = :userID");
        $statement->bindParam(":userID", $userID);

        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function fetchCoursesById($courseID)
    {
        $conn = Db::connect();
        $statement = $conn->prepare("SELECT * FROM courses WHERE id = :courseID");
        $statement->bindParam(":courseID", $courseID);

        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
