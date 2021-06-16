<?php
include_once(__DIR__ . "./../classes/Forum.php");

if (!empty($_POST)) {
    if (!empty($_POST['postcontent'])) {
        $postContent = $_POST['postcontent'];
        $teamID = $_POST['teamID'];
        $userID = $_POST['userID'];

        $postForum = new Forum();
        $postForum->setStudentID($userID);
        $postForum->setTeamID($teamID);
        $postForum->setPostContent($postContent);
        $post = $postForum->postForum($userID, $teamID, $postContent);

        $response = [
            'status' => 'success',
            'message' => 'posted',
            'body' => $postForum->getPostContent()
        ];

        header('Content-Type: application/json');
        echo json_encode($response); // { 'status'  :  'Succes  }
    }
}
