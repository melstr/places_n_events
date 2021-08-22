<?php
session_start();
require('connect_db.php');
if (isset($_POST['citizen'])){
    $query = "UPDATE users SET user_type = '1' WHERE user_id = '$_POST[user_id]'";
    $result = mysqli_query($con, $query);
    header("Location: http://placenevents/users.php");
}
if (isset($_POST['org'])){
    $query = "UPDATE users SET user_type = '2' WHERE user_id = '$_POST[user_id]'";
    $result = mysqli_query($con, $query);
    header("Location: http://placenevents/users.php");
}
if (isset($_POST['mod'])){
    $query = "UPDATE users SET user_type = '3' WHERE user_id = '$_POST[user_id]'";
    $result = mysqli_query($con, $query);
    header("Location: http://placenevents/users.php");
}
if (isset($_POST['adm'])){
    $query = "UPDATE users SET user_type = '4' WHERE user_id = '$_POST[user_id]'";
    $result = mysqli_query($con, $query);
    header("Location: http://placenevents/users.php");
}
if (isset($_POST['ban'])){
    $query = "UPDATE users SET status = '0' WHERE user_id = '$_POST[user_id]'";
    $result = mysqli_query($con, $query);
    header("Location: http://placenevents/users.php");
}
if (isset($_POST['unban'])){
    $query = "UPDATE users SET status = '1' WHERE user_id = '$_POST[user_id]'";
    $result = mysqli_query($con, $query);
    header("Location: http://placenevents/users.php");
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

    <div class="main-wrapper">
        <section class="main-articles" style="width: 100%;">

            <h1 class = "add-event__header">Люди</h1>


            <?php

            $query = "SELECT * FROM users ";
            $result = mysqli_query($con, $query);

            while($user = mysqli_fetch_assoc($result)){
                echo "<form action='http://placenevents/users.php' method='post'>";
                echo "<label>".$user['first_name']." ".$user['middle_name']." ".$user['second_name']."</label>";
                echo "<label><strong>";
                if($user['user_type'] == 1){
                    echo " Горожанин ";
                }elseif($user['user_type'] == 2){
                    echo " Организатор ";
                }
                elseif($user['user_type'] == 3){
                    echo " Модератор ";
                }
                elseif($user['user_type'] == 4){
                    echo " Администратор ";
                }
                if($user['status'] != 1){
                    echo " ЗАБАНЕН! ";
                }
                echo "</strong></label>";
                echo "<input type = 'hidden' value='".$user['user_id']."' name ='user_id'>";

                echo "<button type='submit' name='citizen'>Сделать горожанином</button>";
                echo "<button type='submit' name='org'>Сделать организатором</button>";
                echo "<button type='submit' name='mod'>Сделать модератором</button>";
                echo "<button type='submit' name='adm'>Сделать администратором</button>";
                echo "<button type='submit' name='ban'>Забанить</button>";
                echo "<button type='submit' name='unban'>Разбанить</button>";
                echo "</form>";

            }
            ?>

        </section>

    </div>
    <footer class="main-footer">
        <span>Обратная связь</span>
    </footer>
</div>
</body>

</html>
