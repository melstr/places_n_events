<?php
    session_start();
    require ('connect_db.php');
    $query = "SELECT * FROM events WHERE event_id = '".$_GET['id']."' ";
    $result = mysqli_query($con, $query);
    if(!($article = mysqli_fetch_assoc($result))){
        echo "<div style='color:red; font-size: 3rem; text-align: center;  margin-left: auto; margin-right: auto;'>Событие не найдено</div>";
        die("Ошибка");
    }

    $it_wants = false;
    if($_SESSION['user_type']==1){
        $query = "SELECT count(*) as count FROM wanna_go WHERE event_id ='". $_GET[id]."' AND user_id = '".$_SESSION['user_id']."'";
        $result = mysqli_query($con, $query);
        $wannago_count = mysqli_fetch_assoc($result)['count'];

        if($wannago_count == 1){
            $it_wants = true;
        }

        if(isset($_POST["wannago"])){

            if($it_wants == false){
                $query = "INSERT INTO wanna_go (event_id, user_id) VALUES ($_GET[id],$_SESSION[user_id])";

                $result = mysqli_query($con, $query);
                $it_wants = true;
            }
            else{
                $query = "DELETE FROM wanna_go WHERE event_id = '$_GET[id]' AND user_id = '$_SESSION[user_id]'";

                $result = mysqli_query($con, $query);
                $it_wants = false;
            }
            header("Location: http://placenevents/event_show.php/?id=" .$_GET['id']);
        }
    }

    if(isset($_POST['add-comment'])){
        $pubdate = date_create()->format('Y-m-d H:i:s');
        $query = "INSERT INTO even_comments (text, pubdate, event_id, author_id) VALUES ('$_POST[comment]','$pubdate','$_GET[id]','$_SESSION[user_id]')";
        mysqli_query($con, $query);
        header("Location: http://placenevents/event_show.php/?id=" .$_GET['id']);
    }


    $query = "SELECT * FROM users WHERE user_id = '".$article['author_id']."' ";
    $result = mysqli_query($con, $query);
    $author = mysqli_fetch_assoc($result);
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

    <div class="main-wrapper">
        <section class="main-articles">
            <?php
                if($_SESSION['user_type']==1){
                    echo "<form action='http://placenevents/event_show.php/?id=" .$_GET['id']."' method='post' >";
                    echo "<button type=\"submit\" name=\"wannago\">";
                    echo $it_wants ? "Не хочу идти!" : "Хочу Пойти!";
                    echo "</button></form>";
                }
            ?>

            <h1 class = "add-event__header">
                <?php

                if ($article['event_type']==1){
                    echo "Событие: ";
                }
                else{
                    echo "Место: ";
                }
                echo $article['title'];
                ?>
            </h1>
            <p>
                <?php
                echo $article['description'];
                ?>
            </p>
            <p>
                <strong>Категория:</strong>
                <?php
                echo $article['category'];
                ?>
            </p>
            <p>
                <strong>Организатор:</strong>
                <?php
                echo $author['first_name'].' ' .$author['middle_name'].' '.$author['second_name'];
                ?>
            </p>
            <p>
                <strong>Дата публикации:</strong>
                <?php
                echo $article['pubdate'];
                ?>
            </p>
            <p>
                <strong>Время начала:</strong>
                <?php
                echo $article['meeting_begin'];
                ?>
            </p>
            <p>
                <strong>Время конца:</strong>
                <?php
                echo $article['meeting_end'];
                ?>
            </p>


        </section>

    </div>
    <section class ="comment-section">

        <?php
            $query = "SELECT * FROM users WHERE login = '$_SESSION[login]'";
            $result = mysqli_query($con, $query);
            $user_status = mysqli_fetch_assoc($result)['status'];
        if(isset($_SESSION['user_type']) and ($user_status  == true)){
            echo "<hr><form action='http://placenevents/event_show.php/?id=".$_GET['id']."' method='post' class=\"comment__form\">";
            echo "<label for=\"comment__text\" class=\"comment__label\">Введите комментарий:</label>";
            echo "<textarea class=\"comment__text\" rows=\"5\" name = \"comment\" id=\"comment__text\" required></textarea>";
            echo "<button type=\"submit\" name=\"add-comment\">Отправить</button></form>";
        }

            $query = "SELECT * FROM even_comments, users WHERE even_comments.event_id = '$_GET[id]' AND even_comments.author_id = users.user_id ORDER BY pubdate DESC";
            $result = mysqli_query($con, $query);
            while($comment = mysqli_fetch_assoc($result)){
                echo "<article class=\"comment__article\">";
                echo "<hr><div>".$comment['first_name']." ".$comment['middle_name']. " ".$comment['second_name']."</div>";
                echo "<div><strong>";
                if ($comment['user_type'] == 1){
                    echo "Горожанин ";
                }
                elseif ($comment['user_type'] == 2){
                    echo "Организатор";
                }
                elseif ($comment['user_type'] == 3){
                    echo "Модератор";
                }
                elseif ($comment['user_type'] == 4){
                    echo "Администратор";
                }
                echo "</strong></div>";
                echo "<div>".$comment['pubdate']."</div>";
                echo "<p class=\"comment_p\">".$comment['text']."</p>";
                echo "<hr> </article>";
            }

        ?>
    </section>
    <footer class="main-footer">
        <span>Обратная связь</span>
    </footer>
</div>
</body>

</html>