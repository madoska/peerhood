<?php

include_once(__DIR__ . "/Db.php");

class User {
        private $id;
        private $email;
        private $password;

        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }
        

        public function setEmail($email) {

                if(empty($email)) {
                        throw new Exception("Email mag niet leeg zijn!");
                }
                $this->email = $email;

                return $this;
        }

        public function getEmail() {
                return $this->email;
        }

        public function setPassword($password) {

            if(empty($password)) {
                    throw new Exception("Wachtwoord mag niet leeg zijn!");
            }

            return $this;
    }

        public function getPassword() {
            return $this->password;
    }

        public function checkLogin($email, $password) {
            //db conn
            $conn = Db::connect();
            //insert query
            $statement = $conn->prepare("select * from users where email = :email");
            $statement->bindParam(":email", $email);
    
            //return result
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if(empty($result)) {
                return false;
            }
            $hash = $result["password"];
            if(password_verify($password, $hash)) {
                return true;
            }else {
                return false;
            }
        }

        public function idFromSession($email) {
            //db conn
            $conn = Db::connect();
            //insert query
            $statement = $conn->prepare("select id from users where email = :email");
            $statement->bindParam(":email", $email);
    
            //return result
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
}