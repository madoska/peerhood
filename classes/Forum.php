<?php

include_once(__DIR__ . "/Db.php");

class Forum
{
    private $teamID;
    private $studentID;
    private $postContent;
    private $commentContent;

    public function postForum($studentID, $teamID, $postContent){
        $conn = Db::connect();
        $statement = $conn->prepare("INSERT INTO posts (user_id, team_id, content) VALUES (:userID, :teamID, :content)");
        $statement->bindParam(":userID", $studentID);
        $statement->bindParam(":teamID", $teamID);
        $statement->bindParam(":content", $postContent);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getForumPosts($teamID){
        $conn = Db::connect();
        $statement = $conn->prepare("SELECT * FROM posts INNER JOIN users ON users.id = posts.user_id WHERE team_id = :teamID ORDER BY posts.id DESC");
        $statement->bindParam(":teamID", $teamID);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getTeamID()
    {
        return $this->teamID;
    }

    public function setTeamID($teamID)
    {
        $this->teamID = $teamID;

        return $this;
    }

    public function getStudentID()
    {
        return $this->studentID;
    }

    public function setStudentID($studentID)
    {
        $this->teastudentIDmID = $studentID;

        return $this;
    }

    /**
     * Get the value of postContent
     */
    public function getPostContent()
    {
        return $this->postContent;
    }

    /**
     * Set the value of postContent
     */
    public function setPostContent($postContent): self
    {
        $this->postContent = $postContent;

        return $this;
    }

    /**
     * Get the value of commentContent
     */
    public function getCommentContent()
    {
        return $this->commentContent;
    }

    /**
     * Set the value of commentContent
     */
    public function setCommentContent($commentContent): self
    {
        $this->commentContent = $commentContent;

        return $this;
    }
}
