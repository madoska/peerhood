<?php

include_once(__DIR__ . "/Db.php");

class Course {
        
    private $admin_id;
    private $coursename;
    private $code;



    /**
     * Get the value of admin_id
     */ 
    public function getAdmin_id()
    {
        return $this->admin_id;
    }

    /**
     * Set the value of admin_id
     *
     * @return  self
     */ 
    public function setAdmin_id($admin_id)
    {
        $this->admin_id = $admin_id;

        return $this;
    }

    /**
     * Get the value of coursename
     */ 
    public function getCoursename()
    {
        return $this->coursename;
    }

    /**
     * Set the value of coursename
     *
     * @return  self
     */ 
    public function setCoursename($coursename)
    {
        $this->coursename = $coursename;

        return $this;
    }

    /**
     * Get the value of code
     */ 
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */ 
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    public function createCourse() {
        //db conn
        $conn = Db::connect();
        //insert query
        $statement = $conn->prepare("insert into courses (admin_id,coursename,code) VALUES(:admin_id , :coursename , :code)");
        $statement->bindParam(":admin_id", $admin_id);
        $statement->bindParam(":coursename", $coursename);
        $statement->bindParam(":code", $code);

        //return result
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if(empty($result)) {
            return false;
        }
    }
}