<?php session_start();
require('connect_db.php');
if(isset($_POST['subscribe'])){
    $email = $_POST['email'];
    $query = "SELECT * FROM subs WHERE email = '$email'";
    $result = mysqli_query($con, $query);
    if(!$result){
        $exists = false;
    }elseif(mysqli_num_rows($result) == 0){
        $exists = false;
    }else{
        $exists = true;
    }
    if(!$exists){
        $query = "INSERT INTO subs (email) VALUES ('$email')";
        mysqli_query($con, $query);
    }
}
if(isset($_POST['unsubscribe'])){
    $email = $_POST['email'];
    $query = "SELECT * FROM subs WHERE email = '$email'";
    $result = mysqli_query($con, $query);
    if(!$result){
        $exists = false;
    }elseif(mysqli_num_rows($result) > 0){
        $exists = true;
    }else{
        $exists = false;
    }
    if($exists){
        $query = "DELETE FROM subs WHERE email = '$email'";
        mysqli_query($con, $query);
    }
}
?>
<html>

<head>
    <title>Подписаться на рассылку</title>
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans:300,400,500,700&display=swap&subset=cyrillic"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://placenevents/normalize.css">
    <link rel="stylesheet" href="http://placenevents/main.css">
</head>

<body>
<style  type="text/css">
    .main-wrapper{
        font-size:1.2rem;
    }
</style>
<div class="main-container">
    <?php include('header.php');?>

    <div class="main-wrapper" style="justify-content: center;">

            <div class="account__wrapper subs">
                <?php

                if(isset($_POST['subscribe'])){
                    if(!$exists){
                        echo "<p><strong style=\"color:green\">Вы удачно подписались на рассылку!</strong></p>";
                    }else{
                        echo "<p><strong style=\"color:red\">Ошибка! Пользователь с таким email уже существует.</strong></p>";
                    }
                    echo "</br>";
                }elseif(isset($_POST['unsubscribe'])){
                    if(!$exists){
                        echo "<p><strong style=\"color:red\">Пользователя с таким email не существует</strong></p>";
                    }else{
                        echo "<p><strong style=\"color:green\">Вы удачно отписались от рассылки.</strong></p>";
                    }
                    echo "</br>";
                }
                ?>
                <form action="subscribe.php" class="account__input" method="post">
                    <label style="color:red">
                        Подпишитесь на рассылку новостей сайта
                    </label>
                    <label for="email">
                        Введите адрес свой email
                        <input type="email" name="email" class="" required>
                    </label>
                    <br>
                    <input type="submit" name="subscribe" value="Подписаться">
                    <input type="submit" name="unsubscribe" value="Отписаться">
                </form>
            </div>





    </div>
    <?php include('footer.php'); ?>

</div>
</body>

</html>


