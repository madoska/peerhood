<?php
include_once(__DIR__ . "/inc/session.inc.php");
include_once(__DIR__ . "/classes/Course.php");
include_once(__DIR__ . "/classes/Team.php");
include_once(__DIR__ . "/classes/Forum.php");


$fetchPData = new User();
$fetchPData->setUserID($userID);
$PData = $fetchPData->fetchPData($userID);

$fetchCourses = new Course();
$fetchCourses->setUserID($userID);
$courses = $fetchCourses->fetchCoursesByAdmin($userID);

if (isset($_GET['id'])) {
    $courseID = $_GET['id'];
    $fetchCoursesById = new Course();
    $course = $fetchCoursesById->fetchCoursesById($courseID);
} else if (isset($_GET['teamid'])) {
    $courseID = $_GET['teamid'];
    $fetchTeam = new Team();
    $fetchTeam->setStudentID($userID);
    $fetchTeam->setCourseID($courseID);
    $team = $fetchTeam->fetchTeamByCourseForUser($userID, $courseID);

    $teamID = $team['team_id'];
    $fetchPosts = new Forum();
    $fetchPosts->setTeamID($teamID);
    $posts = $fetchPosts->getForumPosts($teamID);
}

// if (!empty($_POST['submitPost'])) {
//     if (!empty($_POST['post'])) {
//         $postContent = $_POST['post'];
//         $teamID = $team['team_id'];
//         $postForum = new Forum();
//         $postForum->setStudentID($userID);
//         $postForum->setTeamID($teamID);
//         $postForum->setPostContent($postContent);
//         $post = $postForum->postForum($userID, $teamID, $postContent);
//     }
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="build/tailwind.css">
    <title>PEERHOOD</title>
</head>

<body>
    <div class="px-5 py-5 mb-10 gradient rounded-b-xl">
        <h1 class="text-3xl text-center text-white form_title">Dag <?php echo $PData['firstname'] ?></h1>
    </div>

    <?php if ($role == 1) : ?>
        <h1 class="text-2xl text-center mb-14 form_title md:text-2xl"><?php echo $course['coursename'] . " (" . $course['code'] . ")" ?></h1>
        <a class="block w-64 h-12 py-2 mb-2 mb-5 ml-auto mr-auto text-center shadow-md form_field hover:opacity-90 dark_text bg-secondary-button md:w-72 rounded-2xl" href="question.php?id=<?php echo $course['id'] ?>">Nieuwe quiz</a>
        <a class="block w-64 h-12 py-2 mb-2 mb-5 ml-auto mr-auto text-center shadow-md form_field hover:opacity-90 dark_text bg-secondary-button md:w-72 rounded-2xl" href="teams.php?id=<?php echo $course['id'] ?>">Bekijk teams</a>
    <?php else : ?>
        <h1 class="text-2xl text-center mb-14 form_title md:text-2xl"><?php echo $team['teamname'] ?></h1>
        <div class="mb-5 text-center form_error">
            <p class="form_error">
            </p>
        </div>
        <form class="form" action="" method="post">
            <input id="postcontent" class="block w-64 mb-2 ml-auto mr-auto bg-transparent border-b border-black form_field md:w-72" type="text" name="post" placeholder="Schrijf een nieuwe post">
            <input type="hidden" name="userID" class="userID" value="<?php echo $userID ?>">
            <input type="hidden" name="teamID" class="teamID" value="<?php echo $teamID ?>">
            <br>
            <input class="block w-64 h-12 mb-10 ml-auto mr-auto text-white shadow-md form_btn md:w-72 rounded-2xl" type="submit" value="Post" name="submitPost" id="submitPost">
        </form>

        <div class="forum">
            <?php foreach ($posts as $post) : ?>
                <div class="px-5 py-5 mx-5 my-5 ml-auto mr-auto w-72 green-bg-light rounded-3xl sm:w-80 md:w-96 forumpost">
                    <div class="flex items-center poster">
                        <img class="w-16 h-16 mr-5 rounded-full" src="<?php echo $post['avatar'] ?>">
                        <h3 class="font-normal form_field"><?php echo $post['firstname'] . " " . $post['lastname'] ?></h3>
                    </div>
                    <article class="mt-5 mb-5 form_field"><?php echo $post['content'] ?></article>
                    <div class="flex pb-5 forumactions">
                        <div class="mr-5 form_field forumlikes">2 likes</div>
                        <div class="form_field forumreact">Reageren</div>
                    </div>

                    <div class="forumcomment">
                        <?php
                        $postID = $post['id'];
                        $getComments = new Forum();
                        $getComments->setPostID($postID);
                        $comments = $getComments->getComments($postID);
                        foreach ($comments as $comment) :
                        ?>
                            <div class="flex items-center poster">
                                <img class="w-16 h-16 mr-5 rounded-full" src="<?php echo $comment['avatar'] ?>">
                                <div class="flex flex-col w-40 px-3 py-3 bg-white sm:w-80 md:w-96 rounded-2xl">
                                    <h3 class="mb-2 font-normal form_field"><?php echo $comment['firstname'] . " " . $comment['lastname'] ?></h3>
                                    <article class="form_field"><?php echo $comment['content'] ?></article>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

        <div class="quiz">
            <a class="block w-64 h-12 pt-2 mb-10 ml-auto mr-auto text-center text-white shadow-md form_btn md:w-72 rounded-2xl" href="question.php?courseid=<?php echo $courseID ?>">Nieuwe quiz beschikbaar!</a>
        </div>
    <?php endif ?>

    <script>
        var submit = document.getElementById("submitPost");
        submit.addEventListener('click', (e) => {
            e.preventDefault();

            let postcontent = e.target.parentNode.querySelector('#postcontent').value;
            let userID = e.target.parentNode.querySelector('.userID').value;
            let teamID = e.target.parentNode.querySelector('.teamID').value;

            const formData = new FormData();

            formData.append('postcontent', postcontent);
            formData.append('userID', userID);
            formData.append('teamID', teamID);

            fetch('./ajax/postforum.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(result => {
                    let success = document.querySelector('.form_error');
                    success.innerHTML = "Je post is geplaatst!";

                    let post = document.getElementById('postcontent');
                    post.value  = '';
                })
        })
    </script>
</body>

<footer>
    <?php include_once('nav.inc.php'); ?>
</footer>

</html>