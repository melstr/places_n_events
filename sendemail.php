<?php session_start();
require('connect_db.php');

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
<style  type="text/css">
    .main-wrapper{
        font-size:1.2rem;
    }
</style>
<div class="main-container">
    <?php include('header.php');?>

    <div class="main-wrapper" style="justify-content: center;">
            <?php
            $body = "";
            if(isset($_SESSION['user_id'])){
                $body .="Авторизированный пользователь: \n".$_SESSION['user_type_name'].":".$_SESSION['second_name']." ".$_SESSION['first_name']." ".$_SESSION['middle_name']."
                \nlogin: ". $_SESSION['login']. "\n";
            }else{
                $body .="Неавторизированный пользователь: \n";
            }

            if($_POST['submit']){
                $email = $_POST['email'];
                $body .= $_POST['name']."
                \nНомер телефона: ".$_POST['phone']."
                \nemail: ".$_POST['email']."
                \n----------------------------------------\n".$_POST['description'];
                if(mail('placenevent@gmail.com', 'Вопрос от с сайта "Места и события"', $body , "From: $email")){
                    echo "<strong style=\"color:green\">Удачно! Ожидайте ответа на указанную электронную почту либо по номеру телефона.</strong>";
                }else{
                    echo "<strong style=\"color:red\">Ошибка! Попробуйте позже.</strong>";
                }
            }else{
                ?>
                <div class="account__wrapper">
                    <form action="sendemail.php" class="account__input" method="post">
                        <label style="color:red">
                            Если вопрос связан с аккаунтом - авторизируйтесь, и мы получим больше информации!
                        </label>
                        <label for="name">
                            Введите полное имя
                            <input type="text" name="name" class="" required>
                        </label>
                        <label for="phone">
                            Введите свой номер телефона, чтобы мы могли с вами связаться.
                            <input type="text" name="phone" class="" required>
                        </label>
                        <label for="email">
                            Введите адрес свой email
                            <input type="email" name="email" class="" required>
                        </label>
                        <br>
                        <label for="description">
                            Текст вопроса:
                            <textarea rows="9" cols="50" type="text" name="description" class="" required ></textarea>
                        </label>
                        <input type="submit" name="submit">
                    </form>
                </div>
            <?php }?>




    </div>
    <?php include('footer.php'); ?>

</div>
</body>

</html>


