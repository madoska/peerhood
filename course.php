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
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="build/tailwind.css">
    <title>PEERHOOD</title>
</head>

<body>
    <div class="px-5 py-5 mb-10 gradient rounded-b-xl">
        <h1 class="text-3xl text-center text-white form_title">Dag <?php echo $PData['firstname'] ?></h1>
    </div>

    <?php if ($role == 1) : ?>
        <h1 class="text-2xl text-center mb-14 form_title md:text-2xl"><?php echo $course['coursename'] ?></h1>
        <a class="block w-64 h-12 py-2 mb-2 mb-5 ml-auto mr-auto text-center shadow-md form_field hover:opacity-90 dark_text bg-secondary-button md:w-72 rounded-2xl" href="question.php">Bekijk quizzen</a>
        <a class="block w-64 h-12 py-2 mb-2 ml-auto m vr-auto text-center shadow-md form_field hover:opacity-90 dark_text bg-secondary-button md:w-72 rounded-2xl" href="teams.php?id=<?php echo $course['id'] ?>">Bekijk teams</a>
    <?php else : ?>
        <h1 class="text-2xl text-center mb-14 form_title md:text-2xl"><?php echo $team['teamname'] ?></h1>
        <div class="mb-5 text-center form_error">
            <p class="form_error">
                Je post is geplaatst!
            </p>
        </div>
        <form class="form" action="" method="post">
            <input id="postcontent" class="block w-64 mb-2 ml-auto mr-auto bg-transparent border-b border-black form_field md:w-72" type="text" name="post" placeholder="Schrijf een nieuwe post">
            <input type="hidden" name="userID" class="userID" value="<?php echo $userID ?>">
            <input type="hidden" name="teamID" class="teamID" value="<?php echo $teamID ?>">
            <br>
            <input class="block w-64 h-12 mb-2 ml-auto mr-auto text-white shadow-md form_btn md:w-72 rounded-2xl" type="submit" value="Post" name="submitPost" id="submitPost">
        </form>


        <?php foreach ($posts as $post) : ?>
            <div class="forumpost">
                <div class="poster"> <img src="<?php echo $post['avatar'] ?>">
                    <h3><?php echo $post['firstname'] . " " . $post['lastname'] ?></h3>
                </div>
                <article><?php echo $post['content'] ?></article>
                <div class="forumactions">
                    <div class="forumlikes">2 likes</div>
                    <div class="forumreact">Reageren</div>
                </div>
            </div>
        <?php endforeach ?>
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
                    let newPost = document.createElement('div');
                    newPost.classList.add("forumpost");

                    let newPoster = document.createElement('div');
                    newPost.classList.add("poster");

                    let newPosterImg = document.createElement('img');
                    newPosterImg.src = "<?php echo $post['avatar'] ?>";
                    newPosterImg.style.cssText = "width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;";
                    let newPosterName = document.createElement('h3');
                    newPosterName.innerHTML = "<?php echo $post['firstname'] . " " . $post['lastname'] ?>";

                    newPoster.appendChild(newPosterImg);
                    newPoster.appendChild(newPosterName);

                    newPost.appendChild(newPoster);

                    let newPostContent = document.createElement('article');
                    newPostContent.innerHTML = result.body;

                    newPost.appendChild(newPostContent);

                    let firstPost = document.querySelector('.forumpost');

                    document.body.insertBefore(newPost, firstPost);

                    document.body.appendChild(newPost);
                })
        })
    </script>
</body>

<footer>
    <?php include_once('nav.inc.php'); ?>
</footer>

</html>