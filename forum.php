<?php
session_start();
require ('connect_db.php');

if(isset($_POST['add-comment'])){
    $pubdate = date_create()->format('Y-m-d H:i:s');
    $query = "INSERT INTO forum (text, pubdate, author_id) VALUES ('$_POST[comment]','$pubdate','$_SESSION[user_id]')";
    mysqli_query($con, $query);
}


?>
<html>

<head>
    <title>Главная</title>
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans:300,400,500,700&display=swap&subset=cyrillic"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://placenevents/normalize.css">
    <link rel="stylesheet" href="http://placenevents/main.css">
</head>

<body>
<div class="main-container">
    <?php include('header.php'); ?>

    
    <section class ="comment-section">

        <?php
        $query = "SELECT * FROM users WHERE login = '$_SESSION[login]'";
        $result = mysqli_query($con, $query);
        $user_status = mysqli_fetch_assoc($result)['status'];
        if(isset($_SESSION['user_type']) and ($user_status  == true)){
            echo "<hr><form action='http://placenevents/forum.php' method='post' class=\"comment__form\">";
            echo "<label for=\"comment__text\" class=\"comment__label\">Введите сообщение:</label>";
            echo "<textarea class=\"comment__text\" rows=\"5\" name = \"comment\" id=\"comment__text\" required></textarea>";
            echo "<button type=\"submit\" name=\"add-comment\">Отправить</button></form>";
        }

        $query = "SELECT * FROM forum, users WHERE forum.author_id = users.user_id ORDER BY pubdate DESC";
        $result = mysqli_query($con, $query);
        while($message = mysqli_fetch_assoc($result)){
            echo "<article class=\"comment__article\">";
            echo "<hr><div>".$message['first_name']." ".$message['middle_name']. " ".$message['second_name']."</div>";
            echo "<div><strong>";
            if ($message['user_type'] == 1){
                echo "Горожанин ";
            }
            elseif ($message['user_type'] == 2){
                echo "Организатор";
            }
            elseif ($message['user_type'] == 3){
                echo "Модератор";
            }
            elseif ($message['user_type'] == 4){
                echo "Администратор";
            }
            echo "</strong></div>";
            echo "<div class='message'>".$message['pubdate']."</div>";
            echo "<p class=\"comment_p\">".$message['text']."</p>";
            echo "<hr> </article>";
        }

        ?>
    </section>
    <?php include('footer.php'); ?>
</div>
</body>

</html>