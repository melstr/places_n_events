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


        if($_POST['submit']){
            $title = $_POST['title'];
            $body = $_POST['name']."
                \nЗдравствуйте, пользователь сайта \"Места и события\"!
                \n----------------------------------------\n".$_POST['description'];
            $query = "SELECT * FROM subs";
            $result = mysqli_query($con, $query);
            while($email = mysqli_fetch_assoc($result)['email']){
                //var_dump($email);
                mail($email, $title, $body, "From: placenevent@gmail.com");
            }
            echo "<strong>Рассылка отослана</strong>";
        }else{
            ?>
            <div class="account__wrapper">
                <form action="sendnews.php" class="account__input" method="post">
                    <label style="color:red">
                       Отправить рассылку!
                    </label>
                    <label for="title">
                        Введите тему
                        <input type="text" name="title" class="" required>
                    </label>
                    <label for="description">
                        Текст сообщения:
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


